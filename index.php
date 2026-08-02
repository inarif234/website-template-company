<?php 
$page_title = "Home"; 
$page_description = "Lorem ipsum...";

// Includes
include 'includes/header.php'; 
include 'includes/navigation.php';

// Database Connection
require_once __DIR__ . '/config/config.php';

// Database Processing
try {
    $stmt = $pdo->query("SELECT * FROM banners ORDER BY id DESC");
    $db_banners = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $db_banners = [];
}

// E-Banners (Default)
$default_slides = [
    [
        'desktop' => 'public/assets/banners/banner-home-desktop.webp',
        'mobile' => 'public/assets/banners/banner-home-mobile.webp',
        'title' => 'Lorem Ipsum Dolor Sit Amet Consectetur Elit',
        'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer facilisis, sapien vitae tincidunt gravida, nunc erat convallis risus, sed faucibus libero purus vitae lectus. Curabitur vel justo non nibh feugiat posuere.',
        'ctaLink' => '#order' // To disable button, comment out the line ... // 'ctaLink' => '#order'
    ],
];

// Database Components
if (!empty($db_banners)) {
    $slides = [];
    foreach ($db_banners as $b) {
        $slides[] = [
            'desktop' => $b['image_desktop'],
            'mobile' => $b['image_mobile'],
            'title' => $b['headline'],
            'desc' => $b['bodytext'],
            'ctaLink' => !empty($b['link']) ? $b['link'] : null
        ];
    }
} else {
    $slides = $default_slides;
}

// Data Retail Networks
$retail = [
    'logo1.png',
    'logo2.png',
    'logo3.png',
    'logo4.png',
    'logo5.png',
    'logo6.png',
    'logo7.png',
    'logo8.png',
    'logo9.png',
    'logo10.png',
    'logo11.png',
    'logo12.png',
    'logo13.png',
    'logo14.png',
    'logo15.png'
];

// Data Logo Partners
$partners = [
    'logo1.png',
    'logo2.png',
    'logo3.png',
    'logo4.png',
    'logo5.png',
    'logo6.png',
    'logo7.png',
    'logo8.png',
    'logo9.png',
    'logo10.png',
    'logo11.png',
    'logo12.png',
    'logo13.png',
    'logo14.png',
    'logo15.png'
];

// Data Online Stores
$stores = [
    [
        'name' => 'Shopee',
        'img' => 'public/assets/online-store/shopee.png',
        'url' => 'https://shopee.co.id/'
    ],
    [
        'name' => 'Tokopedia',
        'img' => 'public/assets/online-store/tokopedia.png',
        'url' => 'https://www.tokopedia.com/'
    ],
    [
        'name' => 'TikTok <span class="font-normal">Shop</span>',
        'img' => 'public/assets/online-store/tiktok.png',
        'url' => 'https://www.tiktok.com/'
    ],
    [
        'name' => 'BliBli',
        'img' => 'public/assets/online-store/blibli.png',
        'url' => 'https://www.blibli.com/'
    ]
];

// Data User Reviews
$reviews = [
    [
        'img' => 'public/assets/user/user1.webp', 
        'name' => 'Alex Johnson', 
        'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer efficitur, magna sed cursus facilisis, justo lacus tincidunt tortor, vitae vulputate risus orci non purus.'
    ],
    [
        'img' => 'public/assets/user/user2.webp', 
        'name' => 'Sarah Smith', 
        'text' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.'
    ],
    [
        'img' => 'public/assets/user/user3.webp', 
        'name' => 'Michael Brown', 
        'text' => 'Curabitur vitae ligula vel magna dictum pellentesque. Integer vulputate erat a urna tempor malesuada. Vivamus ac magna vel dui auctor vulputate.'
    ],
    [
        'img' => 'public/assets/user/user4.webp', 
        'name' => 'Jessica Taylor', 
        'text' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis.'
    ]
];
?>

<!-- Hero Section -->
<header id="hero-section" class="relative min-h-screen flex items-start md:items-center pt-20 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img id="hero-img-mobile" src="" alt="Headline Image" class="w-full h-full object-cover block md:hidden">
        <img id="hero-img-desktop" src="" alt="Headline Image" class="w-full h-full object-cover object-center hidden md:block">
        <div class="absolute inset-0 bg-black/30"></div>
    </div>
    <div class="page-container relative z-10 text-white w-full pt-10 md:pt-0">
        <div class="bg-white/70 backdrop-blur-xl border border-white/20 p-8 md:p-12 rounded-3xl text-gray-900 w-full max-w-2xl min-h-[310px] md:min-h-[350px] flex flex-col justify-between shadow-2xl">
            <div>
                <h1 id="hero-title" class="text-[22px] md:text-4xl mb-4 font-bold leading-snug md:leading-snug"></h1>
                <p id="hero-desc" class="text-sm md:text-xl mb-6 leading-relaxed text-gray-800"></p>
            </div>
            <div id="cta-container">
                <a id="hero-cta" href="#" class="inline-block bg-orange-500 text-white px-6 py-3 rounded-full font-semibold hover:bg-orange-600 transition shadow-lg">Open Now</a>
            </div>
        </div>
    </div>
    <button id="prev-btn" class="hidden md:flex absolute left-10 z-20 text-white bg-black/30 hover:bg-black/50 w-12 h-12 rounded-full items-center justify-center backdrop-blur-sm transition">
        <i class="fas fa-chevron-left text-xl"></i>
    </button>
    <button id="next-btn" class="hidden md:flex absolute right-10 z-20 text-white bg-black/30 hover:bg-black/50 w-12 h-12 rounded-full items-center justify-center backdrop-blur-sm transition">
        <i class="fas fa-chevron-right text-xl"></i>
    </button>
    <div id="dots-container" class="absolute bottom-10 left-1/2 transform -translate-x-1/2 z-20 flex gap-2"></div>
