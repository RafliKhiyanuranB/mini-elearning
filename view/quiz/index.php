<?php
$page_title = 'Manajemen Quiz';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="card">
    <h2>Pilih Modul</h2>
    <form method="GET" action="index.php">
        <input type="hidden" name="action" value="quiz_index">
        <div class="form-group">
            <label for="modul_id">Modul</label>
            <select id="modul_id" name="modul_id" onchange="this.form.submit()">
                <option value="">Pilih Modul</option>
                <?php
                require_once __DIR__ . '/../../model/Modul.php';
                $allModul = getAllModul();
                foreach ($allModul as $m):
                ?>
                    <option value="<?php echo $m['id']; ?>" <?php echo $modul_id == $m['id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($m['judul']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>
</div>

<?php if ($modul): ?>
    <div class="actions">
        <a href="index.php?action=quiz_create&modul_id=<?php echo $modul_id; ?>" class="btn btn-primary">Tambah Quiz</a>
    </div>
    
    <div class="card">
        <h2>Quiz untuk Modul: <?php echo htmlspecialchars($modul['judul']); ?></h2>
        
        <?php if (empty($quizzes)): ?>
            <p>Tidak ada quiz untuk modul ini</p>
        <?php else: ?>
            <?php foreach ($quizzes as $quiz): ?>
                <div class="quiz-item">
                    <h4><?php echo htmlspecialchars($quiz['pertanyaan']); ?></h4>
                    <p><strong>Tipe:</strong> <?php echo ucfirst(str_replace('_', ' ', $quiz['tipe'])); ?></p>
                    
                    <?php if ($quiz['tipe'] === 'pilihan_ganda' && !empty($quiz['pilihan'])): ?>
                        <ul style="margin: 10px 0; padding-left: 20px;">
                            <?php foreach ($quiz['pilihan'] as $pilihan): ?>
                                <li style="margin: 5px 0;">
                                    <?php echo htmlspecialchars($pilihan['pilihan']); ?>
                                    <?php if ($pilihan['is_correct']): ?>
                                        <span style="color: #51cf66; font-weight: bold;">✓ (Benar)</span>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    
                    <div class="actions">
                        <a href="index.php?action=quiz_delete&id=<?php echo $quiz['id']; ?>&modul_id=<?php echo $modul_id; ?>" 
                           class="btn btn-sm btn-danger" 
                           onclick="return confirm('Yakin ingin menghapus quiz ini?')">Hapus</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

