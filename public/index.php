<?php
// Entry point aplikasi
require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/config/database.php';

// Start session
session_start();

// Routing sederhana
$page = $_GET['page'] ?? 'login';
$action = $_GET['action'] ?? '';

// Include controllers
require_once __DIR__ . '/../app/controllers/auth_controller.php';
require_once __DIR__ . '/../app/controllers/user_controller.php';
require_once __DIR__ . '/../app/controllers/sekolah_controller.php';
require_once __DIR__ . '/../app/controllers/modul_controller.php';
require_once __DIR__ . '/../app/controllers/quiz_controller.php';
require_once __DIR__ . '/../app/controllers/dashboard_controller.php';
require_once __DIR__ . '/../app/controllers/ranking_controller.php';

// Routing
switch ($page) {
    case 'login':
        handle_login();
        break;
        
    case 'logout':
        handle_logout();
        break;
        
    case 'dashboard':
        dashboard_index();
        break;
        
    case 'user':
        switch ($action) {
            case 'list':
                user_list();
                break;
            case 'create':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    user_create();
                } else {
                    user_create_form();
                }
                break;
            case 'edit':
                user_edit_form();
                break;
            case 'update':
                user_update();
                break;
            case 'delete':
                user_delete();
                break;
            default:
                user_list();
        }
        break;
        
    case 'sekolah':
        switch ($action) {
            case 'list':
                sekolah_list();
                break;
            case 'create':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    sekolah_create();
                } else {
                    sekolah_create_form();
                }
                break;
            case 'edit':
                sekolah_edit_form();
                break;
            case 'update':
                sekolah_update();
                break;
            case 'delete':
                sekolah_delete();
                break;
            case 'ranking':
                sekolah_ranking();
                break;
            default:
                sekolah_list();
        }
        break;
        
    case 'modul':
        switch ($action) {
            case 'list':
                modul_list();
                break;
            case 'view':
                modul_view();
                break;
            case 'detail':
                modul_detail();
                break;
            case 'create':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    modul_create();
                } else {
                    modul_create_form();
                }
                break;
            case 'edit':
                modul_edit_form();
                break;
            case 'update':
                modul_update();
                break;
            case 'delete':
                modul_delete();
                break;
            default:
                if (is_admin()) {
                    modul_list();
                } else {
                    modul_view();
                }
        }
        break;
        
    case 'quiz':
        switch ($action) {
            case 'list':
                quiz_list();
                break;
            case 'view':
                quiz_view();
                break;
            case 'do':
                quiz_do_form();
                break;
            case 'submit':
                quiz_submit();
                break;
            case 'result':
                quiz_result();
                break;
            case 'create':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    quiz_create();
                } else {
                    quiz_create_form();
                }
                break;
            case 'edit':
                quiz_edit_form();
                break;
            case 'update':
                quiz_update();
                break;
            case 'delete':
                quiz_delete();
                break;
            default:
                if (is_admin()) {
                    quiz_list();
                } else {
                    quiz_view();
                }
        }
        break;
        
    case 'ranking':
        ranking_view();
        break;
        
    default:
        if (is_logged_in()) {
            dashboard_index();
        } else {
            handle_login();
        }
}
?>

