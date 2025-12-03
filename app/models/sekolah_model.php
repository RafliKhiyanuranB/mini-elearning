<?php
require_once __DIR__ . '/db_functions.php';

// Fungsi untuk mendapatkan semua sekolah
function get_all_sekolah() {
    $sql = "SELECT * FROM sekolah ORDER BY nama_sekolah";
    return db_fetch_all($sql);
}

// Fungsi untuk mendapatkan sekolah by id
function get_sekolah_by_id($id) {
    $sql = "SELECT * FROM sekolah WHERE id = ?";
    return db_fetch_one($sql, [$id]);
}

// Fungsi untuk tambah sekolah
function create_sekolah($nama_sekolah, $alamat) {
    $sql = "INSERT INTO sekolah (nama_sekolah, alamat) VALUES (?, ?)";
    return db_insert($sql, [$nama_sekolah, $alamat]);
}

// Fungsi untuk update sekolah
function update_sekolah($id, $nama_sekolah, $alamat) {
    $sql = "UPDATE sekolah SET nama_sekolah = ?, alamat = ? WHERE id = ?";
    return db_execute($sql, [$nama_sekolah, $alamat, $id]);
}

// Fungsi untuk hapus sekolah
function delete_sekolah($id) {
    $sql = "DELETE FROM sekolah WHERE id = ?";
    return db_execute($sql, [$id]);
}

// Fungsi untuk mendapatkan ranking per sekolah
function get_ranking_by_sekolah($sekolah_id) {
    $sql = "SELECT r.*, u.nama, u.username, s.nama_sekolah 
            FROM ranking r
            JOIN users u ON r.user_id = u.id
            JOIN sekolah s ON r.sekolah_id = s.id
            WHERE r.sekolah_id = ?
            ORDER BY r.total_nilai DESC, r.updated_at ASC";
    return db_fetch_all($sql, [$sekolah_id]);
}

// Fungsi untuk update ranking user
function update_user_ranking($user_id, $sekolah_id) {
    // Hitung total nilai dari semua progress yang selesai
    $sql = "SELECT COALESCE(SUM(nilai), 0) as total_nilai 
            FROM progress 
            WHERE user_id = ? AND status = 'selesai'";
    $result = db_fetch_one($sql, [$user_id]);
    $total_nilai = $result['total_nilai'] ?? 0;
    
    // Cek apakah ranking sudah ada
    $check_sql = "SELECT id FROM ranking WHERE user_id = ? AND sekolah_id = ?";
    $existing = db_fetch_one($check_sql, [$user_id, $sekolah_id]);
    
    if ($existing) {
        // Update ranking
        $update_sql = "UPDATE ranking SET total_nilai = ? WHERE user_id = ? AND sekolah_id = ?";
        db_execute($update_sql, [$total_nilai, $user_id, $sekolah_id]);
    } else {
        // Insert ranking baru
        $insert_sql = "INSERT INTO ranking (user_id, sekolah_id, total_nilai) VALUES (?, ?, ?)";
        db_insert($insert_sql, [$user_id, $sekolah_id, $total_nilai]);
    }
    
    // Update peringkat berdasarkan total_nilai
    update_ranking_peringkat($sekolah_id);
}

// Fungsi untuk update peringkat berdasarkan total_nilai
function update_ranking_peringkat($sekolah_id) {
    $sql = "SET @rank = 0;
            UPDATE ranking 
            SET peringkat = (@rank := @rank + 1)
            WHERE sekolah_id = ?
            ORDER BY total_nilai DESC, updated_at ASC";
    
    // Karena MySQL tidak support multiple statements dalam satu query dengan PDO,
    // kita lakukan dengan cara lain
    $conn = get_db_connection();
    
    // Ambil semua ranking untuk sekolah ini
    $rankings = db_fetch_all("SELECT id, total_nilai, updated_at FROM ranking WHERE sekolah_id = ? ORDER BY total_nilai DESC, updated_at ASC", [$sekolah_id]);
    
    $rank = 1;
    foreach ($rankings as $ranking) {
        db_execute("UPDATE ranking SET peringkat = ? WHERE id = ?", [$rank, $ranking['id']]);
        $rank++;
    }
}
?>

