<?php
// Session sudah dimulai di index.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../models/auth_model.php';

// Cek session timeout
if (isset($_SESSION['login_time'])) {
    if (time() - $_SESSION['login_time'] > SESSION_TIMEOUT) {
        session_unset();
        session_destroy();
        header('Location: ' . APP_URL . '?page=login');
        exit;
    }
    $_SESSION['login_time'] = time(); // Update login time
}

// Jika belum login dan bukan halaman login, redirect ke login
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
</head>
<body>
    <?php if (is_logged_in()): ?>
    <div class="header">
        <h1><?php echo APP_NAME; ?></h1>
        <div class="user-info">
            <span>Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['nama']); ?></strong></span>
            <span class="badge <?php echo is_admin() ? 'badge-primary' : 'badge-success'; ?>">
                <?php echo ucfirst($_SESSION['role']); ?>
            </span>
            <a href="<?php echo APP_URL; ?>?page=logout" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>
    
    <div class="nav">
        <ul>
            <li><a href="<?php echo APP_URL; ?>?page=dashboard" class="<?php echo (isset($_GET['page']) && $_GET['page'] === 'dashboard') ? 'active' : ''; ?>">Dashboard</a></li>
            <?php if (is_admin()): ?>
                <li><a href="<?php echo APP_URL; ?>?page=user&action=list" class="<?php echo (isset($_GET['page']) && $_GET['page'] === 'user') ? 'active' : ''; ?>">Manajemen User</a></li>
                <li><a href="<?php echo APP_URL; ?>?page=sekolah&action=list" class="<?php echo (isset($_GET['page']) && $_GET['page'] === 'sekolah') ? 'active' : ''; ?>">Manajemen Sekolah</a></li>
                <li><a href="<?php echo APP_URL; ?>?page=modul&action=list" class="<?php echo (isset($_GET['page']) && $_GET['page'] === 'modul') ? 'active' : ''; ?>">Modul Belajar</a></li>
                <li><a href="<?php echo APP_URL; ?>?page=quiz&action=list" class="<?php echo (isset($_GET['page']) && $_GET['page'] === 'quiz') ? 'active' : ''; ?>">Quiz</a></li>
            <?php else: ?>
                <li><a href="<?php echo APP_URL; ?>?page=modul&action=view" class="<?php echo (isset($_GET['page']) && $_GET['page'] === 'modul') ? 'active' : ''; ?>">Modul Belajar</a></li>
                <li><a href="<?php echo APP_URL; ?>?page=quiz&action=view" class="<?php echo (isset($_GET['page']) && $_GET['page'] === 'quiz') ? 'active' : ''; ?>">Quiz</a></li>
                <li><a href="<?php echo APP_URL; ?>?page=ranking" class="<?php echo (isset($_GET['page']) && $_GET['page'] === 'ranking') ? 'active' : ''; ?>">Ranking</a></li>
            <?php endif; ?>
        </ul>
    </div>
    <?php endif; ?>

