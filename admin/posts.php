<?php
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

$posts = $pdo->query("SELECT * FROM posts ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
$page_title = 'CMS HUB | POSTS';
$css_file = '../static/css/posts.css';

$extra_head = '
<link href="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.snow.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/quill@1.3.7/dist/quill.min.js"></script>
';

include __DIR__ . '/includes/header.php';
?>

    <!-- Top Header -->
    <header class="w-full glass-panel border-b border-slate-800/80 py-3.5 px-4 sm:px-6 md:px-10 flex justify-between items-center shadow-lg shrink-0 sticky md:static top-0 z-30">
        <div class="flex items-center gap-3">
            <button onclick="toggleMobileSidebar()" class="flex items-center gap-3 focus:outline-none group">
                <div class="w-9 h-9 sm:w-10 sm:h-10 bg-gradient-to-tr from-blue-600 to-indigo-600 rounded-xl flex items-center justify-center font-bold text-white shadow-md shadow-blue-500/20">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div class="text-left">
                    <h1 class="font-bold text-xs sm:text-sm md:text-base tracking-wide text-white">CMS POSTS</h1>
                    <p class="text-[9px] sm:text-[10px] text-teal-400 font-medium">Content Management System</p>
                </div>
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <div id="dashboard-screen" class="flex-1 flex flex-col md:flex-row overflow-hidden relative z-10">
        <?php 
        // Sidebar
        $module = 'posts';
        include __DIR__ . '/includes/sidebar.php'; 
        ?>
        <main class="flex-1 p-6 md:px-10 md:py-8 overflow-y-auto">            
            <!-- Section Create -->
            <div id="new-post-section" class="view-panel w-full">
                <div class="mb-6 flex justify-between items-center">
                    <h2 id="form-section-title" class="text-2xl font-bold text-white tracking-tight flex items-center gap-3">
                        <i class="fas fa-pen-nib text-blue-400 text-xl"></i>Create
                    </h2>
                </div>                
                <div class="glass-panel p-6 md:p-8 rounded-3xl shadow-2xl w-full">
                    <form id="blogForm" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-2 uppercase tracking-wider">Content Title</label>
                                <input type="text" name="title" id="title" required placeholder="Enter a title..." class="w-full p-3.5 glass-input rounded-xl outline-none text-sm transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-2 uppercase tracking-wider">Content Type</label>
                                <div class="relative">
                                    <select name="type" id="type" required class="w-full p-3.5 pr-10 glass-input rounded-xl appearance-none outline-none text-sm cursor-pointer">
                                        <option value="" disabled selected class="bg-slate-900">Select Type</option>
                                        <option value="Articles" class="bg-slate-900">Articles</option>
                                        <option value="News" class="bg-slate-900">News</option>
                                        <option value="Blog" class="bg-slate-900">Blog</option>
                                        <option value="Promo" class="bg-slate-900">Promo</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                        <i class="fas fa-chevron-down text-xs"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-2 uppercase tracking-wider">Publication Date</label>
                                <input type="date" name="date" id="post-date" required class="w-full p-3.5 glass-input rounded-xl outline-none text-sm transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-2 uppercase tracking-wider">Upload Image <span id="image-hint" class="text-[10px] text-slate-400 font-normal lowercase">(required)</span></label>
                                <input type="file" name="image" id="image-upload" accept=".jpg, .jpeg, .png, .webp, .gif" required class="w-full p-2.5 glass-input rounded-xl text-xs file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-500/25 file:text-blue-300 hover:file:bg-blue-500/35 file:cursor-pointer">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-2 uppercase tracking-wider">Content Description</label>
                            <textarea name="description" id="description" required placeholder="Enter a description..." rows="3" class="w-full p-3.5 glass-input rounded-xl outline-none text-sm transition resize-none"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-2 uppercase tracking-wider">Content Editor</label>
                            <div class="rounded-xl overflow-hidden shadow-inner">
                                <div id="toolbar">
                                    <select class="ql-header">
                                        <option value="" selected>Normal</option>
                                        <option value="3">Heading</option>
                                    </select>
                                    <button class="ql-bold" title="Bold"><i class="fas fa-bold"></i></button>
                                    <button class="ql-italic" title="Italic"><i class="fas fa-italic"></i></button>
                                    <button class="ql-list" value="bullet" title="Bullet List"><i class="fas fa-list-ul"></i></button>
                                    <button class="ql-list" value="ordered" title="Numbered List"><i class="fas fa-list-ol"></i></button>
                                    <button class="ql-link" title="Insert Link"><i class="fas fa-link"></i></button>
                                    <button class="ql-undo" title="Undo"><i class="fas fa-undo"></i></button>
                                    <button class="ql-redo" title="Redo"><i class="fas fa-redo"></i></button>
                                </div>
                                <div id="editor"></div>
                            </div>
                        </div>

                        <div class="pt-2 flex items-center gap-3">
                            <button type="button" id="submit-btn" onclick="submitPost()" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-3.5 rounded-xl font-bold hover:opacity-95 transition shadow-lg shadow-blue-500/25 text-sm flex items-center justify-center gap-2">
                                <span>Publish</span>
                                <i class="fas fa-arrow-right text-xs"></i>
                            </button>
                            <button type="button" id="cancelBtn" onclick="resetFormToCreate()" class="hidden bg-slate-900/60 text-slate-300 px-6 py-3.5 rounded-xl font-bold hover:bg-slate-800 transition text-sm border border-slate-700/80 backdrop-blur-md">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Section History -->
            <div id="list-post-section" class="view-panel hidden w-full">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-white tracking-tight flex items-center gap-3">
                        <i class="fas fa-history text-blue-400 text-xl"></i>History
                    </h2>
                </div>
                <div class="glass-panel rounded-3xl shadow-2xl overflow-hidden w-full">
                    <?php if (empty($posts)): ?>
                        <div class="p-12 text-center text-slate-400">
                            <i class="fas fa-folder-open text-4xl mb-4 text-slate-600"></i>
                            <p class="text-sm">No published content yet!</p>
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-800 text-[11px] font-bold text-slate-400 uppercase tracking-wider bg-slate-900/40">
                                        <th class="p-4 w-24">Image</th>
                                        <th class="p-4 w-1/4">Title</th>
                                        <th class="p-4 w-auto">Description</th>
                                        <th class="p-4 w-24 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800/60 text-sm">
                                    <?php foreach ($posts as $post): ?>
                                    <tr class="hover:bg-slate-800/30 transition-colors">
                                        <td class="p-4">
                                            <img src="../public/uploads/posts/<?= htmlspecialchars(basename($post['image'])) ?>" class="w-16 h-10 object-cover rounded-lg shadow border border-slate-700/50" onerror="this.src='../public/assets/logo/logo.png'">
                                        </td>
                                        <td class="p-4">
                                            <span class="inline-block text-[10px] font-bold px-2.5 py-0.5 rounded-full bg-blue-500/10 text-blue-400 border border-blue-500/20 mb-1"><?= htmlspecialchars($post['type']) ?></span>
                                            <div class="font-semibold text-white text-xs leading-snug"><?= htmlspecialchars($post['title']) ?></div>
                                        </td>
                                        <td class="p-4 text-slate-300 text-xs leading-relaxed line-clamp-2"><?= htmlspecialchars($post['description']) ?></td>
                                        <td class="p-4">
                                            <div class="flex items-center justify-center gap-1.5">
                                                <button onclick="editPost(<?= $post['id'] ?>)" class="w-8 h-8 rounded-lg bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition flex items-center justify-center border border-blue-500/20" title="Edit">
                                                    <i class="fas fa-edit text-xs"></i>
                                                </button>
                                                <button onclick="deletePost(<?= $post['id'] ?>)" class="w-8 h-8 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition flex items-center justify-center border border-red-500/20" title="Delete">
                                                    <i class="fas fa-trash text-xs"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>

    <!-- Loader Overlay -->
    <div id="loader" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-slate-950/80 backdrop-blur-md">
        <div class="glass-panel p-6 rounded-2xl flex items-center gap-4 border border-blue-500/30 shadow-2xl">
            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-blue-400"></div>
            <span class="font-bold text-sm text-white">Processing...</span>
        </div>
    </div>

<script src="../static/js/posts.js"></script>
</body>
</html>