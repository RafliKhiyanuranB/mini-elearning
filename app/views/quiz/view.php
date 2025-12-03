<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Quiz dan Latihan</h2>
        </div>
        
        <div style="margin-bottom: 20px;">
            <form method="GET" action="">
                <input type="hidden" name="page" value="quiz">
                <input type="hidden" name="action" value="view">
                <div class="form-group">
                    <label for="modul_id">Pilih Modul</label>
                    <select id="modul_id" name="modul_id" onchange="this.form.submit()">
                        <option value="">Pilih Modul</option>
                        <?php foreach ($modul_list as $m): ?>
                            <option value="<?php echo $m['id']; ?>" <?php echo $modul_id == $m['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($m['judul']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
        </div>
        
        <?php if ($modul && !empty($quiz_list)): ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($modul['judul']); ?></h3>
                <p>Total soal: <strong><?php echo count($quiz_list); ?></strong></p>
                <a href="<?php echo APP_URL; ?>?page=quiz&action=do&modul_id=<?php echo $modul_id; ?>" class="btn btn-primary">Mulai Quiz</a>
            </div>
        <?php elseif ($modul_id && empty($quiz_list)): ?>
            <div class="alert alert-info">Belum ada quiz untuk modul ini</div>
        <?php else: ?>
            <div class="alert alert-info">Pilih modul untuk melihat quiz</div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

