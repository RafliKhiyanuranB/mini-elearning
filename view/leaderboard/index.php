<?php
$page_title = 'Perangkingan / Leaderboard';
require_once __DIR__ . '/../includes/header.php';
?>

<div class="card">
    <h2>🏆 Ranking Per Sekolah</h2>
    
    <?php if (empty($rankingSekolah)): ?>
        <p>Tidak ada data ranking sekolah</p>
    <?php else: ?>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Nama Sekolah</th>
                        <th>Total User</th>
                        <th>Modul Selesai</th>
                        <th>Total Skor Quiz</th>
                        <th>Rata-rata Skor</th>
                        <th>Total Waktu Belajar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $rank = 1;
                    foreach ($rankingSekolah as $sekolah): 
                        $medal = '';
                        if ($rank == 1) $medal = '🥇';
                        elseif ($rank == 2) $medal = '🥈';
                        elseif ($rank == 3) $medal = '🥉';
                    ?>
                        <tr style="<?php echo $rank <= 3 ? 'background: #fff9e6; font-weight: bold;' : ''; ?>">
                            <td>
                                <strong><?php echo $medal . ' ' . $rank; ?></strong>
                            </td>
                            <td><?php echo htmlspecialchars($sekolah['nama_sekolah']); ?></td>
                            <td><?php echo $sekolah['total_user']; ?></td>
                            <td><?php echo $sekolah['total_modul_selesai']; ?></td>
                            <td><strong><?php echo number_format($sekolah['total_skor_quiz']); ?></strong></td>
                            <td><?php echo number_format($sekolah['rata_skor_quiz'], 1); ?></td>
                            <td><?php echo $sekolah['total_waktu_belajar']; ?> menit</td>
                        </tr>
                    <?php 
                        $rank++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<div class="card">
    <h2>👥 Ranking Per User</h2>
    
    <?php if (empty($rankingUser)): ?>
        <p>Tidak ada data ranking user</p>
    <?php else: ?>
        <div class="table">
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>Nama User</th>
                        <th>Sekolah</th>
                        <th>Modul Selesai</th>
                        <th>Total Skor Quiz</th>
                        <th>Rata-rata Skor</th>
                        <th>Quiz Dikerjakan</th>
                        <th>Waktu Belajar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $rank = 1;
                    foreach ($rankingUser as $user): 
                        $medal = '';
                        if ($rank == 1) $medal = '🥇';
                        elseif ($rank == 2) $medal = '🥈';
                        elseif ($rank == 3) $medal = '🥉';
                        
                        $isCurrentUser = isset($_SESSION['user_id']) && $user['id'] == $_SESSION['user_id'];
                    ?>
                        <tr style="<?php 
                            if ($rank <= 3) echo 'background: #fff9e6; font-weight: bold;';
                            if ($isCurrentUser) echo 'background: #e6f3ff; border: 2px solid #667eea;';
                        ?>">
                            <td>
                                <strong><?php echo $medal . ' ' . $rank; ?></strong>
                            </td>
                            <td>
                                <?php echo htmlspecialchars($user['full_name']); ?>
                                <?php if ($isCurrentUser): ?>
                                    <span style="color: #667eea; font-weight: bold;">(Anda)</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($user['nama_sekolah'] ?? '-'); ?></td>
                            <td><?php echo $user['total_modul_selesai']; ?></td>
                            <td><strong><?php echo number_format($user['total_skor_quiz']); ?></strong></td>
                            <td><?php echo number_format($user['rata_skor_quiz'], 1); ?></td>
                            <td><?php echo $user['total_quiz_dikerjakan']; ?></td>
                            <td><?php echo $user['total_waktu_belajar']; ?> menit</td>
                        </tr>
                    <?php 
                        $rank++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>

<?php if ($currentUserRank): ?>
<div class="card" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white;">
    <h2 style="color: white;">📊 Posisi Anda</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 20px;">
        <div>
            <h3 style="color: white; font-size: 14px; margin-bottom: 5px;">Ranking</h3>
            <div style="font-size: 36px; font-weight: bold;">
                <?php 
                // Hitung ranking manual
                $userRank = 1;
                foreach ($rankingUser as $u) {
                    if ($u['id'] == $_SESSION['user_id']) break;
                    $userRank++;
                }
                echo $userRank;
                ?>
            </div>
        </div>
        <div>
            <h3 style="color: white; font-size: 14px; margin-bottom: 5px;">Total Skor</h3>
            <div style="font-size: 36px; font-weight: bold;"><?php echo number_format($currentUserRank['total_skor_quiz']); ?></div>
        </div>
        <div>
            <h3 style="color: white; font-size: 14px; margin-bottom: 5px;">Modul Selesai</h3>
            <div style="font-size: 36px; font-weight: bold;"><?php echo $currentUserRank['total_modul_selesai']; ?></div>
        </div>
        <div>
            <h3 style="color: white; font-size: 14px; margin-bottom: 5px;">Rata-rata Skor</h3>
            <div style="font-size: 36px; font-weight: bold;"><?php echo number_format($currentUserRank['rata_skor_quiz'], 1); ?></div>
        </div>
    </div>
</div>
<?php endif; ?>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>

