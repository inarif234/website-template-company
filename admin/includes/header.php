<?php
$page_title = $page_title ?? 'CMS HUB';
$path_prefix = '../';
$css_file = $css_file ?? '../static/css/admin.css';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo $_SESSION['csrf_token'] ?? ''; ?>">
    <title><?php echo $page_title; ?></title>
    <link rel="icon" type="image/png" href="<?php echo $path_prefix; ?>public/assets/logo/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <?php if (isset($extra_head)) echo $extra_head; ?>
    <link rel="stylesheet" href="<?php echo $css_file; ?>">
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen md:h-screen w-full md:w-screen max-w-[100vw] md:overflow-hidden overflow-x-hidden flex flex-col relative">
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <div class="glow-blob-1"></div>
        <div class="glow-blob-2"></div>
    </div>