<?php
require_once __DIR__ . '/../config/database.php';

function getAllModul() {
    $conn = getConnection();
    $query = "SELECT m.*, u.full_name as created_by_name 
              FROM modul m 
              LEFT JOIN users u ON m.created_by = u.id 
              ORDER BY m.urutan ASC, m.created_at DESC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getModulById($id) {
    $conn = getConnection();
    $query = "SELECT m.*, u.full_name as created_by_name 
              FROM modul m 
              LEFT JOIN users u ON m.created_by = u.id 
              WHERE m.id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}

function createModul($data) {
    $conn = getConnection();
    $query = "INSERT INTO modul (judul, deskripsi, konten, video_url, audio_url, file_url, urutan, created_by) 
              VALUES (:judul, :deskripsi, :konten, :video_url, :audio_url, :file_url, :urutan, :created_by)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':judul', $data['judul']);
    $stmt->bindParam(':deskripsi', $data['deskripsi']);
    $stmt->bindParam(':konten', $data['konten']);
    $stmt->bindParam(':video_url', $data['video_url']);
    $stmt->bindParam(':audio_url', $data['audio_url']);
    $stmt->bindParam(':file_url', $data['file_url']);
    $stmt->bindParam(':urutan', $data['urutan']);
    $stmt->bindParam(':created_by', $data['created_by']);
    
    if ($stmt->execute()) {
        return $conn->lastInsertId();
    }
    return false;
}

function updateModul($id, $data) {
    $conn = getConnection();
    $query = "UPDATE modul SET 
              judul = :judul,
              deskripsi = :deskripsi,
              konten = :konten,
              video_url = :video_url,
              audio_url = :audio_url,
              file_url = :file_url,
              urutan = :urutan
              WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':judul', $data['judul']);
    $stmt->bindParam(':deskripsi', $data['deskripsi']);
    $stmt->bindParam(':konten', $data['konten']);
    $stmt->bindParam(':video_url', $data['video_url']);
    $stmt->bindParam(':audio_url', $data['audio_url']);
    $stmt->bindParam(':file_url', $data['file_url']);
    $stmt->bindParam(':urutan', $data['urutan']);
    
    return $stmt->execute();
}

function deleteModul($id) {
    $conn = getConnection();
    $query = "DELETE FROM modul WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

function getTotalModul() {
    $conn = getConnection();
    $query = "SELECT COUNT(*) as total FROM modul";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['total'];
}
