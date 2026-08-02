<?php 
$page_title = "Career"; 
$page_description = "Lorem ipsum...";

// Includes
include 'includes/header.php'; 
include 'includes/navigation.php';

// Data Email
require_once __DIR__ . '/config/career-config.php';

// Data Job Vacancies
$jobs = [
    [
        'category' => 'Creative',
        'title' => 'Graphic Design',
        'description' => 'Join our creative team. We welcome individuals who value creativity, innovation, and a passion for creating impactful work.',
        'requirements' => [
            '<strong>Education:</strong> Minimum Diploma (D3) or Bachelor\'s Degree (S1) in Visual Communication Design, Fine Arts, or a related field. Fresh graduates are encouraged to apply.',
            '<strong>Technical Skills:</strong> Proficient in Adobe Creative Suite, particularly Adobe Photoshop, Illustrator, and InDesign.',
            '<strong>Creativity:</strong> Possesses a strong portfolio demonstrating excellent design skills, with a solid understanding of composition, typography, and color theory.',
            '<strong>Digital Content:</strong> Familiar with current visual trends and best practices for social media platforms (Instagram, TikTok) and e-commerce marketplaces.',
            '<strong>Additional Advantage:</strong> Experience in videography or video editing (Adobe Premiere Pro, CapCut) and a basic understanding of digital illustration is a plus.'
        ],
        'responsibilities' => [
            'Create engaging visual content and promotional materials for social media, websites, and e-commerce platforms.',
            'Design and develop branding assets, including banners, packaging, catalogs, and other marketing materials.',
            'Collaborate closely with the Marketing team to translate campaign concepts into compelling and visually appealing designs.',
            'Ensure brand consistency across all digital and print communication channels.'
        ]
    ],
    [
        'category' => 'Marketing',
        'title' => 'Sales Marketing',
        'description' => 'Join our Sales Marketing team. We welcome individuals who are communicative, persistent, and target-driven.',
        'requirements' => [
            '<strong>Education:</strong> Minimum D3/Bachelor\'s degree in any field (Marketing, Communication, or Business is preferred).',
            '<strong>Experience:</strong> At least 1 year of experience in Sales or Marketing (Fresh graduates with strong motivation are welcome to apply).',
            '<strong>Communication Skills:</strong> Strong communication, negotiation, and presentation skills with a persuasive approach.',
            '<strong>Target-Oriented:</strong> Ability to work under pressure and achieve monthly sales targets.',
            '<strong>Mobility:</strong> Possess a valid driver\'s license (A/C), own a personal vehicle, and be willing to travel for business visits.'
        ],
        'responsibilities' => [
            'Identify new business opportunities and build relationships with potential clients.',
            'Maintain strong relationships and provide excellent service to both existing and prospective customers.',
            'Conduct product presentations and deliver sales proposals to prospective clients.',
            'Achieve monthly sales targets set by the company.',
            'Prepare daily and weekly activity reports while analyzing market trends and business opportunities.'
        ]
    ]
];
?>

<!-- Hero Section -->
<header class="relative min-h-screen flex items-start md:items-center pt-20 overflow-hidden">
    <!-- Banner Layer -->
    <div class="absolute inset-0 z-0 overflow-hidden">
        <img src="public/assets/banners/banner-career.webp" alt="Headline Image" class="w-full h-full object-cover hidden md:block">
        <img src="public/assets/banners/banner-career-mobile.webp" alt="Headline Image" class="w-full h-full object-cover object-center block md:hidden">
        <div class="absolute inset-0 bg-black/30"></div>
    </div>
    <!-- Content Layer -->
    <div class="page-container relative z-10 text-white w-full pt-10 md:pt-0">
        <div class="bg-white/70 backdrop-blur-xl border border-white/20 p-8 md:p-12 rounded-3xl text-gray-900 w-full max-w-2xl min-h-[300px] md:min-h-[360px] flex flex-col justify-start shadow-2xl">
            <h1 class="text-[22px] md:text-4xl mb-4 font-bold leading-snug md:leading-snug">Join Us</h1>
            <p class="text-sm md:text-xl mb-6 leading-relaxed text-gray-800">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer facilisis, sapien vitae tincidunt gravida, nunc erat convallis risus, sed faucibus libero purus vitae lectus. Curabitur vel justo non nibh feugiat posuere.</p>
        </div>
    </div>
</header>

