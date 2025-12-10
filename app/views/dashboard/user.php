<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
$page_title = "Dashboard";

// Fungsi helper untuk memotong teks
if (!function_exists('truncate_text')) {
    function truncate_text($text, $max_length = 50) {
        if (mb_strlen($text) <= $max_length) {
            return $text;
        }
        return mb_substr($text, 0, $max_length) . '...';
    }
}
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Dashboard</h2>
        </div>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
            <div class="card" style="text-align: center; padding: 30px;">
                <h3 style="font-size: 48px; color: #667eea; margin: 0;"><?php echo $stats['total_quiz'] ?? 0; ?></h3>
                <p style="color: #666; margin-top: 10px;">Total Quiz</p>
            </div>
            
            <div class="card" style="text-align: center; padding: 30px;">
                <h3 style="font-size: 48px; color: #28a745; margin: 0;"><?php echo $stats['quiz_selesai'] ?? 0; ?></h3>
                <p style="color: #666; margin-top: 10px;">Quiz Selesai</p>
            </div>
            
            <div class="card" style="text-align: center; padding: 30px;">
                <h3 style="font-size: 48px; color: #dc3545; margin: 0;"><?php echo $stats['total_nilai'] ?? 0; ?></h3>
                <p style="color: #666; margin-top: 10px;">Total Nilai</p>
            </div>
        </div>
        
        <div class="card">
            <h3 style="margin-bottom: 20px;">Progress Quiz</h3>
            
            <?php if (empty($progress_list)): ?>
                <div class="alert alert-info">Belum ada progress quiz</div>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Modul</th>
                            <th>Pertanyaan</th>
                            <th>Nilai</th>
                            <th>Status</th>
                            <th>Tanggal Selesai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($progress_list as $progress): ?>
                            <?php
                            $modul_judul = truncate_text($progress['modul_judul'] ?? '-', 40);
                            $pertanyaan = truncate_text($progress['pertanyaan'] ?? '-', 50);
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td class="table-title" title="<?php echo htmlspecialchars($progress['modul_judul'] ?? '-'); ?>"><?php echo htmlspecialchars($modul_judul); ?></td>
                                <td class="table-title" title="<?php echo htmlspecialchars($progress['pertanyaan'] ?? '-'); ?>"><?php echo htmlspecialchars($pertanyaan); ?></td>
                                <td><strong><?php echo $progress['nilai']; ?></strong></td>
                                <td>
                                    <span class="badge <?php echo $progress['status'] === 'selesai' ? 'badge-success' : 'badge-danger'; ?>">
                                        <?php echo ucfirst($progress['status']); ?>
                                    </span>
                                </td>
                                <td><?php echo $progress['tanggal_selesai'] ? date('d/m/Y H:i', strtotime($progress['tanggal_selesai'])) : '-'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        
        <div class="card">
            <h3 style="margin-bottom: 20px;">Modul Belajar</h3>
            
            <?php if (empty($modul_list)): ?>
                <div class="alert alert-info">Belum ada modul belajar</div>
            <?php else: ?>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
                    <?php foreach ($modul_list as $modul): ?>
                        <?php
                        $judul = truncate_text($modul['judul'], 40);
                        $deskripsi = truncate_text($modul['deskripsi'] ?? 'Tidak ada deskripsi', 80);
                        ?>
                        <div class="card" style="padding: 20px;">
                            <h4 class="modul-title" title="<?php echo htmlspecialchars($modul['judul']); ?>"><?php echo htmlspecialchars($judul); ?></h4>
                            <p class="modul-description" title="<?php echo htmlspecialchars($modul['deskripsi'] ?? 'Tidak ada deskripsi'); ?>">
                                <?php echo htmlspecialchars($deskripsi); ?>
                            </p>
                            <a href="<?php echo APP_URL; ?>?page=modul&action=detail&id=<?php echo $modul['id']; ?>" class="btn btn-primary btn-sm">Lihat Modul</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

