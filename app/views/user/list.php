<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Manajemen User</h2>
            <a href="<?php echo APP_URL; ?>?page=user&action=create" class="btn btn-success">Tambah User</a>
        </div>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Data berhasil disimpan!</div>
        <?php endif; ?>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error">Terjadi kesalahan!</div>
        <?php endif; ?>
        
        <div style="margin-bottom: 20px;">
            <a href="<?php echo APP_URL; ?>?page=user&action=list" class="btn btn-secondary">Semua</a>
            <a href="<?php echo APP_URL; ?>?page=user&action=list&role=admin" class="btn btn-secondary">Admin</a>
            <a href="<?php echo APP_URL; ?>?page=user&action=list&role=user" class="btn btn-secondary">User</a>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Sekolah</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center;">Tidak ada data</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['nama']); ?></td>
                            <td>
                                <span class="badge <?php echo $user['role'] === 'admin' ? 'badge-primary' : 'badge-success'; ?>">
                                    <?php echo ucfirst($user['role']); ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($user['nama_sekolah'] ?? '-'); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($user['created_at'])); ?></td>
                            <td>
                                <a href="<?php echo APP_URL; ?>?page=user&action=edit&id=<?php echo $user['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                                <a href="<?php echo APP_URL; ?>?page=user&action=delete&id=<?php echo $user['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Yakin ingin menghapus user ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

