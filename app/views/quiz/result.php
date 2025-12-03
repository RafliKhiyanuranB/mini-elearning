<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Hasil Quiz</h2>
        </div>
        
        <div style="text-align: center; padding: 40px;">
            <h3><?php echo htmlspecialchars($modul['judul'] ?? 'Quiz'); ?></h3>
            
            <div style="margin: 30px 0;">
                <div style="font-size: 48px; font-weight: bold; color: #667eea;">
                    <?php echo $nilai; ?>
                </div>
                <p style="font-size: 18px; color: #666;">Total Nilai</p>
            </div>
            
            <div style="margin: 30px 0;">
                <p><strong>Jawaban Benar:</strong> <?php echo $benar; ?> dari <?php echo $total; ?> soal</p>
                <div class="progress-bar">
                    <div class="progress-fill" style="width: <?php echo $total > 0 ? ($benar / $total * 100) : 0; ?>%;">
                        <?php echo $total > 0 ? round($benar / $total * 100) : 0; ?>%
                    </div>
                </div>
            </div>
            
            <div style="margin-top: 40px;">
                <a href="<?php echo APP_URL; ?>?page=quiz&action=view" class="btn btn-primary">Kembali ke Quiz</a>
                <a href="<?php echo APP_URL; ?>?page=dashboard" class="btn btn-secondary">Dashboard</a>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

