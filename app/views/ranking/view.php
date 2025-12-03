<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
$page_title = "Ranking";
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Ranking</h2>
        </div>
        
        <?php if ($sekolah): ?>
            <h3 style="margin-bottom: 20px;">Ranking: <?php echo htmlspecialchars($sekolah['nama_sekolah']); ?></h3>
            
            <?php if (empty($ranking)): ?>
                <div class="alert alert-info">Belum ada ranking</div>
            <?php else: ?>
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
                        <?php foreach ($ranking as $rank): ?>
                            <tr <?php echo $rank['user_id'] == $_SESSION['user_id'] ? 'style="background: #f0f8ff;"' : ''; ?>>
                                <td class="ranking-number">
                                    <?php if ($rank['peringkat'] <= 3): ?>
                                        <span style="color: #ffc107;"><?php echo $rank['peringkat']; ?></span>
                                    <?php else: ?>
                                        <?php echo $rank['peringkat']; ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo htmlspecialchars($rank['nama']); ?>
                                    <?php if ($rank['user_id'] == $_SESSION['user_id']): ?>
                                        <span class="badge badge-primary">Anda</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo htmlspecialchars($rank['username']); ?></td>
                                <td><strong><?php echo $rank['total_nilai']; ?></strong></td>
                                <td><?php echo date('d/m/Y H:i', strtotime($rank['updated_at'])); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        <?php else: ?>
            <div class="alert alert-info">Anda belum terdaftar di sekolah</div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

