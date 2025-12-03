<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Ranking Sekolah</h2>
            <a href="<?php echo APP_URL; ?>?page=sekolah&action=list" class="btn btn-secondary">Kembali</a>
        </div>
        
        <div style="margin-bottom: 20px;">
            <form method="GET" action="">
                <input type="hidden" name="page" value="sekolah">
                <input type="hidden" name="action" value="ranking">
                <div class="form-group">
                    <label for="sekolah_id">Pilih Sekolah</label>
                    <select id="sekolah_id" name="sekolah_id" onchange="this.form.submit()">
                        <option value="">Pilih Sekolah</option>
                        <?php foreach ($sekolah_list as $s): ?>
                            <option value="<?php echo $s['id']; ?>" <?php echo $sekolah_id == $s['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($s['nama_sekolah']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
        </div>
        
        <?php if ($sekolah): ?>
            <h3 style="margin-bottom: 20px;">Ranking: <?php echo htmlspecialchars($sekolah['nama_sekolah']); ?></h3>
            
            <table class="table ranking-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">Peringkat</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Total Nilai</th>
                        <th>Terakhir Update</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($ranking)): ?>
                        <tr>
                            <td colspan="5" style="text-align: center;">Belum ada ranking</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($ranking as $rank): ?>
                            <tr>
                                <td class="ranking-number"><?php echo $rank['peringkat']; ?></td>
                                <td><?php echo htmlspecialchars($rank['nama']); ?></td>
                                <td><?php echo htmlspecialchars($rank['username']); ?></td>
                                <td><strong><?php echo $rank['total_nilai']; ?></strong></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($rank['updated_at'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">Pilih sekolah untuk melihat ranking</div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

