// Initialize Page
window.onload = function() {
    const defaultTab = window.innerWidth < 768 ? 'new-banner' : (localStorage.getItem('activeSectionBanners') || 'new-banner');
    showSection(defaultTab);
};

// Mobile Sidebar
function toggleMobileSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('-translate-x-full');
}

// Navigation & Section Management
function showSection(section) {
    localStorage.setItem('activeSectionBanners', section);
    document.getElementById('new-banner-section').classList.add('hidden');
    document.getElementById('list-banner-section').classList.add('hidden');

    document.getElementById('nav-create').classList.remove('bg-slate-800/80', 'text-teal-400', 'border', 'border-teal-500/30');
    document.getElementById('nav-history').classList.remove('bg-slate-800/80', 'text-teal-400', 'border', 'border-teal-500/30');

    if(section === 'new-banner') {
        document.getElementById('new-banner-section').classList.remove('hidden');
        document.getElementById('nav-create').classList.add('bg-slate-800/80', 'text-teal-400', 'border', 'border-teal-500/30');
    } else if(section === 'list-banner') {
        document.getElementById('list-banner-section').classList.remove('hidden');
        document.getElementById('nav-history').classList.add('bg-slate-800/80', 'text-teal-400', 'border', 'border-teal-500/30');
    }

    if (window.innerWidth < 768) {
        const sidebar = document.getElementById('sidebar');
        if (!sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.add('-translate-x-full');
        }
    }
}

// Banner Management (Submit)
async function submitBanner() {
    const form = document.getElementById('heroForm');
    const btn = document.getElementById('publishBtn');
    
    if (!form.checkValidity()) { form.reportValidity(); return; }
    if (!confirm('Publish this banner image?')) return;

    toggleLoader(true);
    btn.innerHTML = '<span>Uploading...</span>';
    btn.disabled = true;

    let fd = new FormData(form);
    fd.append('csrf_token', document.querySelector('meta[name="csrf-token"]').content);
    fd.append('action', 'publish');

    try {
        let res = await fetch('action/banners-action.php', { method: 'POST', body: fd });
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
        btn.innerHTML = '<span>Publish</span> <i class="fas fa-arrow-right text-xs"></i>';
        btn.disabled = false;
        toggleLoader(false);
    }
}

// Banner Management (Delete)
async function deleteBanner(id) {
    if (!confirm('Delete this banner image?')) return;

    toggleLoader(true);

    let fd = new FormData();
    fd.append('csrf_token', document.querySelector('meta[name="csrf-token"]').content);
    fd.append('action', 'delete');
    fd.append('id', id);

    let res = await fetch('action/banners-action.php', { method: 'POST', body: fd });

    if(await res.text() === 'success') {
        location.reload();
    } else {
        toggleLoader(false);
        alert('Failed to delete!');
    }
}

// Banner Management (Edit)
async function editBanner(id) {
    toggleLoader(true);
    let res = await fetch(`action/banners-action.php?action=get_banner&id=${id}`);
    let banner = await res.json();
    
    document.getElementById('headline').value = banner.headline;
    document.getElementById('bodytext').value = banner.bodytext;
    document.getElementById('link').value = banner.link;

    document.getElementById('image-desktop').required = false;
    document.getElementById('image-mobile').required = false;

    const form = document.getElementById('heroForm');
    let hiddenId = document.getElementById('edit-id');
    if (!hiddenId) {
        hiddenId = document.createElement('input');
        hiddenId.type = 'hidden';
        hiddenId.name = 'id';
        hiddenId.id = 'edit-id';
        form.appendChild(hiddenId);
    }
    hiddenId.value = banner.id;

    const btn = document.getElementById('publishBtn');
    btn.innerHTML = '<span>Update</span> <i class="fas fa-arrow-right text-xs"></i>';
    btn.onclick = updateBanner;

    document.getElementById('cancelBtn').classList.remove('hidden');
    
    showSection('new-banner');
    toggleLoader(false);
}

// Banner Management (Cancle)
function cancelEdit() {
    const form = document.getElementById('heroForm');
    form.reset();
    
    let hiddenId = document.getElementById('edit-id');
    if (hiddenId) hiddenId.remove();

    document.getElementById('image-desktop').required = true;
    document.getElementById('image-mobile').required = true;

    const btn = document.getElementById('publishBtn');
    btn.innerHTML = '<span>Publish</span> <i class="fas fa-arrow-right text-xs"></i>';
    btn.onclick = submitBanner;

    document.getElementById('cancelBtn').classList.add('hidden');
}

// Banner Management (Update)
async function updateBanner() {
    const form = document.getElementById('heroForm');
    let fd = new FormData(form);
    fd.append('csrf_token', document.querySelector('meta[name="csrf-token"]').content);
    fd.append('action', 'update');

    toggleLoader(true);
    let res = await fetch('action/banners-action.php', { method: 'POST', body: fd });
    let result = await res.text();

    if (result.trim() === 'success') {
        alert('Successfully updated!');
        location.reload();
    } else {
        alert('Error: ' + result);
        toggleLoader(false);
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