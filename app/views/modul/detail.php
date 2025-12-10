<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2><?php echo htmlspecialchars($modul['judul']); ?></h2>
            <a href="<?php echo APP_URL; ?>?page=modul&action=view" class="btn btn-secondary">Kembali</a>
        </div>
        
        <div style="margin-bottom: 20px;">
            <p><strong>Deskripsi:</strong></p>
            <p><?php echo nl2br(htmlspecialchars($modul['deskripsi'] ?? 'Tidak ada deskripsi')); ?></p>
        </div>
        
        <?php if ($modul['file_path']): ?>
            <?php if ($modul['tipe_file'] === 'video'): ?>
                <div class="video-wrapper">
                    <video controls>
                        <source src="<?php echo UPLOAD_URL. $modul['file_path']; ?>" type="video/mp4">
                        Browser Anda tidak mendukung video player.
                    </video>
                </div>

            <?php else: ?>
                <div class="audio-wrapper">
                    <audio controls style="width: 100%;">
                        <source src="<?php echo UPLOAD_URL . $modul['file_path'] ?>" type="audio/mpeg">
                        Browser Anda tidak mendukung audio player.
                    </audio>
                </div>
            <?php endif; ?>
            
            <div style="margin-top: 20px;">
                <a href="<?php echo APP_URL; ?>?page=quiz&action=view&modul_id=<?php echo $modul['id']; ?>" class="btn btn-primary">Kerjakan Quiz</a>
            </div>

        <?php else: ?>
            <div class="alert alert-error">File tidak ditemukan</div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

