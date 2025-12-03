<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Quiz: <?php echo htmlspecialchars($modul['judul']); ?></h2>
        </div>
        
        <form method="POST" action="<?php echo APP_URL; ?>?page=quiz&action=submit">
            <input type="hidden" name="modul_id" value="<?php echo $modul_id; ?>">
            
            <?php $no = 1; foreach ($quiz_list as $quiz): ?>
                <div class="quiz-container">
                    <div class="quiz-question">
                        <?php echo $no++; ?>. <?php echo nl2br(htmlspecialchars($quiz['pertanyaan'])); ?>
                    </div>
                    
                    <ul class="quiz-options">
                        <li>
                            <label>
                                <input type="radio" name="jawaban[<?php echo $quiz['id']; ?>]" value="a" required>
                                <strong>A.</strong> <?php echo htmlspecialchars($quiz['pilihan_a']); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="jawaban[<?php echo $quiz['id']; ?>]" value="b" required>
                                <strong>B.</strong> <?php echo htmlspecialchars($quiz['pilihan_b']); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="jawaban[<?php echo $quiz['id']; ?>]" value="c" required>
                                <strong>C.</strong> <?php echo htmlspecialchars($quiz['pilihan_c']); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="jawaban[<?php echo $quiz['id']; ?>]" value="d" required>
                                <strong>D.</strong> <?php echo htmlspecialchars($quiz['pilihan_d']); ?>
                            </label>
                        </li>
                    </ul>
                </div>
            <?php endforeach; ?>
            
            <div style="margin-top: 30px; text-align: center;">
                <button type="submit" class="btn btn-primary" style="padding: 15px 50px; font-size: 18px;">Submit Quiz</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

