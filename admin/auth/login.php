<?php
require_once __DIR__ . '/../../config/config.php';

if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("error");
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $user_input = $_POST['username'];
    $pass_input = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$user_input]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($pass_input, $user['password'])) {
        $_SESSION['logged_in'] = true;
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>