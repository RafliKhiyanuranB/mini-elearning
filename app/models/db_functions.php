<?php
require_once __DIR__ . '/../config/database.php';

// Helper function untuk eksekusi query
function db_query($sql, $params = []) {
    $conn = get_db_connection();
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return false;
    }
}

// Helper function untuk fetch semua data
function db_fetch_all($sql, $params = []) {
    $stmt = db_query($sql, $params);
    if ($stmt) {
        return $stmt->fetchAll();
    }
    return [];
}

// Helper function untuk fetch satu data
function db_fetch_one($sql, $params = []) {
    $stmt = db_query($sql, $params);
    if ($stmt) {
        return $stmt->fetch();
    }
    return false;
}

// Helper function untuk insert dan return last insert id
function db_insert($sql, $params = []) {
    $conn = get_db_connection();
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $conn->lastInsertId();
    } catch (PDOException $e) {
        error_log("Database insert error: " . $e->getMessage());
        return false;
    }
}

// Helper function untuk update/delete
function db_execute($sql, $params = []) {
    $stmt = db_query($sql, $params);
    if ($stmt) {
        return $stmt->rowCount();
    }
    return false;
}
?>

