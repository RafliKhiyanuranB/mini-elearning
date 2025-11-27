<?php
$page_title = 'Quiz: ' . htmlspecialchars($modul['judul']);
require_once __DIR__ . '/../includes/header.php';
?>

<div class="card">
    <h2>Quiz: <?php echo htmlspecialchars($modul['judul']); ?></h2>
    
    <?php if (empty($quizzes)): ?>
        <p>Belum ada quiz untuk modul ini</p>
    <?php else: ?>
        <form method="POST" action="index.php?action=quiz_submit">
            <input type="hidden" name="modul_id" value="<?php echo $modul['id']; ?>">
            
            <?php foreach ($quizzes as $index => $quiz): ?>
                <div class="quiz-item">
                    <h4><?php echo ($index + 1) . '. ' . htmlspecialchars($quiz['pertanyaan']); ?></h4>
                    
                    <?php 
                    $userJawaban = null;
                    foreach ($jawaban as $j) {
                        if ($j['quiz_id'] == $quiz['id']) {
                            $userJawaban = $j;
                            break;
                        }
                    }
                    ?>
                    
                    <?php if ($quiz['tipe'] === 'pilihan_ganda'): ?>
                        <?php foreach ($quiz['pilihan'] as $pilihan): ?>
                            <div class="quiz-option">
                                <input type="radio" 
                                       name="quiz_<?php echo $quiz['id']; ?>" 
                                       value="<?php echo $pilihan['id']; ?>" 
                                       id="pilihan_<?php echo $pilihan['id']; ?>"
                                       <?php echo $userJawaban && $userJawaban['pilihan_id'] == $pilihan['id'] ? 'checked' : ''; ?>
                                       required>
                                <label for="pilihan_<?php echo $pilihan['id']; ?>">
                                    <?php echo htmlspecialchars($pilihan['pilihan']); ?>
                                </label>
                            </div>
                        <?php endforeach; ?>
                        <input type="hidden" name="quiz_id[]" value="<?php echo $quiz['id']; ?>">
                        <input type="hidden" name="pilihan_id_<?php echo $quiz['id']; ?>" id="pilihan_id_<?php echo $quiz['id']; ?>">
                    <?php else: ?>
                        <textarea name="jawaban_<?php echo $quiz['id']; ?>" 
                                  class="form-group" 
                                  style="width: 100%; min-height: 100px;"
                                  required><?php echo $userJawaban ? htmlspecialchars($userJawaban['jawaban']) : ''; ?></textarea>
                        <input type="hidden" name="quiz_id[]" value="<?php echo $quiz['id']; ?>">
                    <?php endif; ?>
                    
                    <?php if ($userJawaban): ?>
                        <p style="margin-top: 10px; color: <?php echo $userJawaban['skor'] > 0 ? '#51cf66' : '#ff6b6b'; ?>;">
                            Skor: <?php echo $userJawaban['skor']; ?>/100
                        </p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            
            <div class="actions">
                <button type="submit" class="btn btn-primary">Simpan Jawaban</button>
                <a href="index.php?action=modul_view&id=<?php echo $modul['id']; ?>" class="btn btn-secondary">Kembali ke Modul</a>
            </div>
        </form>
        
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

