<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';

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
            <h2>Modul Belajar</h2>
        </div>
        
        <?php if (empty($modul_list)): ?>
            <div class="alert alert-info">Belum ada modul belajar</div>
        <?php else: ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 20px;">
                <?php foreach ($modul_list as $modul): ?>
                    <?php
                    $judul = truncate_text($modul['judul'], 40);
                    $deskripsi = truncate_text($modul['deskripsi'] ?? 'Tidak ada deskripsi', 80);
                    ?>
                    <div class="card" style="padding: 20px;">
                        <h3 class="modul-title" title="<?php echo htmlspecialchars($modul['judul']); ?>"><?php echo htmlspecialchars($judul); ?></h3>
                        <p class="modul-description" title="<?php echo htmlspecialchars($modul['deskripsi'] ?? 'Tidak ada deskripsi'); ?>">
                            <?php echo htmlspecialchars($deskripsi); ?>
                        </p>
                        <p>
                            <span class="badge badge-primary"><?php echo ucfirst($modul['tipe_file']); ?></span>
                        </p>
                        <a href="<?php echo APP_URL; ?>?page=modul&action=detail&id=<?php echo $modul['id']; ?>" class="btn btn-primary" style="margin-top: 10px;">Lihat Modul</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

