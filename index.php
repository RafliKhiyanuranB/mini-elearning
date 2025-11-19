<?php
$pageTitle = 'Dashboard E-Learning Tematik SD';
require_once __DIR__ . '/data/materi.php';
require_once __DIR__ . '/includes/header.php';
?>

<main>
    <section id="hero" class="hero">
        <div class="wrapper hero-grid">
            <div>
                <p class="eyebrow">Modul Literasi Digital Kelas 4-6</p>
                <h1>Mini E-Learning ceria untuk siswa Sekolah Dasar</h1>
                <p class="lead">
                    Jadikan portal ini rumah belajar tematik: mulai dari kenalan perangkat,
                    jelajah internet aman, sampai membuat poster digital penuh warna.
                </p>
                <div class="hero-actions">
                    <a class="cta" href="materi.php">Lihat Materi</a>
                    <a class="ghost" href="#aktivitas">Rencana Mingguan</a>
                </div>
                <ul class="metrics">
                    <li>
                        <strong><?= count($materiPaw); ?> Tema</strong>
                        <span>Literasi digital SD</span>
                    </li>
                    <li>
                        <strong>3 Aktivitas</strong>
                        <span>Fun & kolaboratif</span>
                    </li>
                    <li>
                        <strong>100%</strong>
                        <span>Siap daring/luring</span>
                    </li>
                </ul>
            </div>
            <div class="hero-card">
                <p class="card-title">Checklist Pertemuan Berikutnya</p>
                <ul>
                    <li>Periksa perangkat tablet & headset</li>
                    <li>Siapkan ice breaking 5 menit</li>
                    <li>Unggah lembar aktivitas mingguan</li>
                </ul>
                <div class="progress">
                    <span>Progress kelas</span>
                    <div class="progress-bar">
                        <div class="progress-value" style="width: 45%"></div>
                    </div>
                    <small>4 dari 14 pertemuan</small>
                </div>
            </div>
        </div>
    </section>

    <section id="materi" class="section">
        <div class="wrapper">
            <header class="section-header">
                <div>
                    <p class="eyebrow">Materi Tematik</p>
                    <h2>Roadmap Belajar Ceria</h2>
                    <p>Pilih tema mingguan lengkap dengan tujuan belajar ramah anak.</p>
                </div>
                <a class="ghost" href="materi.php">Lihat Semua</a>
            </header>
            <div class="grid-3">
                <?php foreach ($materiPaw as $materi): ?>
                    <article class="card">
                        <p class="card-meta"><?= htmlspecialchars($materi['pertemuan']); ?></p>
                        <h3><?= htmlspecialchars($materi['judul']); ?></h3>
                        <p><?= htmlspecialchars($materi['deskripsi']); ?></p>
                        <ul class="list-dot">
                            <?php foreach (array_slice($materi['learning_outcomes'], 0, 2) as $outcome): ?>
                                <li><?= htmlspecialchars($outcome); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <a class="cta ghost" href="materi.php?id=<?= urlencode($materi['id']); ?>">Detail Modul</a>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section id="aktivitas" class="section alt">
        <div class="wrapper two-column">
            <div>
                <p class="eyebrow">Aktivitas Kelas</p>
                <h2>Format Belajar Ramah Anak</h2>
                <p>Kombinasikan belajar sinkron dan mandiri dengan pendekatan bermain sambil belajar.</p>
                <ul class="list-check">
                    <li>Live session via Teams/Zoom Kids + rekaman singkat.</li>
                    <li>Pojok cerita digital menggunakan Padlet atau Wakelet.</li>
                    <li>Kuis ringan dengan Quizizz / Wordwall emoji.</li>
                </ul>
            </div>
            <div class="card timeline">
                <h3>Ritme Mingguan</h3>
                <ol>
                    <li><span>Senin</span> Video pengantar + lembar eksplorasi.</li>
                    <li><span>Rabu</span> Kelas virtual + eksperimen sederhana.</li>
                    <li><span>Jumat</span> Pamer karya & refleksi ceria.</li>
                </ol>
            </div>
        </div>
    </section>

    <section id="progress" class="section">
        <div class="wrapper two-column">
            <div>
                <p class="eyebrow">Monitoring</p>
                <h2>Tracker Siswa</h2>
                    <p>Pantau perkembangan siswa dan catat kebutuhan pendampingan secara cepat.</p>
                <table class="progress-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Modul Terakhir</th>
                            <th>Skor Rata-rata</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ani Pratama</td>
                            <td>Poster Digital</td>
                            <td>92</td>
                            <td><span class="badge success">Semangat</span></td>
                        </tr>
                        <tr>
                            <td>Bagus Hidayat</td>
                            <td>Internet Aman</td>
                            <td>78</td>
                            <td><span class="badge warning">Perlu Dampingan</span></td>
                        </tr>
                        <tr>
                            <td>Citra Lestari</td>
                            <td>Scratch Jr</td>
                            <td>85</td>
                            <td><span class="badge success">Semangat</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card">
                <h3>Catatan Guru</h3>
                <form class="notes-form" method="post" action="#" onsubmit="return false;">
                    <label>
                        Pertemuan
                        <select>
                            <?php foreach ($materiPaw as $materi): ?>
                                <option value="<?= htmlspecialchars($materi['id']); ?>"><?= htmlspecialchars($materi['pertemuan']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label>
                        Ringkasan
                        <textarea rows="4" placeholder="Contoh: Perlu ulangi aturan daring aman sebelum tugas."></textarea>
                    </label>
                    <button type="submit" class="cta">Simpan Catatan</button>
                </form>
            </div>
        </div>
    </section>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>

