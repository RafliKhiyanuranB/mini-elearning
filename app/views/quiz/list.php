<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../layouts/header.php';
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Manajemen Quiz</h2>
            <a href="<?php echo APP_URL; ?>?page=quiz&action=create" class="btn btn-success">Tambah Quiz</a>
        </div>
        
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Data berhasil disimpan!</div>
        <?php endif; ?>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-error">Terjadi kesalahan!</div>
        <?php endif; ?>
        
        <div style="margin-bottom: 20px;">
            <form method="GET" action="">
                <input type="hidden" name="page" value="quiz">
                <input type="hidden" name="action" value="list">
                <div class="form-group">
                    <label for="modul_id">Filter Modul</label>
                    <select id="modul_id" name="modul_id" onchange="this.form.submit()">
                        <option value="">Semua Modul</option>
                        <?php foreach ($modul_list as $modul): ?>
                            <option value="<?php echo $modul['id']; ?>" <?php echo $modul_id == $modul['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($modul['judul']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pertanyaan</th>
                    <th>Modul</th>
                    <th>Poin</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($quiz_list)): ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Tidak ada data</td>
                    </tr>
                <?php else: ?>
                    <?php $no = 1; foreach ($quiz_list as $quiz): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars(substr($quiz['pertanyaan'], 0, 50)) . '...'; ?></td>
                            <td><?php echo htmlspecialchars($quiz['modul_judul']); ?></td>
                            <td><?php echo $quiz['poin']; ?></td>
                            <td><?php echo date('d/m/Y', strtotime($quiz['created_at'])); ?></td>
                            <td>
                                <a href="<?php echo APP_URL; ?>?page=quiz&action=edit&id=<?php echo $quiz['id']; ?>" class="btn btn-sm btn-success">Edit</a>
                                <a href="<?php echo APP_URL; ?>?page=quiz&action=delete&id=<?php echo $quiz['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Yakin ingin menghapus quiz ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../layouts/footer.php'; ?>

