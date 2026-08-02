<?php 
// Data Social Media Links
$socials = [
    ['fab fa-facebook-f', 'Facebook', 'https://www.facebook.com/'],
    ['fab fa-instagram', 'Instagram', 'https://www.instagram.com/'],
    ['fab fa-tiktok', 'TikTok', 'https://www.tiktok.com/'],
    ['fab fa-linkedin-in', 'LinkedIn', 'https://www.linkedin.com/'],
    ['fab fa-youtube', 'YouTube', 'https://www.youtube.com/']
];
// Data Contact Information.
$contacts = [
    ['fas fa-envelope', 'email@company.com', 'mailto:email@company.com'],
    ['fas fa-phone-alt', '+62 876 5432 1111', 'tel:+687654321111'],
    ['fab fa-whatsapp', '+62 876 5432 1111', 'https://wa.me/687654321111'],
    ['fab fa-whatsapp', '+62 876 5432 1111', 'https://wa.me/687654321111']
];
?>
<!-- Footer Section-->
<footer class="bg-black text-white py-16">
    <div class="page-container">
        <div class="flex items-center gap-2.5 mb-12">
            <img src="<?= $path_prefix ?>public/assets/logo/logo.png" alt="Headline Image" class="w-8 h-8 md:w-10 md:h-10 object-contain">
            <span class="text-base md:text-xl font-normal">Company</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div>
                <h3 class="text-base md:text-xl font-bold mb-6 text-orange-500">Social Media</h3>
                <div class="flex flex-col gap-3">
                    <?php foreach ($socials as $s) : ?>
                        <a href="<?= $s[2] ?>" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 group">
                            <div class="w-6 h-6 md:w-10 md:h-10 bg-gray-800 rounded-md flex items-center justify-center"><i class="<?= $s[0] ?> text-xs md:text-sm"></i></div>
                            <span class="text-sm md:text-base group-hover:text-orange-500 transition"><?= $s[1] ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div>
                <h3 class="text-base md:text-xl font-bold mb-6 text-orange-500">Contact</h3>
                <div class="flex flex-col gap-3">
                    <?php foreach ($contacts as $c) : ?>
                        <a href="<?= $c[2] ?>" class="flex items-center gap-3 group">
                            <div class="w-6 h-6 md:w-10 md:h-10 bg-gray-800 rounded-md flex items-center justify-center"><i class="<?= $c[0] ?> text-xs md:text-sm"></i></div>
                            <span class="text-sm md:text-base group-hover:text-orange-500 transition"><?= $c[1] ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div>
                <h3 class="text-base md:text-xl font-bold mb-6 text-orange-500">Head Office</h3>
                <div class="w-full max-w-[260px] aspect-[4/3] bg-gray-800 rounded-xl mb-4 overflow-hidden shadow-lg">
                    <iframe src="https://maps.google.com/maps?q=Jakarta,Indonesia&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <p class="text-xs md:text-sm text-gray-400 leading-relaxed">Business Street, Central District, DKI Jakarta (123456), Indonesia</p> 
            </div>
        </div>
        <div class="mt-20 pt-8 border-t border-gray-800 text-center text-gray-500 text-xs md:text-sm">
            © <?= date('Y') ?> Company. All Rights Reserved.
        </div>
    </div>
</footer>

<?php
// Generate Dynamic Base URL
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'];
?>

<!-- Structured Data (JSON-LD) for Organization SEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Company",
  "url": "<?= $base_url ?>",
  "logo": "<?= $base_url ?>/public/assets/logo/logo.png",
  "description": "Lorem ipsum..."
}
</script>

<!-- Main JavaScript -->
<script src="<?= $path_prefix ?>static/js/main.js"></script>
</body>
</html>