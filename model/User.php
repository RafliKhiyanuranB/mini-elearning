<?php
require_once __DIR__ . '/../config/database.php';

function userLogin($email, $password) {
    $conn = getConnection();
    $query = "SELECT user_id, name, email, password_hash, role FROM users WHERE email = :email";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password_hash'])) {
        unset($user['password_hash']);
        return $user;
    }
    return false;
}

function getAllUsers() {
    $conn = getConnection();
    $query = "SELECT * FROM users ORDER BY created_at DESC";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll();
}

function getUserById($id) {
    $conn = getConnection();
    $query = "SELECT * FROM users WHERE user_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch();
}

function createUser($data) {
    $conn = getConnection();
    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
    $query = "INSERT INTO users (name, email, password_hash, role) 
              VALUES (:name, :email, :password_hash, :role)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':password_hash', $hashedPassword);
    $stmt->bindParam(':role', $data['role']);
    
    if ($stmt->execute()) {
        return $conn->lastInsertId();
    }
    return false;
}

function updateUser($id, $data) {
    $conn = getConnection();
    $query = "UPDATE users SET 
              name = :name,
              email = :email,
              role = :role";
    
    if (!empty($data['password'])) {
        $query .= ", password_hash = :password_hash";
    }
    
    $query .= " WHERE user_id = :id";
    
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $data['name']);
    $stmt->bindParam(':email', $data['email']);
    $stmt->bindParam(':role', $data['role']);
    
    if (!empty($data['password'])) {
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        $stmt->bindParam(':password_hash', $hashedPassword);
    }
    
    return $stmt->execute();
}

function deleteUser($id) {
    $conn = getConnection();
    $query = "DELETE FROM users WHERE user_id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}

function getTotalUsers() {
    $conn = getConnection();
    $query = "SELECT COUNT(*) as total FROM users WHERE role = 'student'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['total'];
}

function getTotalStaff() {
    $conn = getConnection();
    $query = "SELECT COUNT(*) as total FROM users WHERE role = 'staff'";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch();
    return $result['total'];
}
