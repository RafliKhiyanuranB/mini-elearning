<?php
$page_title = 'Tambah Sekolah';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="card">
    <h2>Tambah Sekolah Baru</h2>
    <form method="POST" action="index.php?action=sekolah_create">
        <div class="form-group">
            <label for="nama_sekolah">Nama Sekolah</label>
            <input type="text" id="nama_sekolah" name="nama_sekolah" required>
        </div>
        
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat"></textarea>
        </div>
        
        <div class="form-group">
            <label for="no_telp">No. Telepon</label>
            <input type="text" id="no_telp" name="no_telp">
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        </div>
        
        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php?action=sekolah_index" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

