<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/auth_model.php';

// Fungsi untuk handle login
function handle_login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        
        if (empty($username) || empty($password)) {
            $error = "Username dan password harus diisi!";
            include __DIR__ . '/../views/auth/login.php';
            return;
        }
        
        $user = login_user($username, $password);
        
        if ($user) {
            // Set session
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['nama'] = $user['nama'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['sekolah_id'] = $user['sekolah_id'];
            $_SESSION['login_time'] = time();
            
            // Redirect ke dashboard
            header('Location: ' . APP_URL . '?page=dashboard');
            exit;
        } else {
            $error = "Username atau password salah!";
            include __DIR__ . '/../views/auth/login.php';
            return;
        }
    }
    
    // Tampilkan form login
    include __DIR__ . '/../views/auth/login.php';
}

// Fungsi untuk handle logout
function handle_logout() {
    session_start();
    session_unset();
    session_destroy();
    header('Location: ' . APP_URL . '?page=login');
    exit;
}
?>

