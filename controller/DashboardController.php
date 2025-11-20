<?php
require_once __DIR__ . '/../model/User.php';

class DashboardController {
    private $userModel;
    
    public function __construct() {
        $this->userModel = new User();
    }
    
    public function dashboardAdmin() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: index.php?action=login');
            exit;
        }
        
        // Ambil data dari model
        $totalUsers = $this->userModel->getTotalUsers();
        $totalAdmins = $this->userModel->getTotalAdmins();
        $allUsers = $this->userModel->getAllUsers();
        
        require_once __DIR__ . '/../view/dashboard_admin.php';
    }
    
    public function dashboardUser() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
            header('Location: index.php?action=login');
            exit;
        }
        
        require_once __DIR__ . '/../view/dashboard_user.php';
    }
}

