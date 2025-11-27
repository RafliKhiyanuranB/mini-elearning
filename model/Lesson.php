<?php
require_once __DIR__ . '/../config/database.php';

function getAllLessons($course_id = null) {
    $conn = getConnection();
    if ($course_id) {
        $query = "SELECT l.*, c.title as course_title 
                  FROM lessons l 
                  LEFT JOIN courses c ON l.course_id = c.course_id 
                  WHERE l.course_id = :course_id
                  ORDER BY l.order_index ASC, l.created_at DESC";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':course_id', $course_id);
    } else {
        $query = "SELECT l.*, c.title as course_title 
                  FROM lessons l 
                  LEFT JOIN courses c ON l.course_id = c.course_id 
                  ORDER BY l.order_index ASC, l.created_at DESC";
        $stmt = $conn->prepare($query);
    }
    $stmt->execute();
    return $stmt->fetchAll();
}

function getLessonById($id) {
    $conn = getConnection();
    $query = "SELECT l.*, c.title as course_title 
              FROM lessons l 
              LEFT JOIN courses c ON l.course_id = c.course_id 
              WHERE l.lesson_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}

function createLesson($data) {
    $conn = getConnection();
    $query = "INSERT INTO lessons (course_id, title, content, order_index, is_active) 
              VALUES (:course_id, :title, :content, :order_index, :is_active)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':course_id', $data['course_id']);
    $stmt->bindParam(':title', $data['title']);
    $stmt->bindParam(':content', $data['content']);
    $stmt->bindParam(':order_index', $data['order_index']);
    $stmt->bindParam(':is_active', $data['is_active']);
    
    if ($stmt->execute()) {
        return $conn->lastInsertId();
    }
    return false;
}

function updateLesson($id, $data) {
    $conn = getConnection();
    $query = "UPDATE lessons SET 
              course_id = :course_id,
              title = :title,
              content = :content,
              order_index = :order_index,
              is_active = :is_active
              WHERE lesson_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':course_id', $data['course_id']);
    $stmt->bindParam(':title', $data['title']);
    $stmt->bindParam(':content', $data['content']);
    $stmt->bindParam(':order_index', $data['order_index']);
    $stmt->bindParam(':is_active', $data['is_active']);
    
    return $stmt->execute();
}

function deleteLesson($id) {
    $conn = getConnection();
    $query = "DELETE FROM lessons WHERE lesson_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

