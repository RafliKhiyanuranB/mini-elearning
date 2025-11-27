<?php
$page_title = 'Edit Modul';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="card">
    <h2>Edit Modul</h2>
    <form method="POST" action="index.php?action=modul_edit&id=<?php echo $modul['id']; ?>">
        <div class="form-group">
            <label for="judul">Judul Modul</label>
            <input type="text" id="judul" name="judul" value="<?php echo htmlspecialchars($modul['judul']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi"><?php echo htmlspecialchars($modul['deskripsi'] ?? ''); ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="konten">Konten Modul</label>
            <textarea id="konten" name="konten" required><?php echo htmlspecialchars($modul['konten']); ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="video_url">URL Video (Opsional)</label>
            <input type="text" id="video_url" name="video_url" value="<?php echo htmlspecialchars($modul['video_url'] ?? ''); ?>" placeholder="uploads/video.mp4">
        </div>
        
        <div class="form-group">
            <label for="audio_url">URL Audio (Opsional)</label>
            <input type="text" id="audio_url" name="audio_url" value="<?php echo htmlspecialchars($modul['audio_url'] ?? ''); ?>" placeholder="uploads/audio.mp3">
        </div>
        
        <div class="form-group">
            <label for="file_url">URL File Dokumen (Opsional)</label>
            <input type="text" id="file_url" name="file_url" value="<?php echo htmlspecialchars($modul['file_url'] ?? ''); ?>" placeholder="uploads/document.pdf">
        </div>
        
        <div class="form-group">
            <label for="urutan">Urutan</label>
            <input type="number" id="urutan" name="urutan" value="<?php echo $modul['urutan']; ?>" min="0">
        </div>
        
        <div class="actions">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php?action=modul_index" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

