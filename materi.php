<?php
require_once __DIR__ . '/data/materi.php';

$id = $_GET['id'] ?? null;
$materiTerpilih = $id ? cariMateri($id) : null;
$pageTitle = $materiTerpilih
    ? $materiTerpilih['pertemuan'] . ' - ' . $materiTerpilih['judul']
    : 'Daftar Materi Tematik SD';

require_once __DIR__ . '/includes/header.php';
?>

<main class="section">
    <div class="wrapper materi-layout">
        <aside class="sidebar">
            <h2>Modul Tematik</h2>
            <ul>
                <?php foreach ($materiPaw as $materi): ?>
                    <li class="<?= $materiTerpilih && $materiTerpilih['id'] === $materi['id'] ? 'active' : ''; ?>">
                        <a href="?id=<?= urlencode($materi['id']); ?>">
                            <span><?= htmlspecialchars($materi['pertemuan']); ?></span>
                            <strong><?= htmlspecialchars($materi['judul']); ?></strong>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>

        <section class="materi-content">
            <?php if ($materiTerpilih): ?>
                <p class="eyebrow"><?= htmlspecialchars($materiTerpilih['pertemuan']); ?></p>
                <h1><?= htmlspecialchars($materiTerpilih['judul']); ?></h1>
                <p class="lead"><?= htmlspecialchars($materiTerpilih['deskripsi']); ?></p>

                <div class="content-grid">
                    <article>
                        <h3>Tujuan Belajar</h3>
                        <ul class="list-check">
                            <?php foreach ($materiTerpilih['learning_outcomes'] as $outcome): ?>
                                <li><?= htmlspecialchars($outcome); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </article>
                    <article>
                        <h3>Aktivitas Kelas</h3>
                        <ul class="list-dot">
                            <?php foreach ($materiTerpilih['aktivitas'] as $aktivitas): ?>
                                <li><?= htmlspecialchars($aktivitas); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </article>
                    <article>
                        <h3>Proyek / Tugas</h3>
                        <ol>
                            <?php foreach ($materiTerpilih['praktikum'] as $tugas): ?>
                                <li><?= htmlspecialchars($tugas); ?></li>
                            <?php endforeach; ?>
                        </ol>
                    </article>
                    <article>
                        <h3>Referensi Ceria</h3>
                        <ul class="list-link">
                            <?php foreach ($materiTerpilih['referensi'] as $ref): ?>
                                <li><a href="#"><?= htmlspecialchars($ref); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </article>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <h2>Pilih modul untuk melihat detail materi.</h2>
                    <p>Silakan klik salah satu pertemuan di panel kiri.</p>
                </div>
            <?php endif; ?>
        </section>
    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

