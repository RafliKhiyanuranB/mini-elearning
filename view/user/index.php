<?php
$page_title = 'Manajemen User';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="actions">
    <a href="index.php?action=user_create" class="btn btn-primary">Tambah User</a>
</div>

<div class="card">
    <h2>Daftar User</h2>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Nama Lengkap</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Sekolah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 30px;">Tidak ada data user</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td>
                                <span style="padding: 5px 10px; border-radius: 5px; background: <?php echo $user['role'] === 'admin' ? '#667eea' : '#51cf66'; ?>; color: white;">
                                    <?php echo ucfirst($user['role']); ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($user['nama_sekolah'] ?? '-'); ?></td>
                            <td>
                                <a href="index.php?action=user_edit&id=<?php echo $user['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                                <a href="index.php?action=user_delete&id=<?php echo $user['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Yakin ingin menghapus user ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

