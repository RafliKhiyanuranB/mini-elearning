<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Edit Modul</h2>
            <a href="<?php echo APP_URL; ?>?page=modul&action=list" class="btn btn-secondary">Kembali</a>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo APP_URL; ?>?page=modul&action=update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $modul['id']; ?>">
            
            <div class="form-group">
                <label for="judul">Judul Modul</label>
                <input type="text" id="judul" name="judul" value="<?php echo htmlspecialchars($modul['judul']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="deskripsi">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4"><?php echo htmlspecialchars($modul['deskripsi'] ?? ''); ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="tipe_file">Tipe File</label>
                <select id="tipe_file" name="tipe_file" required>
                    <option value="video" <?php echo $modul['tipe_file'] === 'video' ? 'selected' : ''; ?>>Video</option>
                    <option value="audio" <?php echo $modul['tipe_file'] === 'audio' ? 'selected' : ''; ?>>Audio</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="file">File Video/Audio Baru (kosongkan jika tidak ingin mengubah)</label>
                <input type="file" id="file" name="file" accept="video/*,audio/*">
                <small style="color: #666;">Maksimal ukuran: <?php echo MAX_UPLOAD_SIZE / 1024 / 1024; ?> MB</small>
                <?php if ($modul['file_path']): ?>
                    <p style="margin-top: 5px;">
                        <strong>File saat ini:</strong> <?php echo htmlspecialchars($modul['file_path']); ?>
                    </p>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="urutan">Urutan</label>
                <input type="number" id="urutan" name="urutan" value="<?php echo $modul['urutan']; ?>" min="0">
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

