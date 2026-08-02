<?php 
$page_title = "Our Products"; 
$page_description = "Lorem ipsum...";

// Includes
include 'includes/header.php'; 
include 'includes/navigation.php';

// Data Product
$products = [
    [
        'id' => 1,
        'name' => "CloudTV Smart 4K AXVE-NET Ultimate Edition Pro",
        'subtitle' => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.",
        'price' => "$257",
        'image' => "public/assets/product/product1.webp",
        'desc' => "Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Integer in feugiat libero. Sed a diam nec sapien accumsan auctor. Curabitur vel purus sit amet ligula feugiat vestibulum. Duis auctor leo in tellus tincidunt, non fermentum nisl pharetra. Proin ut elit non lacus laoreet tincidunt vel at lacus. Nunc imperdiet risus vel erat commodo, a feugiat erat cursus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Mauris sollicitudin vitae magna vel finibus. Sed interdum libero non tortor tempor, vel gravida urna tincidunt. Aliquam erat volutpat. Integer malesuada, nunc nec gravida vestibulum, risus sapien sagittis nisl, ac pretium libero sem nec eros."
    ],
    [
        'id' => 2,
        'name' => "CloudRadio Smart Hi-Fi Sound System Wireless",
        'subtitle' => "Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex.",
        'price' => "$45",
        'image' => "public/assets/product/product2.webp",
        'desc' => "Fusce ac felis sit amet ligula pharetra sollicitudin. Proin euismod, mauris vel facilisis facilisis, nisl velit tristique elit, nec congue nisi sem ut ante. Nam vitae tortor vitae sapien consequat tincidunt. Mauris consectetur est at purus suscipit, at auctor lorem malesuada. Quisque a mauris eu nunc interdum malesuada vel vel lorem. Phasellus venenatis, nulla sit amet laoreet auctor, purus metus scelerisque purus, vel facilisis nisi elit et turpis. Sed nec ex vitae felis laoreet finibus. Ut ut dui vel mi vehicula dapibus ac in lectus. Suspendisse potenti. Integer vitae auctor libero, vel auctor nunc."
    ],
    [
        'id' => 3,
        'name' => "CloudPhone Series SSR (2026) Flagship Edition",
        'subtitle' => "Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu aute fugiat.",
        'price' => "$187",
        'image' => "public/assets/product/product3.webp",
        'desc' => "Morbi accumsan velit vel ligula ultrices, in scelerisque dui convallis. Curabitur euismod ligula ut magna sollicitudin, ut vehicula sapien imperdiet. Aliquam erat volutpat. Sed nec sapien ut nunc elementum gravida. Nulla facilisi. Praesent luctus eros ut nunc fermentum, nec volutpat nisi auctor. Vivamus id justo vitae velit cursus imperdiet. Integer sit amet odio ac nisi posuere consectetur. Cras quis ante quis magna malesuada sodales. Donec et magna quis lacus ultrices rhoncus in non nunc. Integer vel malesuada eros. Aliquam erat volutpat."
    ],
    [
        'id' => 4,
        'name' => "CloudWatch Smart Series PR Premium Edition",
        'subtitle' => "Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim.",
        'price' => "$77",
        'image' => "public/assets/product/product4.webp",
        'desc' => "Integer ac orci vel magna facilisis vehicula vel et est. Aliquam id neque ac libero malesuada volutpat. Proin et quam vel nulla finibus tempor. Vestibulum eu dui et purus pulvinar placerat ac vitae nisl. Curabitur sit amet urna vitae ante tincidunt egestas. Phasellus non est at turpis ullamcorper egestas. Maecenas tristique dui et purus varius, id dictum justo volutpat. Sed vulputate sapien quis ante varius, eget aliquet tortor facilisis. Integer eget odio vitae velit volutpat vulputate. Donec sit amet metus at dolor ultricies auctor."
    ],
    [
        'id' => 5,
        'name' => "CloudPod Smart Series XS Wireless Edition",
        'subtitle' => "Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium.",
        'price' => "$45",
        'image' => "public/assets/product/product5.webp",
        'desc' => "Nullam in dui mauris. Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus. Mauris iaculis porttitor posuere. Praesent id metus massa, ut blandit odio. Proin quis tortor orci. Etiam at risus et justo dignissim congue. Donec congue lacinia dui, a porttitor lectus condimentum laoreet. Nunc eu ullamcorper orci."
    ],
    [
        'id' => 6,
        'name' => "CloudHeadset Series X1 Sound Studio Master",
        'subtitle' => "Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia, totam",
        'price' => "$51",
        'image' => "public/assets/product/product6.webp",
        'desc' => "Aliquam tincidunt urna vel turpis vehicula, et ultrices diam lobortis. Proin at elit nec velit tincidunt malesuada sit amet ac felis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Quisque auctor, erat et tincidunt tincidunt, dui nisl tincidunt felis, nec tempor eros magna at risus. Vivamus quis facilisis sem. Curabitur ac est et ligula scelerisque imperdiet. Nam vitae urna a odio tempor finibus. Sed at felis nec lacus tincidunt tincidunt. Sed tincidunt dui ac nulla consectetur, vel consectetur libero malesuada. Integer ac libero vel lorem pretium tincidunt."
    ]
];
?>

