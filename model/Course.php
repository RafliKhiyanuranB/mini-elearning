<?php
require_once __DIR__ . '/../config/database.php';

function getAllCourses() {
    $conn = getConnection();
    $query = "SELECT * FROM courses ORDER BY created_at DESC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getCourseById($id) {
    $conn = getConnection();
    $query = "SELECT * FROM courses WHERE course_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}

function createCourse($data) {
    $conn = getConnection();
    $query = "INSERT INTO courses (title, description, is_published) 
              VALUES (:title, :description, :is_published)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':title', $data['title']);
    $stmt->bindParam(':description', $data['description']);
    $stmt->bindParam(':is_published', $data['is_published']);
    
    if ($stmt->execute()) {
        return $conn->lastInsertId();
    }
    return false;
}

function updateCourse($id, $data) {
    $conn = getConnection();
    $query = "UPDATE courses SET 
              title = :title,
              description = :description,
              is_published = :is_published
              WHERE course_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':title', $data['title']);
    $stmt->bindParam(':description', $data['description']);
    $stmt->bindParam(':is_published', $data['is_published']);
    
    return $stmt->execute();
}

function deleteCourse($id) {
    $conn = getConnection();
    $query = "DELETE FROM courses WHERE course_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

function getTotalCourses() {
    $conn = getConnection();
    $query = "SELECT COUNT(*) as total FROM courses";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['total'];
}

