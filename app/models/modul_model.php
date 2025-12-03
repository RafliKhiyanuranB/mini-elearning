<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/db_functions.php';

// Fungsi untuk mendapatkan semua modul
function get_all_modul() {
    $sql = "SELECT * FROM modul ORDER BY urutan ASC, created_at DESC";
    return db_fetch_all($sql);
}

// Fungsi untuk mendapatkan modul by id
function get_modul_by_id($id) {
    $sql = "SELECT * FROM modul WHERE id = ?";
    return db_fetch_one($sql, [$id]);
}

// Fungsi untuk tambah modul
function create_modul($judul, $deskripsi, $file_path, $tipe_file, $urutan) {
    $sql = "INSERT INTO modul (judul, deskripsi, file_path, tipe_file, urutan) VALUES (?, ?, ?, ?, ?)";
    return db_insert($sql, [$judul, $deskripsi, $file_path, $tipe_file, $urutan]);
}

// Fungsi untuk update modul
function update_modul($id, $judul, $deskripsi, $file_path, $tipe_file, $urutan) {
    if ($file_path) {
        $sql = "UPDATE modul SET judul = ?, deskripsi = ?, file_path = ?, tipe_file = ?, urutan = ? WHERE id = ?";
        return db_execute($sql, [$judul, $deskripsi, $file_path, $tipe_file, $urutan, $id]);
    } else {
        $sql = "UPDATE modul SET judul = ?, deskripsi = ?, tipe_file = ?, urutan = ? WHERE id = ?";
        return db_execute($sql, [$judul, $deskripsi, $tipe_file, $urutan, $id]);
    }
}

// Fungsi untuk hapus modul
function delete_modul($id) {
    // Hapus file jika ada
    $modul = get_modul_by_id($id);
    if ($modul && $modul['file_path']) {
        $file_path = BASE_PATH . '/app/assets/uploads/' . $modul['file_path'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }
    
    $sql = "DELETE FROM modul WHERE id = ?";
    return db_execute($sql, [$id]);
}

// Fungsi untuk mendapatkan modul untuk user (view)
function get_modul_for_user() {
    $sql = "SELECT * FROM modul ORDER BY urutan ASC, created_at DESC";
    return db_fetch_all($sql);
}
?>

