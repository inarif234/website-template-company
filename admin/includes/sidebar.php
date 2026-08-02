<?php
$module = $module ?? 'banners';
$accent_color = ($module === 'posts') ? 'blue' : 'teal';
?>

<!-- Sidebar -->
<aside id="sidebar" class="w-64 glass-panel border-r border-slate-800/80 p-5 flex flex-col justify-between shrink-0 fixed md:static inset-y-0 left-0 z-50 transform -translate-x-full md:translate-x-0 transition-transform duration-300 shadow-2xl md:shadow-none h-full">
    <div class="space-y-2">
        <div class="flex items-center justify-between md:hidden pb-3 mb-2 border-b border-slate-800">
            <span class="text-xs font-bold text-slate-400 uppercase"><?php echo strtoupper($module); ?></span>
            <button onclick="toggleMobileSidebar()" class="text-slate-400 hover:text-white p-1">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <button onclick="showSection('new-<?php echo ($module === 'posts') ? 'post' : 'banner'; ?>')" id="nav-create" class="w-full text-left p-3.5 rounded-xl text-sm font-semibold transition flex items-center gap-3 text-slate-300 hover:bg-slate-800/60 hover:text-<?php echo $accent_color; ?>-400">
            <i class="fas fa-edit text-<?php echo $accent_color; ?>-400"></i>Create
        </button>
        <button onclick="showSection('list-<?php echo ($module === 'posts') ? 'post' : 'banner'; ?>')" id="nav-history" class="w-full text-left p-3.5 rounded-xl text-sm font-semibold transition flex items-center gap-3 text-slate-300 hover:bg-slate-800/60 hover:text-<?php echo $accent_color; ?>-400">
            <i class="fas fa-list text-<?php echo $accent_color; ?>-400"></i>History
        </button>
    </div>
    <div class="space-y-2 pt-4 border-t border-slate-800/80">
        <a href="index.php" class="w-full text-left p-3.5 rounded-xl text-sm font-semibold transition flex items-center gap-3 text-slate-300 hover:bg-<?php echo $accent_color; ?>-500/10 hover:text-<?php echo $accent_color; ?>-400 border border-slate-700/50 hover:border-<?php echo $accent_color; ?>-500/30">
            <i class="fas fa-th-large text-<?php echo $accent_color; ?>-400"></i>Back
        </a>
        <button onclick="logout()" class="w-full text-left p-3.5 rounded-xl text-sm font-semibold transition flex items-center gap-3 text-slate-400 hover:text-red-400 hover:bg-red-500/10 border border-transparent hover:border-red-500/20">
            <i class="fas fa-sign-out-alt"></i>Logout
        </button>
    </div>
</aside>