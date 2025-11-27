<?php
require_once __DIR__ . '/../config/database.php';

function getProgressByUser($user_id) {
    $conn = getConnection();
    $query = "SELECT p.*, l.title as lesson_title, c.title as course_title
              FROM progress p
              JOIN lessons l ON p.lesson_id = l.lesson_id
              JOIN courses c ON l.course_id = c.course_id
              WHERE p.user_id = :user_id
              ORDER BY p.last_seen_at DESC";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getProgressByUserAndLesson($user_id, $lesson_id) {
    $conn = getConnection();
    $query = "SELECT * FROM progress WHERE user_id = :user_id AND lesson_id = :lesson_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':lesson_id', $lesson_id);
    $stmt->execute();
    return $stmt->fetch();
}

function createOrUpdateProgress($user_id, $lesson_id, $data) {
    $conn = getConnection();
    $existing = getProgressByUserAndLesson($user_id, $lesson_id);
    
    if ($existing) {
        $query = "UPDATE progress SET 
                  progress_percent = :progress_percent,
                  completed = :completed,
                  last_seen_at = NOW()
                  WHERE user_id = :user_id AND lesson_id = :lesson_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':lesson_id', $lesson_id);
        $stmt->bindParam(':progress_percent', $data['progress_percent']);
        $stmt->bindParam(':completed', $data['completed']);
    } else {
        $query = "INSERT INTO progress (user_id, lesson_id, progress_percent, completed, last_seen_at) 
                  VALUES (:user_id, :lesson_id, :progress_percent, :completed, NOW())";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':lesson_id', $lesson_id);
        $stmt->bindParam(':progress_percent', $data['progress_percent']);
        $stmt->bindParam(':completed', $data['completed']);
    }
    
    return $stmt->execute();
}

function getStatistikUser($user_id) {
    $conn = getConnection();
    $query = "SELECT 
                COUNT(*) as total_lessons,
                SUM(CASE WHEN completed = 1 THEN 1 ELSE 0 END) as lessons_completed,
                SUM(CASE WHEN completed = 0 THEN 1 ELSE 0 END) as lessons_in_progress,
                AVG(progress_percent) as avg_progress
              FROM progress
              WHERE user_id = :user_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    return $stmt->fetch();
}
