<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Edit Quiz</h2>
            <a href="<?php echo APP_URL; ?>?page=quiz&action=list" class="btn btn-secondary">Kembali</a>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo APP_URL; ?>?page=quiz&action=update">
            <input type="hidden" name="id" value="<?php echo $quiz['id']; ?>">
            
            <div class="form-group">
                <label for="modul_id">Modul</label>
                <select id="modul_id" name="modul_id" required>
                    <option value="">Pilih Modul</option>
                    <?php foreach ($modul_list as $modul): ?>
                        <option value="<?php echo $modul['id']; ?>" <?php echo $quiz['modul_id'] == $modul['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($modul['judul']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="form-group">
                <label for="pertanyaan">Pertanyaan</label>
                <textarea id="pertanyaan" name="pertanyaan" rows="3" required><?php echo htmlspecialchars($quiz['pertanyaan']); ?></textarea>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="pilihan_a">Pilihan A</label>
                    <input type="text" id="pilihan_a" name="pilihan_a" value="<?php echo htmlspecialchars($quiz['pilihan_a']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="pilihan_b">Pilihan B</label>
                    <input type="text" id="pilihan_b" name="pilihan_b" value="<?php echo htmlspecialchars($quiz['pilihan_b']); ?>" required>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label for="pilihan_c">Pilihan C</label>
                    <input type="text" id="pilihan_c" name="pilihan_c" value="<?php echo htmlspecialchars($quiz['pilihan_c']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="pilihan_d">Pilihan D</label>
                    <input type="text" id="pilihan_d" name="pilihan_d" value="<?php echo htmlspecialchars($quiz['pilihan_d']); ?>" required>
                </div>
            </div>
            
            <div class="form-group">
                <label for="jawaban_benar">Jawaban Benar</label>
                <select id="jawaban_benar" name="jawaban_benar" required>
                    <option value="a" <?php echo $quiz['jawaban_benar'] === 'a' ? 'selected' : ''; ?>>A</option>
                    <option value="b" <?php echo $quiz['jawaban_benar'] === 'b' ? 'selected' : ''; ?>>B</option>
                    <option value="c" <?php echo $quiz['jawaban_benar'] === 'c' ? 'selected' : ''; ?>>C</option>
                    <option value="d" <?php echo $quiz['jawaban_benar'] === 'd' ? 'selected' : ''; ?>>D</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="poin">Poin</label>
                <input type="number" id="poin" name="poin" value="<?php echo $quiz['poin']; ?>" min="1" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

