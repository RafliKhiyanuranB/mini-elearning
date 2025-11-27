<?php
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Sekolah.php';
require_once __DIR__ . '/../model/Modul.php';
require_once __DIR__ . '/../model/Progress.php';

function dashboardAdmin() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    // Ambil data dari model
    $totalUsers = getTotalUsers();
    $totalStaff = getTotalStaff();
    $totalSekolah = getTotalSekolah();
    $totalModul = getTotalModul();
    
    require_once __DIR__ . '/../view/dashboard_admin.php';
}

function dashboardUser() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
        header('Location: index.php?action=login');
        exit;
    }
    
    require_once __DIR__ . '/../model/Progress.php';
    $statistik = getStatistikUser($_SESSION['user_id']);
    $recentProgress = getProgressByUser($_SESSION['user_id']);
    $recentProgress = array_slice($recentProgress, 0, 5); // Ambil 5 terakhir
    
    require_once __DIR__ . '/../view/dashboard_user.php';
}
