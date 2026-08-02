<?php 
$page_title = "Blog"; 
$page_description = "Lorem ipsum...";

// Includes
include 'includes/header.php'; 
include 'includes/navigation.php';

// Database Connection
require_once __DIR__ . '/config/config.php';

// Filter Category
$stmt_cats = $pdo->query("SELECT DISTINCT type FROM posts");
$categories = $stmt_cats->fetchAll(PDO::FETCH_COLUMN);
?>
    
<!-- Hero Section -->
<header class="relative min-h-screen flex items-start md:items-center pt-20 overflow-hidden">
    <div class="absolute inset-0 z-0 overflow-hidden">
        <img src="public/assets/banners/banner-blog.webp" alt="Headline Image" class="w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-black/30"></div>
    </div>
    <div class="page-container relative z-10 text-white w-full pt-10 md:pt-0">
        <div class="bg-white/70 backdrop-blur-xl border border-white/20 p-8 md:p-12 rounded-3xl text-gray-900 w-full max-w-2xl min-h-[300px] md:min-h-[360px] flex flex-col justify-start shadow-2xl">
            <h1 class="text-[22px] md:text-4xl mb-4 font-bold leading-snug md:leading-snug">Blog</h1>
            <p class="text-sm md:text-xl mb-6 leading-relaxed text-gray-800">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer facilisis, sapien vitae tincidunt gravida, nunc erat convallis risus, sed faucibus libero purus vitae lectus. Curabitur vel justo non nibh feugiat posuere.</p>
        </div>
    </div>
</header>

<!-- Filter Section -->
<section id="filter-section" class="pt-20 pb-0 bg-white">
    <div class="page-container">
        <div class="max-w-2xl mx-auto">
            <div id="category-filter" class="flex flex-nowrap overflow-x-auto whitespace-nowrap justify-start md:flex-wrap md:justify-center gap-2 text-sm md:gap-3 md:text-lg px-4 md:px-0 [&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
                <button onclick="setCategory('all', this)" class="filter-btn shrink-0 bg-white border border-gray-200 hover:border-orange-500 hover:text-orange-600 px-4 py-2 rounded-full font-semibold transition-all">All</button>
                <?php foreach ($categories as $cat): ?>
                    <button onclick="setCategory('<?= $cat ?>', this)" class="filter-btn shrink-0 bg-white border border-gray-200 hover:border-orange-500 hover:text-orange-600 px-4 py-2 rounded-full font-semibold transition-all">
                        <?= ucfirst($cat) ?>
                    </button>
                <?php endforeach; ?>
            </div>
            <div class="mt-8 flex justify-center">
                <input type="text" id="search-input" onkeyup="debounceSearch()" placeholder="Searching..." class="w-full px-6 py-3 rounded-full border border-gray-300 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500 transition-all">
            </div>
        </div>
    </div>
</section>

<!-- Blog Grid -->
<section class="py-20 bg-white">
    <div class="page-container">
        <div id="blog-grid" class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-8"></div>
    </div>
</section>

<!-- Load Main JavaScript File -->
<script src="<?php echo $path_prefix; ?>static/js/main.js"></script>

<?php 
include 'includes/whatsapp.php'; 
include 'includes/footer.php';
?>