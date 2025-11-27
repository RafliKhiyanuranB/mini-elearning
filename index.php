<?php
session_start();

// Load semua controller
require_once 'controller/AuthController.php';
require_once 'controller/DashboardController.php';
require_once 'controller/UserController.php';
require_once 'controller/SekolahController.php';
require_once 'controller/LeaderboardController.php';
require_once 'controller/ModulController.php';
require_once 'controller/QuizController.php';
require_once 'controller/ProgressController.php';
require_once 'controller/MediaController.php';

$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'login':
        login();
        break;
        
    case 'logout':
        logout();
        break;
        
    case 'dashboard_admin':
        dashboardAdmin();
        break;
        
    case 'dashboard_user':
        dashboardUser();
        break;
    
    // User Management
    case 'user_index':
        userIndex();
        break;
        
    case 'user_create':
        userCreate();
        break;
        
    case 'user_edit':
        userEdit();
        break;
        
    case 'user_delete':
        userDelete();
        break;
    
    // Sekolah Management (untuk admin)
    case 'sekolah_index':
        sekolahIndex();
        break;
        
    case 'sekolah_create':
        sekolahCreate();
        break;
        
    case 'sekolah_edit':
        sekolahEdit();
        break;
        
    case 'sekolah_delete':
        sekolahDelete();
        break;
    
    // Leaderboard / Perangkingan
    case 'leaderboard_index':
        leaderboardIndex();
        break;
    
    // Modul Management
    case 'modul_index':
        modulIndex();
        break;
        
    case 'modul_view':
        modulView();
        break;
        
    case 'modul_create':
        modulCreate();
        break;
        
    case 'modul_edit':
        modulEdit();
        break;
        
    case 'modul_delete':
        modulDelete();
        break;
        
    case 'modul_complete':
        modulComplete();
        break;
    
    // Quiz Management
    case 'quiz_index':
        quizIndex();
        break;
        
    case 'quiz_create':
        quizCreate();
        break;
        
    case 'quiz_take':
        quizTake();
        break;
        
    case 'quiz_submit':
        quizSubmit();
        break;
        
    case 'quiz_delete':
        quizDelete();
        break;
    
    // Progress
    case 'progress_index':
        progressIndex();
        break;
    
    // Media Management
    case 'media_index':
        mediaIndex();
        break;
        
    case 'media_upload':
        mediaUpload();
        break;
        
    case 'media_delete':
        mediaDelete();
        break;
        
    default:
        header('Location: index.php?action=login');
        exit;
}
