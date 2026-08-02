<?php
// Database connection
require_once __DIR__ . '/config/config.php';

// Set XML header
header("Content-Type: application/xml; charset=utf-8");

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// 1. Static pages
$static_pages = [
    ['loc' => 'https://company.com/', 'lastmod' => '2026-07-10', 'changefreq' => 'daily', 'priority' => '1.0'],
    ['loc' => 'https://company.com/about', 'changefreq' => '', 'priority' => '0.8'],
    ['loc' => 'https://company.com/products', 'changefreq' => '', 'priority' => '0.8'],
    ['loc' => 'https://company.com/blog', 'changefreq' => '', 'priority' => '0.8'],
    ['loc' => 'https://company.com/career', 'changefreq' => '', 'priority' => '0.8'],
];

foreach ($static_pages as $page) {
    echo '<url>';
    echo '<loc>' . $page['loc'] . '</loc>';
    if (!empty($page['lastmod'])) {
        echo '<lastmod>' . $page['lastmod'] . '</lastmod>';
    }
    if (!empty($page['changefreq'])) {
        echo '<changefreq>' . $page['changefreq'] . '</changefreq>';
    }
    echo '<priority>' . $page['priority'] . '</priority>';
    echo '</url>';
}

// 2. Dynamic posts
try {
    $stmt = $pdo->query("SELECT slug, date FROM posts ORDER BY id DESC");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($posts as $post) {
        $lastmod = !empty($post['date']) ? date('Y-m-d', strtotime($post['date'])) : date('Y-m-d');
        
        echo '<url>';
        echo '<loc>https://company.com/blog/' . htmlspecialchars($post['slug']) . '</loc>';
        echo '<lastmod>' . $lastmod . '</lastmod>';
        echo '<changefreq>weekly</changefreq>';
        echo '<priority>0.7</priority>';
        echo '</url>';
    }
} catch (Exception $e) {
    // Catch error
}

echo '</urlset>';
?>