<?php
if (session_status() === PHP_SESSION_NONE) {
    // Cookie Settings
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'secure' => isset($_SERVER['HTTPS']),
        'httponly' => true,
        'samesite' => 'Strict'
    ]);
    
    // Run Session
    session_start();
}

// Global Detection
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'];

// Initialize CSRF Token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Set Timeout (Login Session)
$inactive_limit = 7200; // 7200 seconds = 2 hours

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $inactive_limit) {

        session_unset();
        session_destroy();
        
        $current_path = $_SERVER['PHP_SELF'];
        if (strpos($current_path, '/admin/') !== false) {
            $redirect_target = $base_url . '/admin/index.php?timeout=1';
        } else {
            $redirect_target = $base_url . '/index.php?timeout=1';
        }

        header('Location: ' . $redirect_target);
        exit;
    }
}

// Update last activity
$_SESSION['last_activity'] = time();

// Database Connection
$host = 'localhost';
$dbname = 'website_database';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    error_log("Database Connection Error: " . $e->getMessage());
    die("Connection failed! Please try again later.");
}
?>
