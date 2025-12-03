<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Manajemen Sekolah</h2>
            <a href="<?php echo APP_URL; ?>?page=sekolah&action=create" class="btn btn-success">Tambah Sekolah</a>
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
                    <th>Nama Sekolah</th>
                    <th>Alamat</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($sekolah_list)): ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">Tidak ada data</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($sekolah_list as $sekolah): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($sekolah['nama_sekolah']); ?></td>
                            <td><?php echo htmlspecialchars($sekolah['alamat'] ?? '-'); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($sekolah['created_at'])); ?></td>
                            <td>
                                <a href="<?php echo APP_URL; ?>?page=sekolah&action=edit&id=<?php echo $sekolah['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                                <a href="<?php echo APP_URL; ?>?page=sekolah&action=ranking&sekolah_id=<?php echo $sekolah['id']; ?>" class="btn btn-sm btn-primary">Ranking</a>
                                <a href="<?php echo APP_URL; ?>?page=sekolah&action=delete&id=<?php echo $sekolah['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Yakin ingin menghapus sekolah ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

