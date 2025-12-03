<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Edit User</h2>
            <a href="<?php echo APP_URL; ?>?page=user&action=list" class="btn btn-secondary">Kembali</a>
        </div>
        
        <?php if (isset($error)): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="<?php echo APP_URL; ?>?page=user&action=update">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password Baru (kosongkan jika tidak ingin mengubah)</label>
                <input type="password" id="password" name="password">
            </div>
            
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($user['nama']); ?>" required>
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
                    <option value="">Pilih Sekolah</option>
                    <?php foreach ($sekolah_list as $sekolah): ?>
                        <option value="<?php echo $sekolah['id']; ?>" 
                                <?php echo $user['sekolah_id'] == $sekolah['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($sekolah['nama_sekolah']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

