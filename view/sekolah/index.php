<?php
$page_title = 'Manajemen Sekolah';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="actions">
    <a href="index.php?action=sekolah_create" class="btn btn-primary">Tambah Sekolah</a>
</div>

<div class="card">
    <h2>Daftar Sekolah</h2>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Sekolah</th>
                    <th>Alamat</th>
                    <th>No. Telp</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($sekolah)): ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 30px;">Tidak ada data sekolah</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($sekolah as $s): ?>
                        <tr>
                            <td><?php echo $s['id']; ?></td>
                            <td><?php echo htmlspecialchars($s['nama_sekolah']); ?></td>
                            <td><?php echo htmlspecialchars($s['alamat'] ?? '-'); ?></td>
                            <td><?php echo htmlspecialchars($s['no_telp'] ?? '-'); ?></td>
                            <td><?php echo htmlspecialchars($s['email'] ?? '-'); ?></td>
                            <td>
                                <a href="index.php?action=sekolah_edit&id=<?php echo $s['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="index.php?action=sekolah_delete&id=<?php echo $s['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Yakin ingin menghapus sekolah ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

