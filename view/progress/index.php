<?php
$page_title = 'Progress Saya';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="stats">
    <div class="stat-card">
        <h3>Total Modul</h3>
        <div class="number"><?php echo $statistik['total_modul'] ?? 0; ?></div>
    </div>
    <div class="stat-card">
        <h3>Modul Selesai</h3>
        <div class="number"><?php echo $statistik['modul_selesai'] ?? 0; ?></div>
    </div>
    <div class="stat-card">
        <h3>Sedang Dipelajari</h3>
        <div class="number"><?php echo $statistik['modul_progress'] ?? 0; ?></div>
    </div>
    <div class="stat-card">
        <h3>Total Waktu Belajar</h3>
        <div class="number"><?php echo $statistik['total_waktu_belajar'] ?? 0; ?> menit</div>
    </div>
</div>

<div class="card">
    <h2>Detail Progress</h2>
    
    <?php if (empty($progress)): ?>
        <p>Anda belum memulai belajar modul apapun</p>
        <a href="index.php?action=modul_index" class="btn btn-primary">Mulai Belajar</a>
    <?php else: ?>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Modul</th>
                        <th>Status</th>
                        <th>Progress</th>
                        <th>Waktu Belajar</th>
                        <th>Terakhir Diakses</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($progress as $p): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($p['modul_judul']); ?></td>
                            <td>
                                <span style="padding: 5px 10px; border-radius: 5px; background: 
                                    <?php 
                                        echo $p['status'] === 'selesai' ? '#51cf66' : 
                                            ($p['status'] === 'sedang_belajar' ? '#667eea' : '#6c757d'); 
                                    ?>; color: white;">
                                    <?php echo ucfirst(str_replace('_', ' ', $p['status'])); ?>
                                </span>
                            </td>
                            <td>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: <?php echo $p['progress_percent']; ?>%"></div>
                                </div>
                                <?php echo $p['progress_percent']; ?>%
                            </td>
                            <td><?php echo $p['waktu_belajar']; ?> menit</td>
                            <td><?php echo $p['last_accessed'] ? date('d/m/Y H:i', strtotime($p['last_accessed'])) : '-'; ?></td>
                            <td>
                                <a href="index.php?action=modul_view&id=<?php echo $p['modul_id']; ?>" class="btn btn-sm btn-primary">Lanjutkan</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

