<?php
$page_title = 'Tambah User';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="card">
    <h2>Tambah User Baru</h2>
    <form method="POST" action="index.php?action=user_create">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="full_name">Nama Lengkap</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>
        
        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="sekolah_id">Sekolah</label>
            <select id="sekolah_id" name="sekolah_id">
                <option value="">Pilih Sekolah (Opsional)</option>
                <?php foreach ($sekolah as $s): ?>
                    <option value="<?php echo $s['id']; ?>"><?php echo htmlspecialchars($s['nama_sekolah']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php?action=user_index" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

