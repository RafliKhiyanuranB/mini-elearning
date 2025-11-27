<?php
$page_title = 'Dashboard Admin';
require_once __DIR__ . '/includes/header.php';
?>

<div class="stats">
    <div class="stat-card">
        <h3>Total Users</h3>
        <div class="number"><?php echo $totalUsers; ?></div>
    </div>
    <div class="stat-card">
        <h3>Total Staff</h3>
        <div class="number"><?php echo $totalStaff; ?></div>
    </div>
    <div class="stat-card">
        <h3>Total Courses</h3>
        <div class="number"><?php echo $totalCourses ?? 0; ?></div>
    </div>
    <div class="stat-card">
        <h3>Total Modul</h3>
        <div class="number"><?php echo $totalModul; ?></div>
    </div>
</div>

    <div class="card">
        <h2>Menu Cepat</h2>
        <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
            <a href="index.php?action=user_index" class="btn btn-primary" style="text-align: center; padding: 20px;">Manajemen User</a>
            <a href="index.php?action=sekolah_index" class="btn btn-primary" style="text-align: center; padding: 20px;">Manajemen Sekolah</a>
            <a href="index.php?action=leaderboard_index" class="btn btn-primary" style="text-align: center; padding: 20px;">🏆 Perangkingan</a>
            <a href="index.php?action=modul_index" class="btn btn-primary" style="text-align: center; padding: 20px;">Modul Belajar</a>
            <a href="index.php?action=quiz_index" class="btn btn-primary" style="text-align: center; padding: 20px;">Quiz</a>
            <a href="index.php?action=media_index" class="btn btn-primary" style="text-align: center; padding: 20px;">Upload Media</a>
        </div>
    </div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
