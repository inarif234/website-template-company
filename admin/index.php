<?php
require_once __DIR__ . '/../config/config.php';
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$page_title = 'CMS HUB';
$css_file = '../static/css/admin.css';
include __DIR__ . '/includes/header.php';
?>

    <!-- Screen Login  -->
    <div id="view-login" class="view-section <?php echo $is_logged_in ? '' : 'active'; ?> min-h-screen w-full items-center justify-center p-4 relative z-10">
        <div class="glass-panel p-8 md:p-10 rounded-3xl shadow-2xl w-full max-w-md relative overflow-hidden my-auto">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-teal-400 via-blue-500 to-indigo-600"></div>
            <div class="text-center mb-8">
                <div class="w-14 h-14 bg-gradient-to-tr from-teal-500 to-blue-600 rounded-2xl mx-auto flex items-center justify-center font-bold text-2xl text-white mb-4 shadow-lg shadow-teal-500/20">
                    <i class="fas fa-layer-group"></i>
                </div>
                <h1 class="text-2xl font-bold tracking-tight text-white">CMS HUB</h1>
                <p class="text-xs text-slate-400 mt-1">Content Management Center</p>
            </div>
            <div class="space-y-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase tracking-wider">Username</label>
                    <input type="text" id="login-user" onkeypress="checkEnter(event)" class="w-full p-3.5 glass-input rounded-xl text-white outline-none text-sm transition">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5 uppercase tracking-wider">Password</label>
                    <input type="password" id="login-pass" onkeypress="checkEnter(event)" class="w-full p-3.5 glass-input rounded-xl text-white outline-none text-sm transition">
                </div>
                <button onclick="handleLogin()" class="w-full bg-gradient-to-r from-teal-500 to-blue-600 text-white py-3.5 rounded-xl font-bold hover:opacity-95 transition shadow-lg shadow-blue-500/25 text-sm mt-3 flex items-center justify-center gap-2">
                    <span>LOGIN</span>
                    <i class="fas fa-arrow-right text-xs"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Screen Dashboard -->
    <div id="view-hub" class="view-section <?php echo $is_logged_in ? 'active' : ''; ?> flex-col min-h-screen w-full relative z-10">
        <header class="w-full glass-panel border-b border-slate-800/80 py-3.5 px-4 sm:px-6 md:px-10 flex justify-between items-center shadow-lg shrink-0 fixed top-0 left-0 right-0 md:static z-30">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 sm:w-10 sm:h-10 bg-gradient-to-tr from-teal-500 to-blue-600 rounded-xl flex items-center justify-center font-bold text-white shadow-md shadow-teal-500/20">
                    <i class="fas fa-layer-group text-xs sm:text-sm"></i>
                </div>
                <div>
                    <h1 class="font-bold text-xs sm:text-sm md:text-base tracking-wide text-white">CMS HUB</h1>
                    <p class="text-[9px] sm:text-[10px] text-teal-400 font-medium">Content Management Center</p>
                </div>
            </div>
            <button onclick="handleLogout()" class="bg-slate-900/80 hover:bg-red-500/20 hover:text-red-400 hover:border-red-500/40 text-slate-300 px-3 sm:px-4 py-2 rounded-xl text-xs font-semibold transition border border-slate-700 flex items-center gap-1.5 sm:gap-2">
                <i class="fas fa-sign-out-alt"></i> <span class="hidden sm:inline">Logout</span>
            </button>
        </header>
        <!-- Card Menu -->
        <main class="flex-1 max-w-5xl w-full mx-auto p-4 sm:p-6 md:p-8 flex flex-col justify-center my-auto pt-24 md:pt-8">
            <div class="mb-6 sm:mb-8 text-center">
                <span class="inline-block text-[10px] sm:text-xs font-bold tracking-widest text-teal-400 uppercase bg-teal-500/10 px-3 py-1.5 rounded-full border border-teal-500/20">CMS HUB</span>
                <h2 class="text-xl sm:text-3xl md:text-4xl font-extrabold mt-3 mb-2 text-white">Content Management System</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6 w-full">
                <!-- Card: Banner Manager -->
                <div onclick="location.href='banners.php'" class="group cursor-pointer glass-card p-6 sm:p-8 rounded-xl flex flex-col justify-between relative overflow-hidden text-center items-center">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-teal-500/10 rounded-full blur-2xl group-hover:bg-teal-500/20 transition-all"></div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 bg-teal-500/10 text-teal-400 border border-teal-500/20 rounded-lg flex items-center justify-center text-lg sm:text-xl mb-4 sm:mb-5 group-hover:scale-110 transition-transform shadow-inner">
                            <i class="fas fa-images"></i>
                        </div>
                        <span class="inline-block text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-teal-400 bg-teal-500/10 px-3 py-1 rounded-full border border-teal-500/20">CMS BANNERS</span>
                        <h3 class="text-xl sm:text-2xl font-bold mt-3 sm:mt-4 mb-2 text-white group-hover:text-teal-300 transition-colors">Banner Promotion Manager</h3>
                    </div>
                    <div class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-slate-800/80 flex items-center justify-between w-full">
                        <span class="text-[11px] sm:text-xs text-slate-400 font-medium"><strong class="text-teal-400">Banner</strong> Modul</span>
                        <span class="text-teal-400 font-semibold text-xs sm:text-sm flex items-center gap-1.5 sm:gap-2 group-hover:translate-x-1.5 transition-transform">Manage<i class="fas fa-arrow-right text-[10px]"></i></span>
                    </div>
                </div>
                <!-- Card: Posts Manager -->
                <div onclick="location.href='posts.php'" class="group cursor-pointer glass-card p-6 sm:p-8 rounded-xl flex flex-col justify-between relative overflow-hidden text-center items-center">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl group-hover:bg-blue-500/20 transition-all"></div>
                    <div class="flex flex-col items-center w-full">
                        <div class="w-12 h-12 sm:w-14 sm:h-14 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-lg flex items-center justify-center text-lg sm:text-xl mb-4 sm:mb-5 group-hover:scale-110 transition-transform shadow-inner">
                            <i class="fas fa-newspaper"></i>
                        </div>
                        <span class="inline-block text-[10px] sm:text-[11px] font-bold uppercase tracking-wider text-blue-400 bg-blue-500/10 px-3 py-1 rounded-full border border-blue-500/20">CMS POSTS</span>
                        <h3 class="text-xl sm:text-2xl font-bold mt-3 sm:mt-4 mb-2 text-white group-hover:text-blue-300 transition-colors">Blog & Article Content Manager</h3>
                    </div>
                    <div class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-slate-800/80 flex items-center justify-between w-full">
                        <span class="text-[11px] sm:text-xs text-slate-400 font-medium"><strong class="text-blue-400">Posts</strong> Modul</span>
                        <span class="text-blue-400 font-semibold text-xs sm:text-sm flex items-center gap-1.5 sm:gap-2 group-hover:translate-x-1.5 transition-transform">Manage<i class="fas fa-arrow-right text-[10px]"></i></span>
                    </div>
                </div>
            </div>
        </main>
    </div>

<script src="../static/js/admin.js"></script>
</body>
</html>