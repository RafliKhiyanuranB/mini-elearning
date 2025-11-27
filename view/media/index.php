<?php
$page_title = 'Manajemen Media';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="actions">
    <a href="index.php?action=media_upload" class="btn btn-primary">Upload Media</a>
</div>

<div class="card">
    <h2>Daftar Media</h2>
    <div class="table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama File</th>
                    <th>Tipe</th>
                    <th>Ukuran</th>
                    <th>Modul</th>
                    <th>Uploaded By</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($media)): ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 30px;">Tidak ada media</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($media as $m): ?>
                        <tr>
                            <td><?php echo $m['id']; ?></td>
                            <td><?php echo htmlspecialchars($m['original_filename']); ?></td>
                            <td>
                                <span style="padding: 5px 10px; border-radius: 5px; background: 
                                    <?php 
                                        echo $m['file_type'] === 'video' ? '#667eea' : 
                                            ($m['file_type'] === 'audio' ? '#51cf66' : '#6c757d'); 
                                    ?>; color: white;">
                                    <?php echo ucfirst($m['file_type']); ?>
                                </span>
                            </td>
                            <td><?php echo number_format($m['file_size'] / 1024, 2); ?> KB</td>
                            <td><?php echo htmlspecialchars($m['modul_judul'] ?? '-'); ?></td>
                            <td><?php echo htmlspecialchars($m['uploaded_by_name'] ?? '-'); ?></td>
                            <td>
                                <a href="<?php echo htmlspecialchars($m['file_path']); ?>" target="_blank" class="btn btn-sm btn-primary">Lihat</a>
                                <a href="index.php?action=media_delete&id=<?php echo $m['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Yakin ingin menghapus file ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

