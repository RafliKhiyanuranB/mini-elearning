<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Modul Belajar</h2>
        </div>
        
        <?php if (empty($modul_list)): ?>
            <div class="alert alert-info">Belum ada modul belajar</div>
        <?php else: ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
                <?php foreach ($modul_list as $modul): ?>
                    <div class="card" style="padding: 20px;">
                        <h3><?php echo htmlspecialchars($modul['judul']); ?></h3>
                        <p style="color: #666; margin: 10px 0;">
                            <?php echo htmlspecialchars($modul['deskripsi'] ?? 'Tidak ada deskripsi'); ?>
                        </p>
                        <p>
                            <span class="badge badge-primary"><?php echo ucfirst($modul['tipe_file']); ?></span>
                        </p>
                        <a href="<?php echo APP_URL; ?>?page=modul&action=detail&id=<?php echo $modul['id']; ?>" class="btn btn-primary" style="margin-top: 10px;">Lihat Modul</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

