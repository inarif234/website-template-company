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

function generateSlug($string) {
    $slug = preg_replace('/[^a-z0-9\s-]/', '', strtolower($string));
    $slug = preg_replace('/[\s-]+/', '-', $slug);
    return trim($slug, '-');
}

$uploadDir = __DIR__ . '/../../public/uploads/posts/';
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

function processAndResizeImage($sourceFile, $destinationPath, $maxWidth = 1280, $maxHeight = 720, $quality = 80) {
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

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    if ($_GET['action'] === 'get_post') {
        $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    if ($_POST['action'] === 'publish') {
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $type = $_POST['type'];
        $date = $_POST['date'];
        $content = $_POST['content'];
        $slug = generateSlug($title);

        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            die("Image upload is required!");
        }

        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $allowedMime = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];
        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        
        if (!in_array($ext, $allowed)) {
            die("File format not allowed!");
        }
        
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check === false) die("Invalid image file!");
        if (!in_array($check['mime'], $allowedMime)) die("File type not supported!");

        $fileName = time() . '_' . bin2hex(random_bytes(4)) . '.webp';
        $targetFullPath = $uploadDir . $fileName;

        if (processAndResizeImage($_FILES['image']['tmp_name'], $targetFullPath, 1280, 720, 80)) {
            $image = 'public/uploads/posts/' . $fileName;
            $stmt = $pdo->prepare("INSERT INTO posts (title, slug, type, date, image, description, content) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$title, $slug, $type, $date, $image, $description, $content]);
            echo "success";
        } else {
            die("Failed to process image!");
        }
        exit;
    }
    
    elseif ($_POST['action'] === 'update') {
        $id = $_POST['id'];
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $type = $_POST['type'];
        $date = $_POST['date'];
        $content = $_POST['content'];
        $slug = generateSlug($title);

        $old_image = null;
        $new_image = null;

        $stmt = $pdo->prepare("SELECT image FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        $old_image = $stmt->fetchColumn();

        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
        $allowedMime = ['image/jpeg', 'image/png', 'image/webp', 'image/gif'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, $allowed)) die("File format not allowed!");
            
            $check = getimagesize($_FILES['image']['tmp_name']);
            if ($check === false) die("Image file is not a valid!");
            if (!in_array($check['mime'], $allowedMime)) die("File type not supported!");

            $fileName = time() . '_' . bin2hex(random_bytes(4)) . '.webp';
            $targetFullPath = $uploadDir . $fileName;

            if (processAndResizeImage($_FILES['image']['tmp_name'], $targetFullPath, 1280, 720, 80)) {
                $new_image = 'public/uploads/posts/' . $fileName;
            } else {
                die("Failed to process new image!");
            }
        }

        if ($new_image) {
            $stmt = $pdo->prepare("UPDATE posts SET title=?, slug=?, type=?, date=?, image=?, description=?, content=? WHERE id=?");
            $success = $stmt->execute([$title, $slug, $type, $date, $new_image, $description, $content, $id]);
        } else {
            $stmt = $pdo->prepare("UPDATE posts SET title=?, slug=?, type=?, date=?, description=?, content=? WHERE id=?");
            $success = $stmt->execute([$title, $slug, $type, $date, $description, $content, $id]);
        }

        if ($success) {
            if ($new_image && $old_image) {
                $oldPath = getAbsoluteFilePath($old_image, $uploadDir);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }
            echo "success";
        } else {
            if ($new_image) {
                $newPath = getAbsoluteFilePath($new_image, $uploadDir);
                if (file_exists($newPath)) {
                    unlink($newPath);
                }
            }
            echo "Failed to update database!";
        }
        exit;
    }

    elseif ($_POST['action'] === 'delete') {
        $id = $_POST['id'];

        $stmt = $pdo->prepare("SELECT image FROM posts WHERE id = ?");
        $stmt->execute([$id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($post) {
            $filePath = getAbsoluteFilePath($post['image'], $uploadDir);
            if (file_exists($filePath)) unlink($filePath);
            
            $stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
            $stmt->execute([$id]);
            echo "success";
        }
        exit;
    }
}
?>