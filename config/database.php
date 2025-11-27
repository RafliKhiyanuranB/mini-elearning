<?php
function getConnection() {
    $host = 'localhost';
    $db_name = 'mini_elearning';
    $username = 'root';
    $password = '';
    $conn = null;
    
    try {
        $conn = new PDO(
            "mysql:host=" . $host . ";dbname=" . $db_name . ";charset=utf8mb4",
            $username,
            $password
        );
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        echo "Koneksi database gagal: " . $e->getMessage();
    }
    
    return $conn;
}
