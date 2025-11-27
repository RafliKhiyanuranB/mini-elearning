<?php
$page_title = 'Edit User';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="card">
    <h2>Edit User</h2>
    <form method="POST" action="index.php?action=user_edit&id=<?php echo $user['id']; ?>">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password (Kosongkan jika tidak ingin mengubah)</label>
            <input type="password" id="password" name="password">
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="full_name">Nama Lengkap</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
        </div>
        
        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="user" <?php echo $user['role'] === 'user' ? 'selected' : ''; ?>>User</option>
                <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="sekolah_id">Sekolah</label>
            <select id="sekolah_id" name="sekolah_id">
                <option value="">Pilih Sekolah (Opsional)</option>
                <?php foreach ($sekolah as $s): ?>
                    <option value="<?php echo $s['id']; ?>" <?php echo $user['sekolah_id'] == $s['id'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($s['nama_sekolah']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="actions">
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="index.php?action=user_index" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

