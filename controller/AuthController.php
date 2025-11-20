<?php
require_once __DIR__ . '/../model/User.php';

class AuthController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            if (empty($username) || empty($password)) {
                $_SESSION['error'] = 'Username dan password harus diisi!';
                header('Location: index.php?action=login');
                exit;
            }
            
            // Cek login menggunakan model
            $user = $this->userModel->login($username, $password);
            
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user['role'];
                
                if ($user['role'] === 'admin') {
                    header('Location: index.php?action=dashboard_admin');
                } else {
                    header('Location: index.php?action=dashboard_user');
                }
                exit;
            } else {
                $_SESSION['error'] = 'Username atau password salah!';
                header('Location: index.php?action=login');
                exit;
            }
        }
        
        require_once __DIR__ . '/../view/login.php';
    }
    
    public function logout() {
        session_destroy();
        header('Location: index.php?action=login');
        exit;
    }
}

