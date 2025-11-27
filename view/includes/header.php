<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Mini E-Learning'; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="header">
        <div class="header-content">
            <h1><?php echo $page_title ?? 'Mini E-Learning'; ?></h1>
            <div class="user-info">
                <span>Selamat datang, <strong><?php echo htmlspecialchars($_SESSION['name'] ?? 'User'); ?></strong></span>
                <a href="index.php?action=logout" class="logout-btn">Logout</a>
            </div>
        </div>
    </div>
    
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
    <nav class="navbar">
        <div class="nav-content">
            <a href="index.php?action=dashboard_admin">Dashboard</a>
            <a href="index.php?action=user_index">Manajemen User</a>
            <a href="index.php?action=leaderboard_index">Perangkingan</a>
            <a href="index.php?action=modul_index">Modul Belajar</a>
            <a href="index.php?action=quiz_index">Quiz</a>
            <a href="index.php?action=media_index">Upload Media</a>
        </div>
    </nav>
    <?php else: ?>
    <nav class="navbar">
        <div class="nav-content">
            <a href="index.php?action=dashboard_user">Dashboard</a>
            <a href="index.php?action=modul_index">Modul Belajar</a>
            <a href="index.php?action=progress_index">Progress Saya</a>
            <a href="index.php?action=leaderboard_index">Perangkingan</a>
        </div>
    </nav>
    <?php endif; ?>
    
    <div class="container">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php 
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-error">
                <?php 
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

