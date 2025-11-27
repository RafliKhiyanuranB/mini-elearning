<?php
require_once __DIR__ . '/../config/database.php';

function getQuizByLesson($lesson_id) {
    $conn = getConnection();
    $query = "SELECT * FROM quizzes WHERE lesson_id = :lesson_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':lesson_id', $lesson_id);
    $stmt->execute();
    return $stmt->fetch();
}

function getQuizById($id) {
    $conn = getConnection();
    $query = "SELECT * FROM quizzes WHERE quiz_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}

function getQuestionsByQuiz($quiz_id) {
    $conn = getConnection();
    $query = "SELECT * FROM questions WHERE quiz_id = :quiz_id ORDER BY question_id ASC";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':quiz_id', $quiz_id);
    $stmt->execute();
    return $stmt->fetchAll();
}

function createQuiz($data) {
    $conn = getConnection();
    $query = "INSERT INTO quizzes (lesson_id, title, max_score) 
              VALUES (:lesson_id, :title, :max_score)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':lesson_id', $data['lesson_id']);
    $stmt->bindParam(':title', $data['title']);
    $stmt->bindParam(':max_score', $data['max_score']);
    
    if ($stmt->execute()) {
        return $conn->lastInsertId();
    }
    return false;
}

function createQuestion($data) {
    $conn = getConnection();
    $query = "INSERT INTO questions (quiz_id, question_text, question_type, options_json, correct_answer, points) 
              VALUES (:quiz_id, :question_text, :question_type, :options_json, :correct_answer, :points)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':quiz_id', $data['quiz_id']);
    $stmt->bindParam(':question_text', $data['question_text']);
    $stmt->bindParam(':question_type', $data['question_type']);
    $stmt->bindParam(':options_json', $data['options_json']);
    $stmt->bindParam(':correct_answer', $data['correct_answer']);
    $stmt->bindParam(':points', $data['points']);
    
    if ($stmt->execute()) {
        return $conn->lastInsertId();
    }
    return false;
}

function deleteQuiz($id) {
    $conn = getConnection();
    $query = "DELETE FROM quizzes WHERE quiz_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

function createQuizAttempt($data) {
    $conn = getConnection();
    $query = "INSERT INTO quiz_attempts (quiz_id, user_id, started_at) 
              VALUES (:quiz_id, :user_id, NOW())";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':quiz_id', $data['quiz_id']);
    $stmt->bindParam(':user_id', $data['user_id']);
    
    if ($stmt->execute()) {
        return $conn->lastInsertId();
    }
    return false;
}

function submitAnswer($data) {
    $conn = getConnection();
    $query = "INSERT INTO answers (attempt_id, question_id, answer_text, is_correct, points_awarded) 
              VALUES (:attempt_id, :question_id, :answer_text, :is_correct, :points_awarded)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':attempt_id', $data['attempt_id']);
    $stmt->bindParam(':question_id', $data['question_id']);
    $stmt->bindParam(':answer_text', $data['answer_text']);
    $stmt->bindParam(':is_correct', $data['is_correct']);
    $stmt->bindParam(':points_awarded', $data['points_awarded']);
    
    return $stmt->execute();
}

function finishQuizAttempt($attempt_id, $score) {
    $conn = getConnection();
    $query = "UPDATE quiz_attempts SET 
              score = :score,
              finished_at = NOW()
              WHERE attempt_id = :attempt_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':attempt_id', $attempt_id);
    $stmt->bindParam(':score', $score);
    
    return $stmt->execute();
}

function getQuizAttemptsByUser($user_id, $quiz_id = null) {
    $conn = getConnection();
    if ($quiz_id) {
        $query = "SELECT * FROM quiz_attempts WHERE user_id = :user_id AND quiz_id = :quiz_id ORDER BY started_at DESC";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':quiz_id', $quiz_id);
    } else {
        $query = "SELECT * FROM quiz_attempts WHERE user_id = :user_id ORDER BY started_at DESC";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
    }
    $stmt->execute();
    return $stmt->fetchAll();
}

function getAnswersByAttempt($attempt_id) {
    $conn = getConnection();
    $query = "SELECT a.*, q.question_text, q.question_type 
              FROM answers a
              JOIN questions q ON a.question_id = q.question_id
              WHERE a.attempt_id = :attempt_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':attempt_id', $attempt_id);
    $stmt->execute();
    return $stmt->fetchAll();
}
