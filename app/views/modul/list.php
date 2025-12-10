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
            <h2>Manajemen Modul Belajar</h2>
            <a href="<?php echo APP_URL; ?>?page=modul&action=create" class="btn btn-success">Tambah Modul</a>
        </div>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Data berhasil disimpan!</div>
        <?php endif; ?>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error">Terjadi kesalahan!</div>
        <?php endif; ?>
        
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tipe</th>
                    <th>Urutan</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($modul_list)): ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Tidak ada data</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($modul_list as $modul): ?>
                        <?php $judul = truncate_text($modul['judul'], 50); ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td class="table-title" title="<?php echo htmlspecialchars($modul['judul']); ?>"><?php echo htmlspecialchars($judul); ?></td>
                            <td>
                                <span class="badge badge-primary">
                                    <?php echo ucfirst($modul['tipe_file']); ?>
                                </span>
                            </td>
                            <td><?php echo $modul['urutan']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($modul['created_at'])); ?></td>
                            <td>
                                <a href="<?php echo APP_URL; ?>?page=modul&action=edit&id=<?php echo $modul['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                                <a href="<?php echo APP_URL; ?>?page=modul&action=delete&id=<?php echo $modul['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Yakin ingin menghapus modul ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

