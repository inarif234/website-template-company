<?php
require_once __DIR__ . '/../../config/config.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    die("Access denied!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("Access denied! Invalid CSRF Token.");
    }
}

$uploadDir = __DIR__ . '/../../public/uploads/banners/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

function getAbsoluteFilePath($imagePath, $uploadDir) {
    if (empty($imagePath)) return '';
    if (strpos($imagePath, 'public/') === 0) {
        return __DIR__ . '/../../' . $imagePath;
    }
    return $uploadDir . basename($imagePath);
}

function processAndResizeImage($sourceFile, $destinationPath, $maxWidth = 1920, $maxHeight = 1080, $quality = 90) {
    $info = getimagesize($sourceFile);
    if ($info === false) return false;
    
    $mime = $info['mime'];
    switch ($mime) {
        case 'image/jpeg': $img = imagecreatefromjpeg($sourceFile); break;
        case 'image/png': $img = imagecreatefrompng($sourceFile); break;
        case 'image/webp': $img = imagecreatefromwebp($sourceFile); break;
        case 'image/gif': $img = imagecreatefromgif($sourceFile); break;
        default: return false;
    }
    
    $origWidth = imagesx($img);
    $origHeight = imagesy($img);
    
    $ratio = min($maxWidth / $origWidth, $maxHeight / $origHeight);
    if ($ratio > 1) $ratio = 1;
    
    $newWidth = round($origWidth * $ratio);
    $newHeight = round($origHeight * $ratio);
    
    $newImg = imagecreatetruecolor($newWidth, $newHeight);
    imagealphablending($newImg, false);
    imagesavealpha($newImg, true);
    
    imagecopyresampled($newImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
    $success = imagewebp($newImg, $destinationPath, $quality);
    
    imagedestroy($img);
    imagedestroy($newImg);
    
    return $success;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get_banner') {
    $stmt = $pdo->prepare("SELECT * FROM banners WHERE id = ?");
    $stmt->execute([$_GET['id']]);
    echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    if ($_POST['action'] === 'publish') {
        $headline = trim($_POST['headline']);
        $bodytext = trim($_POST['bodytext']);
        $link = !empty($_POST['link']) ? trim($_POST['link']) : '';
        
        if (!isset($_FILES['image_desktop']) || $_FILES['image_desktop']['error'] !== UPLOAD_ERR_OK ||
            !isset($_FILES['image_mobile']) || $_FILES['image_mobile']['error'] !== UPLOAD_ERR_OK) {
            die("Image upload is required!");
        }

        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $extD = strtolower(pathinfo($_FILES['image_desktop']['name'], PATHINFO_EXTENSION));
        $extM = strtolower(pathinfo($_FILES['image_mobile']['name'], PATHINFO_EXTENSION));

        if (!in_array($extD, $allowed) || !in_array($extM, $allowed)) {
            die("File format not allowed!");
        }

        $checkD = getimagesize($_FILES['image_desktop']['tmp_name']);
        $checkM = getimagesize($_FILES['image_mobile']['tmp_name']);

        if ($checkD === false || $checkM === false) {
            die("Invalid image file!");
        }

        $allowedMime = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        if (!in_array($checkD['mime'], $allowedMime) || !in_array($checkM['mime'], $allowedMime)) {
            die("File type not supported!");
        }

        $fileNameD = 'desk_' . time() . '_' . bin2hex(random_bytes(4)) . '.webp';
        $fileNameM = 'mob_' . time() . '_' . bin2hex(random_bytes(4)) . '.webp';

        $targetFullPathD = $uploadDir . $fileNameD;
        $targetFullPathM = $uploadDir . $fileNameM;

        if (processAndResizeImage($_FILES['image_desktop']['tmp_name'], $targetFullPathD, 1920, 1080, 90) && 
            processAndResizeImage($_FILES['image_mobile']['tmp_name'], $targetFullPathM, 1080, 1920, 90)) {

            $imgD = 'public/uploads/banners/' . $fileNameD;
            $imgM = 'public/uploads/banners/' . $fileNameM;

            $stmt = $pdo->prepare("INSERT INTO banners (headline, bodytext, image_desktop, image_mobile, link) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$headline, $bodytext, $imgD, $imgM, $link]);
            
            echo "success";
            exit;
        } else {
            die("Failed to process image!");
        }
    }

    elseif ($_POST['action'] === 'update') {
        $id = intval($_POST['id']);
        $headline = trim($_POST['headline']);
        $bodytext = trim($_POST['bodytext']);
        $link = !empty($_POST['link']) ? trim($_POST['link']) : '';

        $stmt = $pdo->prepare("SELECT image_desktop, image_mobile FROM banners WHERE id = ?");
        $stmt->execute([$id]);
        $old = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$old) {
            die("Banner image not found!");
        }

        $imgD = $old['image_desktop'];
        $imgM = $old['image_mobile'];
        $filesToDelete = [];

        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $allowedMime = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];

        if (isset($_FILES['image_desktop']) && $_FILES['image_desktop']['error'] === UPLOAD_ERR_OK) {
            $extD = strtolower(pathinfo($_FILES['image_desktop']['name'], PATHINFO_EXTENSION));
            if (!in_array($extD, $allowed)) die("Desktop image file format not allowed!");
            $checkD = getimagesize($_FILES['image_desktop']['tmp_name']);
            if ($checkD === false || !in_array($checkD['mime'], $allowedMime)) die("Desktop image file is not a valid!");

            $fileNameD = 'desk_' . time() . '_' . bin2hex(random_bytes(4)) . '.webp';
            $targetFullPathD = $uploadDir . $fileNameD;

            if (processAndResizeImage($_FILES['image_desktop']['tmp_name'], $targetFullPathD, 1920, 1080, 90)) {
                $filesToDelete[] = getAbsoluteFilePath($imgD, $uploadDir);
                $imgD = 'public/uploads/banners/' . $fileNameD;
            } else {
                die("Failed to process new desktop image!");
            }
        }

        if (isset($_FILES['image_mobile']) && $_FILES['image_mobile']['error'] === UPLOAD_ERR_OK) {
            $extM = strtolower(pathinfo($_FILES['image_mobile']['name'], PATHINFO_EXTENSION));
            if (!in_array($extM, $allowed)) die("Mobile image file format not allowed!");
            $checkM = getimagesize($_FILES['image_mobile']['tmp_name']);
            if ($checkM === false || !in_array($checkM['mime'], $allowedMime)) die("Mobile image file is not a valid!");

            $fileNameM = 'mob_' . time() . '_' . bin2hex(random_bytes(4)) . '.webp';
            $targetFullPathM = $uploadDir . $fileNameM;

            if (processAndResizeImage($_FILES['image_mobile']['tmp_name'], $targetFullPathM, 1080, 1920, 90)) {
                $filesToDelete[] = getAbsoluteFilePath($imgM, $uploadDir);
                $imgM = 'public/uploads/banners/' . $fileNameM;
            } else {
                die("Failed to process new mobile image!");
            }
        }

        $stmt = $pdo->prepare("UPDATE banners SET headline=?, bodytext=?, image_desktop=?, image_mobile=?, link=? WHERE id=?");
        if ($stmt->execute([$headline, $bodytext, $imgD, $imgM, $link, $id])) {
            foreach ($filesToDelete as $filePath) {
                if (!empty($filePath) && file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            echo "success";
        } else {
            echo "Failed to update database!";
        }
        exit;
    }

    elseif ($_POST['action'] === 'delete') {
        $id = intval($_POST['id']);
        $stmt = $pdo->prepare("SELECT image_desktop, image_mobile FROM banners WHERE id = ?");
        $stmt->execute([$id]);
        $banner = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($banner) {
            $fileD = getAbsoluteFilePath($banner['image_desktop'], $uploadDir);
            $fileM = getAbsoluteFilePath($banner['image_mobile'], $uploadDir);

            if (file_exists($fileD)) unlink($fileD);
            if (file_exists($fileM)) unlink($fileM);

            $stmt = $pdo->prepare("DELETE FROM banners WHERE id = ?");
            $stmt->execute([$id]);
            echo "success";
        } else {
            echo "Banner image not found!";
        }
        exit;
    }
}
?>