<?php
require_once __DIR__ . '/../config/database.php';

function leaderboardIndex() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?action=login');
        exit;
    }
    
    // Ranking per sekolah
    $rankingSekolah = getRankingSekolah();
    
    // Ranking per user
    $rankingUser = getRankingUser();
    
    // Ranking user saat ini
    $currentUserRank = getCurrentUserRank();
    
    require_once __DIR__ . '/../view/leaderboard/index.php';
}

function getRankingSekolah() {
    $conn = getConnection();
    $query = "SELECT 
                s.id,
                s.nama_sekolah,
                COUNT(DISTINCT u.id) as total_user,
                COUNT(DISTINCT p.id) as total_modul_selesai,
                SUM(p.waktu_belajar) as total_waktu_belajar,
                COALESCE(AVG(p.progress_percent), 0) as rata_progress,
                COALESCE(SUM(uj.skor), 0) as total_skor_quiz,
                COALESCE(AVG(uj.skor), 0) as rata_skor_quiz
              FROM sekolah s
              LEFT JOIN users u ON s.id = u.sekolah_id AND u.role = 'user'
              LEFT JOIN progress p ON u.id = p.user_id AND p.status = 'selesai'
              LEFT JOIN user_jawaban uj ON u.id = uj.user_id
              GROUP BY s.id, s.nama_sekolah
              HAVING total_user > 0
              ORDER BY total_skor_quiz DESC, total_modul_selesai DESC, rata_skor_quiz DESC";
    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getRankingUser() {
    $conn = getConnection();
    $query = "SELECT 
                u.id,
                u.username,
                u.full_name,
                s.nama_sekolah,
                COUNT(DISTINCT p.id) as total_modul_selesai,
                SUM(p.waktu_belajar) as total_waktu_belajar,
                COALESCE(AVG(p.progress_percent), 0) as rata_progress,
                COALESCE(SUM(uj.skor), 0) as total_skor_quiz,
                COALESCE(AVG(uj.skor), 0) as rata_skor_quiz,
                COUNT(DISTINCT uj.id) as total_quiz_dikerjakan
              FROM users u
              LEFT JOIN sekolah s ON u.sekolah_id = s.id
              LEFT JOIN progress p ON u.id = p.user_id AND p.status = 'selesai'
              LEFT JOIN user_jawaban uj ON u.id = uj.user_id
              WHERE u.role = 'user'
              GROUP BY u.id, u.username, u.full_name, s.nama_sekolah
              ORDER BY total_skor_quiz DESC, total_modul_selesai DESC, rata_skor_quiz DESC
              LIMIT 50";
    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getCurrentUserRank() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
        return null;
    }
    
    $conn = getConnection();
    $query = "SELECT 
                u.id,
                u.username,
                u.full_name,
                s.nama_sekolah,
                COUNT(DISTINCT p.id) as total_modul_selesai,
                SUM(p.waktu_belajar) as total_waktu_belajar,
                COALESCE(AVG(p.progress_percent), 0) as rata_progress,
                COALESCE(SUM(uj.skor), 0) as total_skor_quiz,
                COALESCE(AVG(uj.skor), 0) as rata_skor_quiz,
                COUNT(DISTINCT uj.id) as total_quiz_dikerjakan
              FROM users u
              LEFT JOIN sekolah s ON u.sekolah_id = s.id
              LEFT JOIN progress p ON u.id = p.user_id AND p.status = 'selesai'
              LEFT JOIN user_jawaban uj ON u.id = uj.user_id
              WHERE u.id = :user_id
              GROUP BY u.id, u.username, u.full_name, s.nama_sekolah";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
    return $stmt->fetch();
}
