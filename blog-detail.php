<?php
// Path Routing
$is_blog = (strpos($_SERVER['REQUEST_URI'], '/blog/') !== false);
$path_prefix = $is_blog ? '../' : '';

// Database Connection
require_once __DIR__ . '/config/config.php';

// Fetch Posts
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$stmt = $pdo->prepare("SELECT * FROM posts WHERE slug = ?");
$stmt->execute([$slug]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

// Validate Posts
if (!$post) { die("Post not found!"); }

// Set SEO Variables
$page_title = $post['title'];
$page_description = $post['description'];
$og_image = $base_url . '/' . ltrim($post['image'], '/');
$date = isset($post['date']) ? date('d F Y', strtotime($post['date'])) : date('d F Y');

// Includes
include 'includes/header.php'; 
include 'includes/navigation.php';
?>

<!-- Hero Section -->
<header class="relative min-h-screen flex items-center pt-20">
    <div class="absolute inset-0 z-0 overflow-hidden">
        <img src="<?php echo $path_prefix . $post['image']; ?>" alt="<?= htmlspecialchars($post['title']) ?>" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-black/30"></div>
    </div>
</header>

<!-- Content Writing Section -->
<main class="py-16">
    <div class="page-container">
        <div class="mb-10">
            <span class="text-orange-600 font-bold tracking-wider text-base md:text-xl"><?= htmlspecialchars($post['type']) ?></span>
            <h1 class="text-2xl md:text-6xl font-bold text-gray-900 mt-2 mb-8 leading-tight md:leading-tight"><?= htmlspecialchars($post['title']) ?></h1>  
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-8 border-b border-gray-200">
                <div class="flex justify-between md:justify-start items-center w-full md:w-auto gap-6 text-gray-600 text-sm">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-user-circle text-xs md:text-base text-orange-500"></i>
                        <span>Created by <strong>Admin</strong></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-calendar-alt text-xs md:text-base text-orange-500"></i>
                        <span><?= date("F j, Y", strtotime($date)) ?></span>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <a href="https://www.facebook.com/" target="_blank" rel="noopener noreferrer" class="w-6 h-6 md:w-8 md:h-8 rounded-full bg-gray-100 hover:bg-orange-500 hover:text-white flex items-center justify-center transition"><i class="fab fa-facebook-f text-xs md:text-sm"></i></a>
                    <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" class="w-6 h-6 md:w-8 md:h-8 rounded-full bg-gray-100 hover:bg-orange-500 hover:text-white flex items-center justify-center transition"><i class="fab fa-instagram text-xs md:text-sm"></i></a>
                    <a href="https://www.tiktok.com/" target="_blank" rel="noopener noreferrer" class="w-6 h-6 md:w-8 md:h-8 rounded-full bg-gray-100 hover:bg-orange-500 hover:text-white flex items-center justify-center transition"><i class="fab fa-tiktok text-xs md:text-sm"></i></a>
                    <a href="https://www.linkedin.com/" target="_blank" rel="noopener noreferrer" class="w-6 h-6 md:w-8 md:h-8 rounded-full bg-gray-100 hover:bg-orange-500 hover:text-white flex items-center justify-center transition"><i class="fab fa-linkedin-in text-xs md:text-sm"></i></a>
                    <a href="https://www.youtube.com/" target="_blank" rel="noopener noreferrer" class="w-6 h-6 md:w-8 md:h-8 rounded-full bg-gray-100 hover:bg-orange-500 hover:text-white flex items-center justify-center transition"><i class="fab fa-youtube text-xs md:text-sm"></i></a>
                </div>
            </div>
        </div>
        <div class="max-w-none text-gray-700 leading-relaxed text-sm md:text-lg content-editor">
            <?= $post['content'] ?>
        </div>
    </div>
    <div class="flex justify-center mt-12">
        <button onclick="sessionStorage.setItem('scrollToFilter', 'true'); history.back();" class="flex items-center gap-1.5 md:gap-2 px-5 py-2 md:px-8 md:py-3 bg-gray-900 text-white rounded-full hover:bg-orange-600 transition-all duration-300 font-semibold shadow-lg text-xs md:text-base">
            <i class="fas fa-arrow-left text-[10px] md:text-xs"></i>
            Go Back
        </button>
    </div>
</main>

<!-- Load Main JavaScript File -->
<script src="<?php echo $path_prefix; ?>static/js/main.js"></script>

<?php 
include 'includes/whatsapp.php'; 
include 'includes/footer.php';
?>