<!-- Hero Section -->
<header class="relative min-h-screen flex items-start md:items-center pt-20 overflow-hidden">
    <div class="absolute inset-0 z-0 overflow-hidden">
        <img src="public/assets/banners/banner-products.webp" alt="Headline Image" class="w-full h-full object-cover hidden md:block">
        <img src="public/assets/banners/banner-products-mobile.webp" alt="Headline Image" class="w-full h-full object-cover block md:hidden">    
        <div class="absolute inset-0 bg-black/30"></div>
    </div>
    <div class="page-container relative z-10 text-white w-full pt-10 md:pt-0">
        <div class="bg-white/70 backdrop-blur-xl border border-white/20 p-8 md:p-12 rounded-3xl text-gray-900 w-full max-w-2xl min-h-[300px] md:min-h-[360px] flex flex-col justify-start shadow-2xl">
            <h1 class="text-[22px] md:text-4xl mb-4 font-bold leading-snug md:leading-snug">Our Products</h1>
            <p class="text-sm md:text-xl mb-6 leading-relaxed text-gray-800">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer facilisis, sapien vitae tincidunt gravida, nunc erat convallis risus, sed faucibus libero purus vitae lectus. Curabitur vel justo non nibh feugiat posuere.</p>
        </div>
    </div>
</header>

