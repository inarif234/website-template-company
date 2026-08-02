<?php
// Data Page Website
$menu = [
    ['url' => 'about',  'label' => 'About Us'],
    ['url' => 'products', 'label' => 'Our Products'],
    ['url' => 'blog',   'label' => 'Blog'],
    ['url' => 'career', 'label' => 'Career']
];
?>

<!-- Navigation -->
<nav class="fixed w-full z-50 bg-black/85 backdrop-blur-md border-b border-gray-800 text-white">
    <div class="page-container flex items-center justify-between py-2.5 md:py-4">
        <a href="<?= $path_prefix ?>index.php" class="flex items-center gap-2.5 hover:opacity-80 transition">
            <img src="<?= $path_prefix ?>public/assets/logo/logo.png" alt="Headline Image" class="w-8 h-8 md:w-10 md:h-10 object-contain">
            <span class="text-base md:text-xl font-normal">Company</span> 
        </a>
        <button id="mobile-menu-button" class="md:hidden text-lg p-1"><i class="fas fa-bars"></i></button>
        <div id="nav-links" class="hidden md:flex flex-col md:flex-row absolute md:relative top-full left-0 w-full md:w-auto bg-black/95 md:bg-transparent p-4 md:p-0 font-medium text-center md:text-left gap-y-2 md:gap-x-8 border-b border-gray-800 md:border-none shadow-lg md:shadow-none">
            <?php foreach ($menu as $item) : ?>
                <a href="<?= $path_prefix . $item['url'] ?>" class="text-sm md:text-lg hover:text-orange-500 transition block py-2 md:py-0">
                    <?= $item['label'] ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</nav>