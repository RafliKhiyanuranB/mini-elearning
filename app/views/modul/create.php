<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Tambah Modul</h2>
            <a href="<?php echo APP_URL; ?>?page=modul&action=list" class="btn btn-secondary">Kembali</a>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo APP_URL; ?>?page=modul&action=create" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul Modul</label>
                <input type="text" id="judul" name="judul" required>
            </div>
            
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4"></textarea>
            </div>
            
            <div class="form-group">
                <label for="tipe_file">Tipe File</label>
                <select id="tipe_file" name="tipe_file" required>
                    <option value="video">Video</option>
                    <option value="audio">Audio</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="file">File Video/Audio</label>
                <input type="file" id="file" name="file" accept="video/*,audio/*" required>
                <small style="color: #666;">Maksimal ukuran: <?php echo MAX_UPLOAD_SIZE / 1024 / 1024; ?> MB</small>
            </div>
            
            <div class="form-group">
                <label for="urutan">Urutan</label>
                <input type="number" id="urutan" name="urutan" value="0" min="0">
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

