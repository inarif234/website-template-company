<?php 
$page_title = "About Us";
$page_description = "Lorem ipsum...";

// Includes
include 'includes/header.php'; 
include 'includes/navigation.php';

// Data Milestone
$timeline_data = [
    ['year' => '2016', 'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.'],
    ['year' => '2018', 'desc' => 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae.'],
    ['year' => '2020', 'desc' => 'Integer facilisis sapien vitae augue tincidunt, sed fermentum lorem convallis.'],
    ['year' => '2021', 'desc' => 'Curabitur non lorem nec arcu gravida efficitur vel sed sapien.'],
    ['year' => '2022', 'desc' => 'Praesent vitae tortor eget justo malesuada tincidunt et vitae erat.'],
    ['year' => '2023', 'desc' => 'Suspendisse potenti. Phasellus consequat magna at nisi commodo vulputate.'],
    ['year' => '2024', 'desc' => 'Donec dictum nisl eget augue vulputate, vitae dignissim lorem pulvinar.'],
    ['year' => '2025', 'desc' => 'Mauris tincidunt lectus vel sem feugiat, vitae placerat justo efficitur.'],
    ['year' => '2026', 'desc' => 'Quisque finibus sapien nec lacus tincidunt, eget facilisis libero tristique.']
];

// Data Executive Team
$executives = [
    [
        'name' => 'David Chen',
        'role' => 'Chief Executive Officer',
        'img' => 'public/assets/profile/profile1.png',
        'quote' => 'Lorem Ipsum Dolor Sit Amet',
        'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer facilisis, sapien vitae tincidunt gravida, nunc erat convallis risus, sed faucibus libero purus vitae lectus.'
    ],
    [
        'name' => 'John Doe',
        'role' => 'Chief Operating Office',
        'img' => 'public/assets/profile/profile2.png',
        'quote' => 'Lorem Ipsum Dolor Sit Amet',
        'desc' => 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit.'
    ],
    [
        'name' => 'Jane Smith',
        'role' => 'Chief Technology Officer',
        'img' => 'public/assets/profile/profile3.png',
        'quote' => 'Lorem Ipsum Dolor Sit Amet',
        'desc' => 'Curabitur vitae ligula vel magna dictum pellentesque. Integer vulputate erat a urna tempor malesuada. Vivamus ac magna dictum pellentesque.vel dui auctor vulputate.'
    ]
];

// Data Our Values
$values = [
    ['fas fa-chart-line', 'Excellence', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer facilisis sapien vitae augue tincidunt, sed convallis lorem volutpat.'],
    ['fas fa-lightbulb', 'Innovation', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vitae justo nec augue posuere, non faucibus sapien efficitur.'],
    ['fas fa-users', 'Collaboration', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum luctus risus vel magna suscipit, sed tincidunt erat facilisis.'],
    ['fas fa-handshake', 'Integrity', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent euismod, lorem sed vulputate tincidunt, risus augue commodo erat.']
];
?>


<!-- Hero Section -->
<header class="relative min-h-screen flex items-start md:items-center pt-20 overflow-hidden">
    <div class="absolute inset-0 z-0 overflow-hidden">
        <img src="public/assets/banners/banner-about.webp" alt="Headline Image" class="w-full h-full object-cover hidden md:block">
        <img src="public/assets/banners/banner-about-mobile.webp" alt="Headline Image" class="w-full h-full object-cover object-center block md:hidden">
        <div class="absolute inset-0 bg-black/30"></div>
    </div>
    <div class="page-container relative z-10 text-white w-full pt-10 md:pt-0">
        <div class="bg-white/70 backdrop-blur-xl border border-white/20 p-8 md:p-12 rounded-3xl text-gray-900 w-full max-w-2xl min-h-[300px] md:min-h-[360px] flex flex-col justify-start shadow-2xl">
            <h1 class="text-[22px] md:text-4xl mb-4 font-bold leading-snug md:leading-snug">About Us</h1>
            <p class="text-sm md:text-xl mb-6 leading-relaxed text-gray-800">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer facilisis, sapien vitae tincidunt gravida, nunc erat convallis risus, sed faucibus libero purus vitae lectus. Curabitur vel justo non nibh feugiat posuere.</p>
        </div>
    </div>
</header>

<!-- Milestone Section -->
<section id="history" class="py-20 bg-white">
    <div class="page-container">
        <div class="text-center mb-16 relative flex items-center justify-center">
            <svg class="absolute w-20 md:w-28 text-orange-500/10 pointer-events-none select-none" fill="currentColor" viewBox="0 0 24 24">
                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.998v10h-9.998z"/>
            </svg>
            <h2 class="text-xl md:text-3xl md:text-4xl font-bold text-gray-900 relative z-10">Your Tagline</h2>
        </div>
        <h2 class="text-xl md:text-3xl font-bold text-center mb-16 hidden">Milestone</h2>
        <div class="overflow-x-auto pb-10 scrollbar-hide">
            <div class="relative flex items-start gap-8 w-max min-w-full">
                <div class="absolute top-2 left-[120px] right-[120px] h-0.5 bg-orange-300 z-0"></div>
                <?php foreach ($timeline_data as $item) : ?>
                    <div class="flex flex-col items-center flex-shrink-0 w-60">
                        <div class="w-full flex justify-center items-center h-4 mb-4 relative z-10">
                            <div class="bg-white px-4 h-full flex items-center">
                                <div class="w-3 h-3 rounded-full bg-orange-600"></div>
                            </div>
                        </div>
                        <div class="bg-orange-50 p-6 rounded-xl border border-orange-100 shadow-sm w-full h-48 text-center flex flex-col justify-start">
                            <span class="text-orange-600 font-bold text-lg md:text-xl block mb-2"><?= $item['year'] ?></span>
                            <p class="text-sm md:text-base text-gray-700 leading-tight"><?= $item['desc'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Executive Team Section -->
<section id="executive-team" class="py-20 bg-gray-100">
    <div class="page-container">
        <div class="text-center mb-16">
            <h2 class="text-xl md:text-3xl font-bold text-gray-900 mb-4">Executive Team</h2>
            <p class="text-gray-600 text-sm md:text-lg">Lorem ipsum dolor sit amet, consectetur elit.</p>
        </div>
        <div class="w-full">
            <div id="director-slider" class="overflow-hidden">
                <?php foreach ($executives as $index => $exec) : ?>
                    <div class="director-slide <?= $index === 0 ? '' : 'hidden' ?> transition-all duration-300">
                        <div class="w-full bg-white rounded-3xl border border-gray-200 hover:border-orange-500 transition p-8 md:p-12 shadow-sm grid grid-cols-1 md:grid-cols-12 gap-8 md:gap-12 items-center">
                            <div class="md:col-span-4 max-w-xs mx-auto w-full">
                                <div class="overflow-hidden rounded-2xl aspect-square">
                                    <img src="<?= $exec['img'] ?>" alt="<?= $exec['name'] ?>" class="w-full h-full object-cover object-top">
                                </div>
                            </div>
                            <div class="md:col-span-8 flex flex-col justify-center">
                                <h3 class="text-xl md:text-3xl font-bold text-gray-900 mb-1 tracking-tight"><?= $exec['name'] ?></h3>
                                <p class="text-orange-600 font-semibold text-base md:text-xl mb-4"><?= $exec['role'] ?></p> 
                                <div class="border-l-4 border-orange-500 pl-4 md:pl-6">
                                    <p class="text-gray-900 text-xs md:text-lg leading-relaxed font-bold mb-2"><?= $exec['quote'] ?></p>
                                    <p class="text-gray-600 text-xs md:text-lg leading-relaxed"><?= $exec['desc'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="flex items-center justify-between mt-8 px-2">
                <div class="flex gap-2" id="director-dots">
                    <?php foreach ($executives as $index => $exec) : ?>
                        <button onclick="switchDirectorSlide(<?= $index ?>)" class="director-dot <?= $index === 0 ? 'bg-orange-500 w-10' : 'bg-gray-300 w-3' ?> h-3 rounded-full transition-all cursor-pointer"></button>
                    <?php endforeach; ?>
                </div>
                <div class="flex gap-2">
                    <button onclick="prevDirectorSlide()" class="bg-orange-500 hover:bg-orange-600 text-white w-10 h-10 rounded-full flex items-center justify-center transition cursor-pointer">
                        <i class="fas fa-chevron-left text-sm"></i>
                    </button>
                    <button onclick="nextDirectorSlide()" class="bg-orange-500 hover:bg-orange-600 text-white w-10 h-10 rounded-full flex items-center justify-center transition cursor-pointer">
                        <i class="fas fa-chevron-right text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Vision & Mission Section -->
<section class="py-20 bg-white">
    <div class="page-container">
        <div class="text-center mb-16">
            <h2 class="text-xl md:text-3xl font-bold text-gray-900 mb-4">Vision and Mission</h2>
            <p class="text-gray-600 text-sm md:text-lg">Lorem ipsum dolor sit amet, consectetur elit.</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-white p-10 rounded-2xl border border-gray-200 hover:border-orange-500 transition duration-300 flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">Vision</h3>
                <p class="text-gray-600 leading-relaxed text-sm md:text-lg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer facilisis sapien vitae erat tincidunt, sed convallis nunc tincidunt. Curabitur vitae lorem vel risus commodo posuere.</p>
            </div>
            <div class="bg-white p-10 rounded-2xl border border-gray-200 hover:border-orange-500 transition duration-300 flex flex-col items-center text-center">
                <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">Mission</h3>
                <p class="text-gray-600 leading-relaxed text-sm md:text-lg">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent suscipit, lectus vitae feugiat faucibus, lacus augue tincidunt orci, sed tincidunt lorem erat vel magna.</p>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-20 bg-white">
    <div class="page-container">
        <div class="bg-black p-8 md:p-16 rounded-3xl">
            <h2 class="text-xl md:text-3xl font-bold text-center mb-4 text-white">Values</h2>
            <p class="text-center text-gray-400 mx-auto mb-12 text-sm md:text-lg max-w-2xl">Lorem ipsum dolor sit amet, consectetur elit.</p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <?php foreach ($values as $v) : ?>
                <div class="bg-white p-8 rounded-2xl border border-gray-200 transition duration-300 flex flex-col items-center text-center h-full">
                    <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center mb-6">
                        <i class="<?= $v[0] ?> text-xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-4"><?= $v[1] ?></h3>
                    <p class="text-gray-600 leading-relaxed text-xs md:text-sm flex-grow"><?= $v[2] ?></p>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>

<!-- Load JavaScript -->
<script src="<?php echo $path_prefix; ?>static/js/main.js"></script>

<?php 
include 'includes/whatsapp.php'; 
include 'includes/footer.php';
?>