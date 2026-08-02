// Variables
let quill;

// Page Initialization
window.onload = function() {
    const defaultTab = window.innerWidth < 768 ? 'new-post' : (localStorage.getItem('activeSectionPosts') || 'new-post');
    showSection(defaultTab);

    // Quill Initialization
    quill = new Quill('#editor', {
        modules: {
            toolbar: {
                container: '#toolbar',
                handlers: {
                    'undo': function() {
                        this.quill.history.undo();
                    },
                    'redo': function() {
                        this.quill.history.redo();
                    }
                }
            },
            history: {
                delay: 1000,
                maxStack: 500,
                userOnly: true
            }
        },
        theme: 'snow'
    });

    quill.clipboard.addMatcher('H1, H2', function(node, delta) {
        delta.ops.forEach(op => {
            if (!op.attributes) {
                op.attributes = {};
            }
            op.attributes.header = 3;
        });
        return delta;
    });

    const tooltip = document.querySelector('.ql-tooltip');
    const container = document.querySelector('.ql-container');
    if (tooltip && container) {
        const observer = new MutationObserver(() => {
            if (!tooltip.classList.contains('ql-hidden')) {
                setTimeout(() => {
                    const containerRect = container.getBoundingClientRect();
                    const tooltipRect = tooltip.getBoundingClientRect();
                    let currentTop = parseFloat(tooltip.style.top) || 0;
                    
                    if (tooltipRect.left < containerRect.left + 10) {
                        tooltip.style.left = '20px';
                    }

                    if (tooltipRect.bottom > containerRect.bottom - 5) {
                        tooltip.style.top = (currentTop - tooltipRect.height - 45) + 'px';
                    }
                }, 10);
            }
        });
        observer.observe(tooltip, { attributes: true, attributeFilter: ['class', 'style'] });
    }
};

// Tonggle (Mobile Sidebar)
function toggleMobileSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('-translate-x-full');
}

// Toggle (Section Navigation)
function showSection(section) {
    localStorage.setItem('activeSectionPosts', section);
    document.getElementById('new-post-section').classList.add('hidden');
    document.getElementById('list-post-section').classList.add('hidden');

    document.getElementById('nav-create').classList.remove('bg-slate-800/80', 'text-blue-400', 'border', 'border-blue-500/30');
    document.getElementById('nav-history').classList.remove('bg-slate-800/80', 'text-blue-400', 'border', 'border-blue-500/30');

    if(section === 'new-post') {
        document.getElementById('new-post-section').classList.remove('hidden');
        document.getElementById('nav-create').classList.add('bg-slate-800/80', 'text-blue-400', 'border', 'border-blue-500/30');
    } else if(section === 'list-post') {
        document.getElementById('list-post-section').classList.remove('hidden');
        document.getElementById('nav-history').classList.add('bg-slate-800/80', 'text-blue-400', 'border', 'border-blue-500/30');
    }

    if (window.innerWidth < 768) {
        const sidebar = document.getElementById('sidebar');
        if (!sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.add('-translate-x-full');
        }
    }
}

// Posts Management (Create)
function resetFormToCreate() {
    const form = document.getElementById('blogForm');
    form.reset();
    if (quill) {
        quill.root.innerHTML = '';
    }
    
    const hiddenId = document.getElementById('edit-id');
    if (hiddenId) hiddenId.remove();

    const btn = document.getElementById('submit-btn');
    btn.innerHTML = '<span>Publish</span> <i class="fas fa-arrow-right text-xs"></i>';
    btn.onclick = submitPost;

    document.getElementById('cancelBtn').classList.add('hidden');
    document.getElementById('image-upload').required = true;
    document.getElementById('image-hint').innerText = '(required)';
}

// Posts Management (Submit)
async function submitPost() {
    const form = document.getElementById('blogForm');
    const content = quill ? quill.root.innerHTML : '';

    if (!form.checkValidity()) { form.reportValidity(); return; }
    
    if (!content || content.trim() === '<p><br></p>' || content.trim() === '') {
        alert('Content is required!'); return;
    }

    if (!confirm('Publish this content?')) return;

    toggleLoader(true);
    
    let fd = new FormData(form);
    fd.append('csrf_token', document.querySelector('meta[name="csrf-token"]').content);
    fd.append('content', content);
    fd.append('action', 'publish');

    try {
        let res = await fetch('action/posts-action.php', { method: 'POST', body: fd });
        let result = await res.text();
        
        if (result.trim() === 'success') {
            alert('Successfully published!');
            location.reload(); 
        } else {
            alert('Error: ' + result);
        }
    } catch (e) {
        alert('Connection error occurred!');
    } finally {
        toggleLoader(false);
    }
}

// Posts Management (Delete)
async function deletePost(id) {
    if (!confirm('Delete this content?')) return;

    toggleLoader(true);

    let fd = new FormData();
    fd.append('csrf_token', document.querySelector('meta[name="csrf-token"]').content);
    fd.append('action', 'delete');
    fd.append('id', id);

    let res = await fetch('action/posts-action.php', { method: 'POST', body: fd });

    if(await res.text() === 'success') {
        location.reload();
    } else {
        toggleLoader(false);
        alert('Failed to delete!');
    }
}

// Posts Management (Edit)
async function editPost(id) {
    toggleLoader(true);
    let res = await fetch(`action/posts-action.php?action=get_post&id=${id}`);
    let post = await res.json();
    
    document.getElementById('title').value = post.title;
    document.getElementById('type').value = post.type;
    document.getElementById('post-date').value = post.date;
    document.getElementById('description').value = post.description;
    if (quill) {
        quill.root.innerHTML = post.content;
    }

    document.getElementById('image-upload').required = false;
    document.getElementById('image-hint').innerText = '(Leave blank if unchanged!)';

    const form = document.getElementById('blogForm');
    let hiddenId = document.getElementById('edit-id');
    if (!hiddenId) {
        hiddenId = document.createElement('input');
        hiddenId.type = 'hidden';
        hiddenId.name = 'id';
        hiddenId.id = 'edit-id';
        form.appendChild(hiddenId);
    }
    hiddenId.value = post.id;

    const btn = document.getElementById('submit-btn');
    btn.innerHTML = '<span>Update</span> <i class="fas fa-arrow-right text-xs"></i>';
    btn.onclick = updatePost;

    document.getElementById('cancelBtn').classList.remove('hidden');

    showSection('new-post');
    toggleLoader(false);
}

// Posts Management (Update)
async function updatePost() {
    const form = document.getElementById('blogForm');
    let fd = new FormData(form);
    fd.append('csrf_token', document.querySelector('meta[name="csrf-token"]').content);
    fd.append('content', quill ? quill.root.innerHTML : '');
    fd.append('action', 'update');

    toggleLoader(true);
    let res = await fetch('action/posts-action.php', { method: 'POST', body: fd });
    let result = await res.text();

    if (result.trim() === 'success') {
        alert('Successfully updated!');
        location.reload();
    } else {
        toggleLoader(false);
        alert('Error: ' + result);
    }
}

// User Logout
async function logout() { 
    toggleLoader(true);
    await fetch('auth/logout.php');
    location.href = 'index.php';
}

// Loading Overlay
function toggleLoader(show) {
    const loader = document.getElementById('loader');
    if (show) loader.classList.remove('hidden');
    else loader.classList.add('hidden');
}