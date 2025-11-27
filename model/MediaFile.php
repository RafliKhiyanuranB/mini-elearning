<?php
require_once __DIR__ . '/../config/database.php';

function getAllMediaFiles($lesson_id = null) {
    $conn = getConnection();
    if ($lesson_id) {
        $query = "SELECT m.*, u.name as user_name, l.title as lesson_title
                  FROM media_uploads m
                  LEFT JOIN users u ON m.user_id = u.user_id
                  LEFT JOIN lessons l ON m.lesson_id = l.lesson_id
                  WHERE m.lesson_id = :lesson_id
                  ORDER BY m.uploaded_at DESC";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':lesson_id', $lesson_id);
    } else {
        $query = "SELECT m.*, u.name as user_name, l.title as lesson_title
                  FROM media_uploads m
                  LEFT JOIN users u ON m.user_id = u.user_id
                  LEFT JOIN lessons l ON m.lesson_id = l.lesson_id
                  ORDER BY m.uploaded_at DESC";
        $stmt = $conn->prepare($query);
    }
    $stmt->execute();
    return $stmt->fetchAll();
}

function getMediaFileById($id) {
    $conn = getConnection();
    $query = "SELECT * FROM media_uploads WHERE media_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}

function createMediaFile($data) {
    $conn = getConnection();
    $query = "INSERT INTO media_uploads (lesson_id, user_id, file_url, media_type) 
              VALUES (:lesson_id, :user_id, :file_url, :media_type)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':lesson_id', $data['lesson_id']);
    $stmt->bindParam(':user_id', $data['user_id']);
    $stmt->bindParam(':file_url', $data['file_url']);
    $stmt->bindParam(':media_type', $data['media_type']);
    
    if ($stmt->execute()) {
        return $conn->lastInsertId();
    }
    return false;
}

function deleteMediaFile($id) {
    $conn = getConnection();
    $query = "SELECT file_url FROM media_uploads WHERE media_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $file = $stmt->fetch();
    
    if ($file && file_exists($file['file_url'])) {
        unlink($file['file_url']);
    }
    
    $query = "DELETE FROM media_uploads WHERE media_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}
