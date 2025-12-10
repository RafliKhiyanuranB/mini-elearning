<?php
// Session check logic (sama seperti sebelumnya, tidak diubah)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/auth_model.php';

if (isset($_SESSION['login_time'])) {
    if (time() - $_SESSION['login_time'] > SESSION_TIMEOUT) {
        session_unset();
        session_destroy();
        header('Location: ' . APP_URL . '?page=login');
        exit;
    }
    $_SESSION['login_time'] = time(); 
}

if (!is_logged_in() && (!isset($_GET['page']) || $_GET['page'] !== 'login')) {
    header('Location: ' . APP_URL . '?page=login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? $page_title . ' - ' : ''; ?><?php echo APP_NAME; ?></title>
    <link rel="stylesheet" href="<?php echo APP_URL; ?>../app/assets/css/style.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Inter', sans-serif; background-color: #f8fafc; } </style>
</head>
<body>
    <?php if (is_logged_in()): ?>
    
    <header class="header">
        <div class="brand">
            <h1><?php echo APP_NAME; ?></h1>
        </div>

        <div class="header-right">
            
            <nav class="header-nav">
                <ul>
                    <li><a href="<?php echo APP_URL; ?>?page=dashboard" class="<?php echo (isset($_GET['page']) && $_GET['page'] === 'dashboard') ? 'active' : ''; ?>">Dashboard</a></li>
                    
                    <?php if (is_admin()): ?>
                        <li><a href="<?php echo APP_URL; ?>?page=user&action=list" class="<?php echo (isset($_GET['page']) && $_GET['page'] === 'user') ? 'active' : ''; ?>">Users</a></li>
                        <li><a href="<?php echo APP_URL; ?>?page=sekolah&action=list" class="<?php echo (isset($_GET['page']) && $_GET['page'] === 'sekolah') ? 'active' : ''; ?>">Sekolah</a></li>
                        <li><a href="<?php echo APP_URL; ?>?page=modul&action=list" class="<?php echo (isset($_GET['page']) && $_GET['page'] === 'modul') ? 'active' : ''; ?>">Modul</a></li>
                        <li><a href="<?php echo APP_URL; ?>?page=quiz&action=list" class="<?php echo (isset($_GET['page']) && $_GET['page'] === 'quiz') ? 'active' : ''; ?>">Quiz</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo APP_URL; ?>?page=modul&action=view" class="<?php echo (isset($_GET['page']) && $_GET['page'] === 'modul') ? 'active' : ''; ?>">Modul</a></li>
                        <li><a href="<?php echo APP_URL; ?>?page=quiz&action=view" class="<?php echo (isset($_GET['page']) && $_GET['page'] === 'quiz') ? 'active' : ''; ?>">Quiz</a></li>
                        <li><a href="<?php echo APP_URL; ?>?page=ranking" class="<?php echo (isset($_GET['page']) && $_GET['page'] === 'ranking') ? 'active' : ''; ?>">Ranking</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <div class="user-info">
                <div class="user-profile">
                    <span class="user-name"><?php echo htmlspecialchars($_SESSION['nama']); ?></span>
                    <span class="role-badge <?php echo is_admin() ? 'role-admin' : 'role-user'; ?>">
                        <?php echo ucfirst($_SESSION['role']); ?>
                    </span>
                </div>
                
                <a href="<?php echo APP_URL; ?>?page=logout" class="btn-logout-icon" title="Logout">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                </a>
            </div>
        </div>
    </header>
    <?php endif; ?>