</header>

<!-- Our Partners -->
<section class="py-20 bg-white overflow-hidden">
    <div class="page-container mb-8 text-center">
        <h2 class="text-xl md:text-3xl font-bold text-center mb-4">Partners</h2>
        <p class="text-center text-gray-600 mx-auto mb-16 text-sm md:text-lg">Lorem ipsum dolor sit amet, consectetur elit.</p>
    </div>
    <div class="swiper partner-swiper w-full">
        <div class="swiper-wrapper">
            <?php foreach ($partners as $logo): ?>
                <div class="swiper-slide flex items-center justify-center p-4">
                    <img src="public/assets/partners/<?php echo $logo; ?>" 
                         alt="Partners <?php echo str_replace('.png', '', $logo); ?>"
                         class="h-16 md:h-20 w-auto object-contain grayscale hover:grayscale-0 transition duration-500">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Online Store Section -->
<section id="order" class="py-20 bg-white">
    <div class="page-container">
        <h2 class="text-xl md:text-3xl font-bold text-center mb-4">E-Commerce</h2>
        <p class="text-center text-gray-600 mx-auto mb-16 text-sm md:text-lg">Lorem ipsum dolor sit amet, consectetur elit.</p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">
            <?php foreach ($stores as $store): ?>
                <div class="p-4 md:p-8 border border-gray-200 rounded-2xl hover:border-orange-500 transition flex flex-col items-center text-center">
                    <img src="<?php echo $store['img']; ?>" alt="Store" class="w-12 h-12 md:w-16 md:h-16 mb-4 md:mb-6 object-contain rounded-xl">
                    <h3 class="text-xs md:text-base font-bold mb-4"><?php echo $store['name']; ?></h3>
                    <a href="<?php echo $store['url']; ?>" target="_blank" class="w-full py-2.5 md:py-3 bg-gray-900 text-white rounded-xl hover:bg-orange-500 transition text-center text-sm md:text-base">Visit Store</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- User Review Section -->
<section class="py-20 bg-gray-100">
    <div class="page-container">
        <h2 class="text-xl md:text-3xl font-bold text-center mb-4">User Review</h2>
        <p class="text-center text-gray-600 mx-auto mb-16 text-sm md:text-lg">Lorem ipsum dolor sit amet, consectetur elit.</p>
        <div class="w-full bg-white rounded-3xl p-6 md:p-10 border border-gray-200 hover:border-orange-500 transition h-[420px] md:h-[340px] flex flex-col justify-between">
            <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6 text-center sm:text-left">
                <img id="review-img" src="" alt="User Review" class="w-20 h-20 rounded-full object-cover shrink-0 mx-auto sm:mx-0">
                <div class="w-full">
                    <p id="review-text" class="text-gray-700 text-sm md:text-lg italic"></p>
                </div>
            </div>
            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                <h4 id="review-name" class="font-bold text-gray-900 text-sm md:text-lg"></h4>
                <div class="flex gap-2">
                    <button id="review-prev" class="bg-orange-500 hover:bg-orange-600 text-white w-10 h-10 rounded-full flex items-center justify-center transition cursor-pointer">
                        <i class="fas fa-chevron-left text-sm"></i>
                    </button>
                    <button id="review-next" class="bg-orange-500 hover:bg-orange-600 text-white w-10 h-10 rounded-full flex items-center justify-center transition cursor-pointer">
                        <i class="fas fa-chevron-right text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Retail Network Section -->
<section class="py-20 bg-white">
    <div class="page-container">
        <h2 class="text-xl md:text-3xl font-bold text-center mb-4">Retail Network</h2>
        <p class="text-center text-gray-600 mx-auto mb-16 text-sm md:text-lg">Lorem ipsum dolor sit amet, consectetur elit.</p>
        <div class="grid grid-cols-3 md:grid-cols-5 gap-6">
            <?php foreach ($retail as $logo): ?>
                <div class="h-24 rounded-2xl flex items-center justify-center p-4">
                    <img src="public/assets/offline-store/<?php echo $logo; ?>" 
                         alt="Logo <?php echo str_replace('.png', '', $logo); ?>" 
                         class="max-h-full w-auto object-contain">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Our Place Section-->
<section class="py-20 bg-white">
    <div class="page-container">
        <h2 class="text-xl md:text-3xl font-bold text-center mb-6">Locations</h2>
        <p class="text-center text-gray-600 mx-auto mb-16 text-sm md:text-lg">Lorem ipsum dolor sit amet, consectetur elit.</p>
        <div class="w-full max-w-4xl mx-auto aspect-[4/2] flex items-center justify-center overflow-hidden">
            <img src="public/assets/place/indonesia.png" alt="Headline Image" class="w-full h-full object-contain">
        </div>
    </div>
</section>

<!-- Inject PHP Data to Global JavaScript Variables -->
<script>
    const slides = <?php echo json_encode($slides); ?>;
    const reviews = <?php echo json_encode($reviews); ?>;
</script>

<!-- Load Main JavaScript File -->
<script src="<?php echo $path_prefix; ?>static/js/main.js"></script>

<?php 
include 'includes/whatsapp.php'; 
include 'includes/footer.php';
?>