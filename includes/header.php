<?php
// Defaults
$site_name = "Company";
$default_desc = "Lorem ipsum";

// Path Routing
$is_blog = (strpos($_SERVER['REQUEST_URI'], '/blog/') !== false);
$path_prefix = $is_blog ? '../' : '';

// Detect Base URL
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'];

// Current Page URL
$current_url = $base_url . $_SERVER['REQUEST_URI'];

// Open Graph Image
$default_og_image = $base_url . '/public/assets/logo/logo.png';
$og_image_url = isset($og_image) ? $og_image : $default_og_image;

// Dynamic Meta Values
$page_title_final = isset($page_title) && $page_title !== '' 
    ? $site_name . ' | ' . $page_title 
    : $site_name;
$page_desc_final  = isset($page_description) ? $page_description : $default_desc;
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title><?= $page_title_final ?></title>
    <meta name="description" content="<?= $page_desc_final ?>">
    <link rel="canonical" href="<?= $current_url ?>">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $current_url ?>">
    <meta property="og:title" content="<?= $page_title_final ?>">
    <meta property="og:description" content="<?= $page_desc_final ?>">
    <meta property="og:image" content="<?= $og_image_url ?>">

    <!-- External Assets & Frameworks -->
    <link rel="icon" type="image/png" href="<?php echo $path_prefix; ?>public/assets/logo/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom CSS & Vendor Stylesheets -->
    <link rel="stylesheet" href="<?php echo $path_prefix; ?>static/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>
<body class="bg-white text-gray-800 overflow-x-hidden">