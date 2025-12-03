<?php
require_once __DIR__ . '/db_functions.php';
require_once __DIR__ . '/sekolah_model.php';

// Fungsi untuk mendapatkan progress user
function get_user_progress($user_id, $quiz_id = null) {
    if ($quiz_id) {
        $sql = "SELECT * FROM progress WHERE user_id = ? AND quiz_id = ?";
        return db_fetch_one($sql, [$user_id, $quiz_id]);
    } else {
        $sql = "SELECT p.*, q.pertanyaan, m.judul as modul_judul 
                FROM progress p 
                JOIN quiz q ON p.quiz_id = q.id 
                JOIN modul m ON q.modul_id = m.id 
                WHERE p.user_id = ? 
                ORDER BY p.tanggal_selesai DESC";
        return db_fetch_all($sql, [$user_id]);
    }
}

// Fungsi untuk simpan progress quiz
function save_quiz_progress($user_id, $quiz_id, $jawaban_user, $nilai, $status) {
    // Cek apakah progress sudah ada
    $existing = get_user_progress($user_id, $quiz_id);
    
    if ($existing) {
        // Update progress
        $sql = "UPDATE progress SET nilai = ?, status = ?, tanggal_selesai = ? WHERE user_id = ? AND quiz_id = ?";
        $tanggal_selesai = $status === 'selesai' ? date('Y-m-d H:i:s') : null;
        db_execute($sql, [$nilai, $status, $tanggal_selesai, $user_id, $quiz_id]);
    } else {
        // Insert progress baru
        $sql = "INSERT INTO progress (user_id, quiz_id, nilai, status, tanggal_selesai) VALUES (?, ?, ?, ?, ?)";
        $tanggal_selesai = $status === 'selesai' ? date('Y-m-d H:i:s') : null;
        db_insert($sql, [$user_id, $quiz_id, $nilai, $status, $tanggal_selesai]);
    }
    
    // Update ranking jika selesai
    if ($status === 'selesai') {
        $user = db_fetch_one("SELECT sekolah_id FROM users WHERE id = ?", [$user_id]);
        if ($user && $user['sekolah_id']) {
            update_user_ranking($user_id, $user['sekolah_id']);
        }
    }
}

// Fungsi untuk hitung nilai quiz
function calculate_quiz_score($quiz_id, $jawaban_user) {
    $quiz = db_fetch_one("SELECT jawaban_benar, poin FROM quiz WHERE id = ?", [$quiz_id]);
    
    if (!$quiz) {
        return 0;
    }
    
    if ($jawaban_user === $quiz['jawaban_benar']) {
        return $quiz['poin'];
    }
    
    return 0;
}

// Fungsi untuk mendapatkan progress per modul untuk user
function get_progress_by_modul($user_id, $modul_id) {
    $sql = "SELECT p.*, q.pertanyaan, q.poin 
            FROM progress p 
            JOIN quiz q ON p.quiz_id = q.id 
            WHERE p.user_id = ? AND q.modul_id = ? 
            ORDER BY q.created_at ASC";
    return db_fetch_all($sql, [$user_id, $modul_id]);
}

// Fungsi untuk mendapatkan statistik progress user
function get_user_progress_stats($user_id) {
    $sql = "SELECT 
                COUNT(*) as total_quiz,
                SUM(CASE WHEN status = 'selesai' THEN 1 ELSE 0 END) as quiz_selesai,
                COALESCE(SUM(nilai), 0) as total_nilai
            FROM progress 
            WHERE user_id = ?";
    $result = db_fetch_one($sql, [$user_id]);
    if (!$result) {
        return ['total_quiz' => 0, 'quiz_selesai' => 0, 'total_nilai' => 0];
    }
    return $result;
}
?>

