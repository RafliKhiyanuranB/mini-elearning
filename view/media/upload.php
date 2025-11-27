<?php
$page_title = 'Upload Media';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="card">
    <h2>Upload Media</h2>
    <form method="POST" action="index.php?action=media_upload" enctype="multipart/form-data">
        <div class="form-group">
            <label for="file">Pilih File</label>
            <input type="file" id="file" name="file" accept="video/*,audio/*,.pdf" required>
            <small style="color: #666;">Format yang didukung: Video (MP4, AVI, MOV), Audio (MP3, WAV), PDF</small>
        </div>
        
        <div class="form-group">
            <label for="modul_id">Pilih Modul (Opsional)</label>
            <select id="modul_id" name="modul_id">
                <option value="">Tidak Terkait Modul</option>
                <?php foreach ($modul as $m): ?>
                    <option value="<?php echo $m['id']; ?>"><?php echo htmlspecialchars($m['judul']); ?></option>
                <?php endforeach; ?>
            </select>
            <small style="color: #666;">Jika dipilih, file akan otomatis ditambahkan ke modul</small>
        </div>
        
        <div class="actions">
            <button type="submit" class="btn btn-primary">Upload</button>
            <a href="index.php?action=media_index" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

