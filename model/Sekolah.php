<?php
require_once __DIR__ . '/../config/database.php';

function getAllSekolah() {
    $conn = getConnection();
    $query = "SELECT * FROM sekolah ORDER BY nama_sekolah ASC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getSekolahById($id) {
    $conn = getConnection();
    $query = "SELECT * FROM sekolah WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}

function createSekolah($data) {
    $conn = getConnection();
    $query = "INSERT INTO sekolah (nama_sekolah, alamat, no_telp, email) 
              VALUES (:nama_sekolah, :alamat, :no_telp, :email)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nama_sekolah', $data['nama_sekolah']);
    $stmt->bindParam(':alamat', $data['alamat']);
    $stmt->bindParam(':no_telp', $data['no_telp']);
    $stmt->bindParam(':email', $data['email']);
    
    if ($stmt->execute()) {
        return $conn->lastInsertId();
    }
    return false;
}

function updateSekolah($id, $data) {
    $conn = getConnection();
    $query = "UPDATE sekolah SET 
              nama_sekolah = :nama_sekolah,
              alamat = :alamat,
              no_telp = :no_telp,
              email = :email
              WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nama_sekolah', $data['nama_sekolah']);
    $stmt->bindParam(':alamat', $data['alamat']);
    $stmt->bindParam(':no_telp', $data['no_telp']);
    $stmt->bindParam(':email', $data['email']);
    
    return $stmt->execute();
}

function deleteSekolah($id) {
    $conn = getConnection();
    $query = "DELETE FROM sekolah WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

function getTotalSekolah() {
    $conn = getConnection();
    $query = "SELECT COUNT(*) as total FROM sekolah";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['total'];
}
