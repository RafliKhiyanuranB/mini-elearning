<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
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
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($modul['judul']); ?></td>
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

