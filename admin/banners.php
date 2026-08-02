<?php
require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: index.php');
    exit;
}

$banners = $pdo->query("SELECT * FROM banners ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
$page_title = 'CMS HUB | BANNERS';
$css_file = '../static/css/banners.css';
include __DIR__ . '/includes/header.php';
?>

    <!-- Top Header -->
    <header class="w-full glass-panel border-b border-slate-800/80 py-3.5 px-4 sm:px-6 md:px-10 flex justify-between items-center shadow-lg shrink-0 sticky top-0 z-50">
        <div class="flex items-center gap-3">
            <button onclick="toggleMobileSidebar()" class="flex items-center gap-3 focus:outline-none group">
                <div class="w-9 h-9 sm:w-10 sm:h-10 bg-gradient-to-tr from-teal-500 to-emerald-600 rounded-xl flex items-center justify-center font-bold text-white shadow-md shadow-teal-500/20">
                    <i class="fas fa-images text-xs sm:text-sm"></i>
                </div>
                <div class="text-left">
                    <h1 class="font-bold text-xs sm:text-sm md:text-base tracking-wide text-white">CMS BANNERS</h1>
                    <p class="text-[9px] sm:text-[10px] text-teal-400 font-medium">Content Management System</p>
                </div>
            </button>
        </div>
    </header>

    <!-- Main Content -->
    <div id="dashboard-screen" class="flex-1 flex flex-col md:flex-row overflow-hidden relative z-10">
        <?php 
        // Sidebar
        $module = 'banners';
        include __DIR__ . '/includes/sidebar.php'; 
        ?>
        <main class="flex-1 p-6 md:px-10 md:py-8 overflow-y-auto">            
            <!-- Section Create -->
            <div id="new-banner-section" class="view-panel w-full">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-white tracking-tight flex items-center gap-3">
                        <i class="fas fa-pen-nib text-teal-400 text-xl"></i>Create
                    </h2>
                </div>
                <div class="glass-panel p-6 md:p-8 rounded-3xl shadow-2xl w-full">
                    <form id="heroForm" class="space-y-6" enctype="multipart/form-data">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-2 uppercase tracking-wider">Headline</label>
                                <input type="text" name="headline" id="headline" maxlength="80" required placeholder="Enter a headline..." class="w-full p-3.5 glass-input rounded-xl outline-none text-sm transition">
                                <p class="text-[10px] text-slate-400 mt-1">Max. 80 characters</p>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-2 uppercase tracking-wider">Link (URL) <span class="text-slate-500 font-normal">(Optional)</span></label>
                                <input type="text" name="link" id="link" placeholder="Enter a URL (e.g., https://your.link/)" class="w-full p-3.5 glass-input rounded-xl outline-none text-sm transition">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-300 mb-2 uppercase tracking-wider">Body Text</label>
                            <textarea name="bodytext" id="bodytext" maxlength="200" required placeholder="Enter body text..." rows="3" class="w-full p-3.5 glass-input rounded-xl outline-none text-sm transition resize-none"></textarea>
                            <p class="text-[10px] text-slate-400 mt-1">Max. 200 characters</p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-2 uppercase tracking-wider">For Desktop Image</label>
                                <input type="file" name="image_desktop" id="image-desktop" accept=".jpg, .jpeg, .png, .webp, .gif" required class="w-full p-2.5 glass-input rounded-xl text-xs file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-teal-500/25 file:text-teal-300 hover:file:bg-teal-500/35 file:cursor-pointer">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-300 mb-2 uppercase tracking-wider">For Mobile Image</label>
                                <input type="file" name="image_mobile" id="image-mobile" accept=".jpg, .jpeg, .png, .webp, .gif" required class="w-full p-2.5 glass-input rounded-xl text-xs file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-teal-500/25 file:text-teal-300 hover:file:bg-teal-500/35 file:cursor-pointer">
                            </div>
                        </div>
                        <div class="pt-2 flex items-center gap-3">
                            <button type="button" id="publishBtn" onclick="submitBanner()" class="bg-gradient-to-r from-teal-600 to-emerald-600 text-white px-8 py-3.5 rounded-xl font-bold hover:opacity-95 transition shadow-lg shadow-teal-500/25 text-sm flex items-center justify-center gap-2">
                                <span>Publish</span>
                                <i class="fas fa-arrow-right text-xs"></i>
                            </button>
                            <button type="button" id="cancelBtn" onclick="cancelEdit()" class="hidden bg-slate-900/60 text-slate-300 px-6 py-3.5 rounded-xl font-bold hover:bg-slate-800 transition text-sm border border-slate-700/80 backdrop-blur-md">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Section History -->
            <div id="list-banner-section" class="view-panel hidden w-full">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-white tracking-tight flex items-center gap-3">
                        <i class="fas fa-history text-teal-400 text-xl"></i>Banner
                    </h2>
                </div>
                <div class="glass-panel rounded-3xl shadow-2xl overflow-hidden w-full">
                    <?php if (empty($banners)): ?>
                        <div class="p-12 text-center text-slate-400">
                            <i class="fas fa-folder-open text-4xl mb-4 text-slate-600"></i>
                            <p class="text-sm">No published banner image yet!</p>
                        </div>
                    <?php else: ?>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="border-b border-slate-800 text-[11px] font-bold text-slate-400 uppercase tracking-wider bg-slate-900/40">
                                        <th class="p-4 w-24">Image</th>
                                        <th class="p-4 w-1/4">Headline</th>
                                        <th class="p-4 w-auto">Body Text</th>
                                        <th class="p-4 w-24 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-800/60 text-sm">
                                    <?php foreach ($banners as $b): ?>
                                    <tr class="hover:bg-slate-800/30 transition-colors">
                                        <td class="p-4">
                                            <img src="../public/uploads/banners/<?= htmlspecialchars(basename($b['image_desktop'])) ?>" class="w-16 h-10 object-cover rounded-lg shadow border border-slate-700/50">
                                        </td>
                                        <td class="p-4 font-semibold text-white text-xs leading-snug">
                                            <?= htmlspecialchars($b['headline']) ?>
                                        </td>
                                        <td class="p-4 text-slate-300 text-xs leading-relaxed line-clamp-2">
                                            <?= htmlspecialchars($b['bodytext']) ?>
                                        </td>
                                        <td class="p-4">
                                            <div class="flex items-center justify-center gap-1.5">
                                                <button onclick="editBanner(<?= $b['id'] ?>)" class="w-8 h-8 rounded-lg bg-teal-500/10 text-teal-400 hover:bg-teal-500/20 transition flex items-center justify-center border border-teal-500/20" title="Edit">
                                                    <i class="fas fa-edit text-xs"></i>
                                                </button>
                                                <button onclick="deleteBanner(<?= $b['id'] ?>)" class="w-8 h-8 rounded-lg bg-red-500/10 text-red-400 hover:bg-red-500/20 transition flex items-center justify-center border border-red-500/20" title="Delete">
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
        <div class="glass-panel p-6 rounded-2xl flex items-center gap-4 border border-teal-500/30 shadow-2xl">
            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-teal-400"></div>
            <span class="font-bold text-sm text-white">Processing...</span>
        </div>
    </div>

<script src="../static/js/banners.js"></script>
</body>
</html>
