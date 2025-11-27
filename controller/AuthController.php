<?php
require_once __DIR__ . '/../model/User.php';

function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Email dan password harus diisi!';
            header('Location: index.php?action=login');
            exit;
        }
        
        // Cek login menggunakan model
        $user = userLogin($email, $password);
        
        if ($user) {
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role'] = $user['role'];
            
            if ($user['role'] === 'staff') {
                header('Location: index.php?action=dashboard_admin');
            } else {
                header('Location: index.php?action=dashboard_user');
            }
            exit;
        } else {
            $_SESSION['error'] = 'Email atau password salah!';
            header('Location: index.php?action=login');
            exit;
        }
    }
    
    require_once __DIR__ . '/../view/login.php';
}

function logout() {
    session_destroy();
    header('Location: index.php?action=login');
    exit;
}
