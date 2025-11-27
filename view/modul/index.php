<?php
$page_title = 'Modul Belajar';
require_once __DIR__ . '/../includes/header.php';
?>

<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
<div class="actions">
    <a href="index.php?action=modul_create" class="btn btn-primary">Tambah Modul</a>
</div>
<?php endif; ?>

<div class="grid">
    <?php if (empty($modul)): ?>
        <div class="card">
            <p>Tidak ada modul yang tersedia</p>
        </div>
    <?php else: ?>
        <?php foreach ($modul as $m): ?>
            <div class="modul-card">
                <h3><?php echo htmlspecialchars($m['judul']); ?></h3>
                <p><?php echo htmlspecialchars(substr($m['deskripsi'] ?? '', 0, 100)) . '...'; ?></p>
                
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'user' && isset($m['progress'])): ?>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: <?php echo $m['progress']['progress_percent']; ?>%"></div>
                    </div>
                    <p style="font-size: 12px; color: #666;">
                        Progress: <?php echo $m['progress']['progress_percent']; ?>% | 
                        Status: <?php echo ucfirst(str_replace('_', ' ', $m['progress']['status'])); ?>
                    </p>
                <?php endif; ?>
                
                <div class="actions">
                    <a href="index.php?action=modul_view&id=<?php echo $m['id']; ?>" class="btn btn-primary">Lihat Modul</a>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="index.php?action=modul_edit&id=<?php echo $m['id']; ?>" class="btn btn-sm btn-secondary">Edit</a>
                        <a href="index.php?action=modul_delete&id=<?php echo $m['id']; ?>" 
                           class="btn btn-sm btn-danger" 
                           onclick="return confirm('Yakin ingin menghapus modul ini?')">Hapus</a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

