<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Edit Sekolah</h2>
            <a href="<?php echo APP_URL; ?>?page=sekolah&action=list" class="btn btn-secondary">Kembali</a>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo APP_URL; ?>?page=sekolah&action=update">
            <input type="hidden" name="id" value="<?php echo $sekolah['id']; ?>">
            
            <div class="form-group">
                <label for="nama_sekolah">Nama Sekolah</label>
                <input type="text" id="nama_sekolah" name="nama_sekolah" value="<?php echo htmlspecialchars($sekolah['nama_sekolah']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" rows="3"><?php echo htmlspecialchars($sekolah['alamat'] ?? ''); ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

