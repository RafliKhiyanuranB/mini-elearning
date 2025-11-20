<?php
session_start();
require_once 'controller/AuthController.php';
require_once 'controller/DashboardController.php';

$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'login':
        $authController = new AuthController();
        $authController->login();
        break;
        
    case 'logout':
        $authController = new AuthController();
        $authController->logout();
        break;
        
    case 'dashboard_admin':
        $dashboardController = new DashboardController();
        $dashboardController->dashboardAdmin();
        break;
        
    case 'dashboard_user':
        $dashboardController = new DashboardController();
        $dashboardController->dashboardUser();
        break;
        
    default:
        header('Location: index.php?action=login');
        exit;
}

