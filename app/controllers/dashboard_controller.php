<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/auth_model.php';
require_once __DIR__ . '/../models/progress_model.php';
require_once __DIR__ . '/../models/modul_model.php';
require_once __DIR__ . '/../models/quiz_model.php';
require_once __DIR__ . '/../models/user_model.php';
require_once __DIR__ . '/../models/sekolah_model.php';

// Fungsi untuk dashboard
function dashboard_index() {
    require_login();
    
    if (is_admin()) {
        // Dashboard admin
        $total_users = count(get_all_users());
        $total_modul = count(get_all_modul());
        $total_quiz = count(get_all_quiz());
        $total_sekolah = count(get_all_sekolah());
        
        $page_title = "Dashboard Admin";
        include __DIR__ . '/../views/dashboard/admin.php';
    } else {
        // Dashboard user
        $user_id = $_SESSION['user_id'];
        $stats = get_user_progress_stats($user_id);
        $progress_list = get_user_progress($user_id);
        $modul_list = get_modul_for_user();
        
        $page_title = "Dashboard";
        include __DIR__ . '/../views/dashboard/user.php';
    }
}
?>

