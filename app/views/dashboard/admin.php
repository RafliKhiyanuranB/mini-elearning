<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
$page_title = "Dashboard Admin";
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Dashboard Admin</h2>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
            <div class="card" style="text-align: center; padding: 30px;">
                <h3 style="font-size: 48px; color: #667eea; margin: 0;"><?php echo $total_users; ?></h3>
                <p style="color: #666; margin-top: 10px;">Total User</p>
            </div>
            
            <div class="card" style="text-align: center; padding: 30px;">
                <h3 style="font-size: 48px; color: #28a745; margin: 0;"><?php echo $total_modul; ?></h3>
                <p style="color: #666; margin-top: 10px;">Total Modul</p>
            </div>
            
            <div class="card" style="text-align: center; padding: 30px;">
                <h3 style="font-size: 48px; color: #dc3545; margin: 0;"><?php echo $total_quiz; ?></h3>
                <p style="color: #666; margin-top: 10px;">Total Quiz</p>
            </div>
            
            <div class="card" style="text-align: center; padding: 30px;">
                <h3 style="font-size: 48px; color: #ffc107; margin: 0;"><?php echo $total_sekolah; ?></h3>
                <p style="color: #666; margin-top: 10px;">Total Sekolah</p>
            </div>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
            <a href="<?php echo APP_URL; ?>?page=user&action=list" class="card" style="text-decoration: none; text-align: center; padding: 20px;">
                <h3>Manajemen User</h3>
                <p style="color: #666;">Kelola data user</p>
            </a>

            <a href="<?php echo APP_URL; ?>?page=modul&action=list" class="card" style="text-decoration: none; text-align: center; padding: 20px;">
                <h3>Modul Belajar</h3>
                <p style="color: #666;">Kelola modul belajar</p>
            </a>

            <a href="<?php echo APP_URL; ?>?page=quiz&action=list" class="card" style="text-decoration: none; text-align: center; padding: 20px;">
                <h3>Quiz</h3>
                <p style="color: #666;">Kelola quiz dan latihan</p>
            </a>
            
            <a href="<?php echo APP_URL; ?>?page=sekolah&action=list" class="card" style="text-decoration: none; text-align: center; padding: 20px;">
                <h3>Manajemen Sekolah</h3>
                <p style="color: #666;">Kelola data sekolah</p>
            </a>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

