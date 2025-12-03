<?php
require_once __DIR__ . '/db_functions.php';

// Fungsi untuk mendapatkan semua user
function get_all_users($role = null) {
    if ($role) {
        $sql = "SELECT u.id, u.username, u.nama, u.role, u.sekolah_id, u.created_at, s.nama_sekolah 
                FROM users u 
                LEFT JOIN sekolah s ON u.sekolah_id = s.id 
                WHERE u.role = ? 
                ORDER BY u.created_at DESC";
        return db_fetch_all($sql, [$role]);
    } else {
        $sql = "SELECT u.id, u.username, u.nama, u.role, u.sekolah_id, u.created_at, s.nama_sekolah 
                FROM users u 
                LEFT JOIN sekolah s ON u.sekolah_id = s.id 
                ORDER BY u.created_at DESC";
        return db_fetch_all($sql);
    }
}

// Fungsi untuk mendapatkan user by id
function get_user_by_id($id) {
    $sql = "SELECT u.id, u.username, u.nama, u.role, u.sekolah_id, u.created_at, s.nama_sekolah 
            FROM users u 
            LEFT JOIN sekolah s ON u.sekolah_id = s.id 
            WHERE u.id = ?";
    return db_fetch_one($sql, [$id]);
}

// Fungsi untuk cek username sudah ada
function username_exists($username, $exclude_id = null) {
    if ($exclude_id) {
        $sql = "SELECT COUNT(*) as count FROM users WHERE username = ? AND id != ?";
        $result = db_fetch_one($sql, [$username, $exclude_id]);
    } else {
        $sql = "SELECT COUNT(*) as count FROM users WHERE username = ?";
        $result = db_fetch_one($sql, [$username]);
    }
    return $result && $result['count'] > 0;
}

// Fungsi untuk tambah user
function create_user($username, $password, $nama, $role, $sekolah_id) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password, nama, role, sekolah_id) VALUES (?, ?, ?, ?, ?)";
    return db_insert($sql, [$username, $hashed_password, $nama, $role, $sekolah_id]);
}

// Fungsi untuk update user
function update_user($id, $username, $password, $nama, $role, $sekolah_id) {
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET username = ?, password = ?, nama = ?, role = ?, sekolah_id = ? WHERE id = ?";
        return db_execute($sql, [$username, $hashed_password, $nama, $role, $sekolah_id, $id]);
    } else {
        $sql = "UPDATE users SET username = ?, nama = ?, role = ?, sekolah_id = ? WHERE id = ?";
        return db_execute($sql, [$username, $nama, $role, $sekolah_id, $id]);
    }
}

// Fungsi untuk hapus user
function delete_user($id) {
    $sql = "DELETE FROM users WHERE id = ?";
    return db_execute($sql, [$id]);
}
?>

