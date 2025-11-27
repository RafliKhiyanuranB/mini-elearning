<?php
$page_title = 'Edit Sekolah';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="card">
    <h2>Edit Sekolah</h2>
    <form method="POST" action="index.php?action=sekolah_edit&id=<?php echo $sekolah['id']; ?>">
        <div class="form-group">
            <label for="nama_sekolah">Nama Sekolah</label>
            <input type="text" id="nama_sekolah" name="nama_sekolah" value="<?php echo htmlspecialchars($sekolah['nama_sekolah']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat"><?php echo htmlspecialchars($sekolah['alamat'] ?? ''); ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="no_telp">No. Telepon</label>
            <input type="text" id="no_telp" name="no_telp" value="<?php echo htmlspecialchars($sekolah['no_telp'] ?? ''); ?>">
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($sekolah['email'] ?? ''); ?>">
        </div>
        
        <div class="actions">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php?action=sekolah_index" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

