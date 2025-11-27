<?php
$page_title = htmlspecialchars($modul['judul']);
require_once __DIR__ . '/../includes/header.php';
?>

<div class="card">
    <h2><?php echo htmlspecialchars($modul['judul']); ?></h2>
    <p style="color: #666; margin-bottom: 20px;"><?php echo htmlspecialchars($modul['deskripsi'] ?? ''); ?></p>
    
    <?php if (!empty($modul['video_url'])): ?>
        <div style="margin: 20px 0;">
            <h3>Video</h3>
            <video controls width="100%" style="border-radius: 10px;">
                <source src="<?php echo htmlspecialchars($modul['video_url']); ?>" type="video/mp4">
                Browser Anda tidak mendukung video tag.
            </video>
        </div>
    <?php endif; ?>
    
    <?php if (!empty($modul['audio_url'])): ?>
        <div style="margin: 20px 0;">
            <h3>Audio</h3>
            <audio controls style="width: 100%;">
                <source src="<?php echo htmlspecialchars($modul['audio_url']); ?>" type="audio/mpeg">
                Browser Anda tidak mendukung audio tag.
            </audio>
        </div>
    <?php endif; ?>
    
    <div style="margin: 20px 0;">
        <h3>Konten</h3>
        <div style="line-height: 1.8; color: #333;">
            <?php echo nl2br(htmlspecialchars($modul['konten'])); ?>
        </div>
    </div>
    
    <?php if (!empty($modul['file_url'])): ?>
        <div style="margin: 20px 0;">
            <h3>File Dokumen</h3>
            <a href="<?php echo htmlspecialchars($modul['file_url']); ?>" target="_blank" class="btn btn-primary">Download File</a>
        </div>
    <?php endif; ?>
    
    <div class="actions">
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'user'): ?>
            <a href="index.php?action=quiz_take&modul_id=<?php echo $modul['id']; ?>" class="btn btn-success">Kerjakan Quiz</a>
            <a href="index.php?action=modul_complete&id=<?php echo $modul['id']; ?>" 
               class="btn btn-primary" 
               onclick="return confirm('Tandai modul ini sebagai selesai?')">Tandai Selesai</a>
        <?php endif; ?>
        <a href="index.php?action=modul_index" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