<!-- Jobs Section -->
<section class="py-20 bg-white">
    <div class="page-container">
        <h2 class="text-3xl font-bold text-center mb-12">Current Job Vacancies</h2>
        <div class="space-y-4">
            <?php foreach ($jobs as $job): ?>
            <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden transition-all duration-300">
                <button onclick="toggleAccordion(this)" class="w-full flex items-center justify-between p-6 md:p-8 hover:bg-gray-50 transition">
                    <div class="text-left">
                        <span class="text-orange-600 font-semibold text-sm uppercase tracking-wider"><?= htmlspecialchars($job['category']) ?></span>
                        <h3 class="text-xl font-bold mt-1"><?= htmlspecialchars($job['title']) ?></h3>
                        <p class="text-gray-600 mt-2 text-xs md:text-base"><?= htmlspecialchars($job['description']) ?></p>
                    </div>
                    <div class="text-2xl text-gray-400">
                        <i class="fas fa-chevron-right transition-transform duration-300"></i>
                    </div>
                </button>
                <div class="accordion-content hidden px-6 md:px-8 pb-8 border-t border-gray-100 pt-6">
                    <div class="grid md:grid-cols-2 gap-2 md:gap-24">
                        <div>
                            <h4 class="font-bold text-lg mb-3">Requirements</h4>
                            <ul class="list-disc pl-5 text-gray-600 space-y-2 mb-6 text-xs   md:text-base">
                                <?php foreach ($job['requirements'] as $req): ?>
                                    <li><?= $req ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div>
                            <h4 class="font-bold text-lg mb-3">Responsibilities</h4>
                            <ul class="list-disc pl-5 text-gray-600 space-y-2 mb-6 text-xs md:text-base">
                                <?php foreach ($job['responsibilities'] as $resp): ?>
                                    <li><?= $resp ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="mt-6">
                        <button onclick="openModal('<?= htmlspecialchars($job['title'], ENT_QUOTES) ?>')" 
                                class="bg-orange-500 hover:bg-orange-600 text-white text-xs md:text-sm  font-bold py-3 px-8 rounded-xl transition duration-300">
                            Apply Now
                        </button>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Apply -->
<div id="applicationModal" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70">
    <div class="bg-white/90 backdrop-blur border border-white/30 rounded-2xl w-full max-w-lg p-8 shadow-2xl relative max-h-[90vh] overflow-y-auto">
        <button onclick="closeModal()" class="absolute top-2 right-4 text-gray-500 hover:text-black text-2xl">&times;</button>
        <h2 class="text-2xl font-bold text-center mb-6">Application Form</h2>
        <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
            <input type="hidden" name="job_title" id="hiddenJobTitle">  
            <input type="text" name="name" placeholder="Full Name" required class="w-full text-xs md:text-sm p-3 border border-gray-300 rounded-lg">
            <input type="email" name="email" placeholder="Email Address" required class="w-full text-xs md:text-sm p-3 border border-gray-300 rounded-lg">
            <input type="tel" name="phone" placeholder="Phone Number" required class="w-full text-xs md:text-sm p-3 border border-gray-300 rounded-lg">
            <textarea name="message" placeholder="Message" rows="4" required class="w-full text-xs md:text-sm p-3 border border-gray-300 rounded-lg"></textarea>
            <div class="bg-white border border-gray-300 p-4 rounded-lg">
                <label class="block mb-2 text-xs md:text-sm text-gray-600 text-left">CV/Resume (Max. 2 MB)</label>
                <input type="file" name="cv" accept=".pdf,.doc,.docx" required class="w-full cursor-pointer text-xs md:text-sm file:cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs md:file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
            </div>
            <div class="bg-white border border-gray-300 p-4 rounded-lg">
                <label class="block mb-2 text-xs md:text-sm text-gray-600 text-left">Portfolio (Max. 10MB) *Optional</label>
                <input type="file" name="portfolio" accept=".pdf,.doc,.docx" class="w-full cursor-pointer text-xs md:text-sm file:cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs md:file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
            </div>  
            <button type="submit" class="w-full bg-orange-500 text-white py-3 rounded-lg font-bold text-xs md:text-sm hover:bg-orange-600 transition">Send Application</button>
        </form>
    </div>
</div>

<!-- Load Main JavaScript File -->
<script src="static/js/main.js"></script>

<?php 
include 'includes/whatsapp.php'; 
include 'includes/footer.php';
?>