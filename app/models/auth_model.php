<?php
require_once __DIR__ . '/db_functions.php';

// Fungsi untuk login user
function login_user($username, $password) {
    $sql = "SELECT id, username, password, nama, role, sekolah_id FROM users WHERE username = ?";
    $user = db_fetch_one($sql, [$username]);
    
    if ($user && password_verify($password, $user['password'])) {
        unset($user['password']); // Hapus password dari array
        return $user;
    }
    
    return false;
}

// Fungsi untuk cek apakah user sudah login
function is_logged_in() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Fungsi untuk cek apakah user adalah admin
function is_admin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// Fungsi untuk require login
function require_login() {
    if (!is_logged_in()) {
        header('Location: ' . APP_URL . '?page=login');
        exit;
    }
}

// Fungsi untuk require admin
function require_admin() {
    require_login();
    if (!is_admin()) {
        header('Location: ' . APP_URL . '?page=dashboard');
        exit;
    }
}
?>

