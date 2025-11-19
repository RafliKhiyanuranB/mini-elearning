<?php
if (!isset($pageTitle)) {
    $pageTitle = 'Mini E-Learning SD Digital Fun';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="wrapper">
            <div class="branding">
                <span class="logo-circle">SD</span>
                <div>
                    <p class="site-title">MINI E-LEARNING</p>
                    <p class="site-subtitle">Belajar Tematik Sekolah Dasar</p>
                </div>
            </div>
            <nav class="site-nav">
                <a href="index.php#hero">Beranda</a>
                <a href="index.php#materi">Materi</a>
                <a href="index.php#aktivitas">Aktivitas</a>
                <a href="index.php#progress">Progress</a>
            </nav>
            <a class="cta" href="materi.php">Masuk Materi</a>
        </div>
    </header>