<!-- Products Carousel Section -->
<section class="py-0 pt-20 bg-white overflow-hidden">
    <div class="page-container mb-16">
        <div class="flex flex-col md:flex-row md:items-end justify-between">
            <div class="text-center md:text-left">
                <h2 class="text-xl md:text-3xl font-bold text-gray-900 mb-4">Explore Our Products</h2>
                <p class="text-gray-600 text-sm md:text-lg">Lorem ipsum dolor sit amet, consectetur elit.</p>
            </div>
            <div class="hidden md:flex items-center gap-2 mt-6 md:mt-0 justify-center">
                <button onclick="scrollSlider('left')" class="bg-black hover:bg-gray-800 text-white w-10 h-10 rounded-full flex items-center justify-center transition cursor-pointer shadow-sm">
                    <i class="fas fa-chevron-left text-sm"></i>
                </button>
                <button onclick="scrollSlider('right')" class="bg-black hover:bg-gray-800 text-white w-10 h-10 rounded-full flex items-center justify-center transition cursor-pointer shadow-sm">
                    <i class="fas fa-chevron-right text-sm"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="page-container">
        <div id="product-slider" class="flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory no-scrollbar">
            <?php foreach ($products as $product): ?>
                <div class="w-full min-w-full md:w-[calc(33.333%-16px)] md:min-w-[calc(33.333%-16px)] flex-shrink-0 snap-start flex flex-col group cursor-pointer bg-white p-6 rounded-2xl border border-gray-200 transition duration-300 shadow-sm"
                     onclick="openProductModal(<?= $product['id'] ?>)">  
                    <div class="aspect-[1/1] overflow-hidden rounded-xl bg-gray-50 p-2 flex items-center justify-center mb-4">
                        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" 
                             class="w-full h-full object-cover rounded-lg group-hover:scale-105 transition duration-500" 
                             onerror="this.src='https://placehold.co/1080x1080/ccc/white?text=Product'">
                    </div>
                    <div class="text-center flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-base md:text-lg font-bold text-gray-900 mb-1 tracking-tight line-clamp-1"><?= htmlspecialchars($product['name']) ?></h3>
                            <p class="text-xs md:text-xs text-gray-600 line-clamp-2 leading-relaxed"><?= htmlspecialchars($product['subtitle']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Product Video Section -->
<section class="py-20 bg-white">
    <div class="page-container">
        <div class="bg-black p-8 md:p-16 rounded-3xl">
            <div class="flex flex-col md:flex-row md:items-start items-center gap-12">
                <div class="w-full md:w-1/2">
                    <div class="overflow-hidden rounded-xl shadow-xl bg-white border border-gray-400 aspect-[16/9]">
                        <img src="public/assets/product/video.gif" alt="Product Video Showcase" class="w-full h-full object-cover" onerror="this.src='https://placehold.co/1080x608/ccc/white?text=Product+Video'">
                    </div>
                </div>
                <div class="w-full md:w-1/2 text-left">
                    <h2 class="text-center md:text-left text-xl md:text-3xl font-bold text-white mb-6">Get Closer to Our Innovation</h2>
                    <p class="text-center md:text-left text-gray-400 text-sm md:text-lg mb-4">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore a magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.
                    </p>
                    <p class="text-center md:text-left text-gray-400 text-sm md:text-lg">
                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint eu velit occaecat cupidatat non proident.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pop-up Modal -->
<div id="productModal" class="hidden fixed inset-0 z-50 overflow-y-auto bg-black/70 p-4 flex items-center justify-center">
    <div class="bg-white/90 backdrop-blur border border-white/30 rounded-2xl w-full max-w-5xl md:max-w-6xl p-5 md:p-12 relative shadow-2xl flex flex-col md:flex-row md:items-stretch gap-6 md:gap-12 my-auto h-[75vh] md:h-auto overflow-hidden">
        <div class="w-full md:w-1/2 flex justify-center items-center shrink-0">
            <div class="w-full aspect-[1/1] overflow-hidden rounded-2xl bg-gray-100 relative flex items-center justify-center">
                <img id="modal-img" src="" alt="Product" class="w-full h-full object-cover" onerror="this.src='https://placehold.co/1080x1080/ccc/white?text=Product'">
                <button onclick="prevProduct(event)" class="absolute left-2 top-1/2 -translate-y-1/2 z-10 text-gray-500 hover:text-gray-800 transition cursor-pointer p-2">
                    <i class="fas fa-chevron-left text-xl md:text-2xl"></i>
                </button> 
                <button onclick="nextProduct(event)" class="absolute right-2 top-1/2 -translate-y-1/2 z-10 text-gray-500 hover:text-gray-800 transition cursor-pointer p-2">
                    <i class="fas fa-chevron-right text-xl md:text-2xl"></i>
                </button>
            </div>
        </div>
        <div class="w-full md:w-1/2 flex flex-col justify-between overflow-hidden">
            <div class="flex flex-col items-start justify-start w-full h-full overflow-hidden">
                <h2 id="modal-title" class="text-base md:text-4xl font-bold mb-1 md:mb-2 text-gray-900 md:line-clamp-2"></h2>
                <p id="modal-price" class="text-sm md:text-2xl font-bold text-orange-500 mb-2 md:mb-4"></p>
                <div class="h-20 md:h-64 overflow-y-auto w-full pr-2 mb-4 md:mb-6 no-scrollbar">
                    <div id="modal-desc" class="text-xs md:text-lg text-gray-600 leading-relaxed text-left"></div>
                </div>
                <div class="flex items-center w-full mt-auto">
                    <a href="https://shopee.co.id/" target="_blank" rel="noopener noreferrer" class="bg-orange-500 text-white w-full lg:w-full px-5 md:px-6 py-2.5 md:py-3 rounded-xl font-semibold hover:bg-orange-600 transition shadow-lg text-xs md:text-sm text-center block">Buy Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inject PHP Data to Global JavaScript Variables -->
<script>
    const allProducts = <?= json_encode($products) ?>;
</script>

<!-- Load Main JavaScript File -->
<script src="<?php echo $path_prefix; ?>static/js/main.js"></script>

<?php 
include 'includes/whatsapp.php'; 
include 'includes/footer.php';
?>