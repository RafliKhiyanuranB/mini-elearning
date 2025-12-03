<?php
require_once __DIR__ . '/db_functions.php';

// Fungsi untuk mendapatkan semua quiz
function get_all_quiz($modul_id = null) {
    if ($modul_id) {
        $sql = "SELECT q.*, m.judul as modul_judul 
                FROM quiz q 
                JOIN modul m ON q.modul_id = m.id 
                WHERE q.modul_id = ? 
                ORDER BY q.created_at DESC";
        return db_fetch_all($sql, [$modul_id]);
    } else {
        $sql = "SELECT q.*, m.judul as modul_judul 
                FROM quiz q 
                JOIN modul m ON q.modul_id = m.id 
                ORDER BY q.created_at DESC";
        return db_fetch_all($sql);
    }
}

// Fungsi untuk mendapatkan quiz by id
function get_quiz_by_id($id) {
    $sql = "SELECT q.*, m.judul as modul_judul 
            FROM quiz q 
            JOIN modul m ON q.modul_id = m.id 
            WHERE q.id = ?";
    return db_fetch_one($sql, [$id]);
}

// Fungsi untuk mendapatkan quiz untuk user berdasarkan modul
function get_quiz_by_modul_for_user($modul_id) {
    $sql = "SELECT q.*, m.judul as modul_judul 
            FROM quiz q 
            JOIN modul m ON q.modul_id = m.id 
            WHERE q.modul_id = ? 
            ORDER BY q.created_at ASC";
    return db_fetch_all($sql, [$modul_id]);
}

// Fungsi untuk tambah quiz
function create_quiz($modul_id, $pertanyaan, $pilihan_a, $pilihan_b, $pilihan_c, $pilihan_d, $jawaban_benar, $poin) {
    $sql = "INSERT INTO quiz (modul_id, pertanyaan, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar, poin) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    return db_insert($sql, [$modul_id, $pertanyaan, $pilihan_a, $pilihan_b, $pilihan_c, $pilihan_d, $jawaban_benar, $poin]);
}

// Fungsi untuk update quiz
function update_quiz($id, $modul_id, $pertanyaan, $pilihan_a, $pilihan_b, $pilihan_c, $pilihan_d, $jawaban_benar, $poin) {
    $sql = "UPDATE quiz SET modul_id = ?, pertanyaan = ?, pilihan_a = ?, pilihan_b = ?, pilihan_c = ?, pilihan_d = ?, jawaban_benar = ?, poin = ? 
            WHERE id = ?";
    return db_execute($sql, [$modul_id, $pertanyaan, $pilihan_a, $pilihan_b, $pilihan_c, $pilihan_d, $jawaban_benar, $poin, $id]);
}

// Fungsi untuk hapus quiz
function delete_quiz($id) {
    $sql = "DELETE FROM quiz WHERE id = ?";
    return db_execute($sql, [$id]);
}

// Fungsi untuk mendapatkan semua modul (untuk dropdown)
function get_all_modul_for_quiz() {
    $sql = "SELECT * FROM modul ORDER BY urutan ASC, judul ASC";
    return db_fetch_all($sql);
}
?>

