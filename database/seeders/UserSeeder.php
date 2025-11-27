<?php
/**
 * Seeder untuk data User/Student
 * Jalankan dengan: php database/seeders/UserSeeder.php
 */

require_once __DIR__ . '/../../config/database.php';

function seedUsers() {
    $conn = getConnection();
    
    // Hash password untuk "password"
    $password_hash = password_hash('password', PASSWORD_DEFAULT);
    
    // Data users
    $users = [
        [
            'name' => 'Student One',
            'email' => 'student1@elearning.com',
            'password_hash' => $password_hash,
            'role' => 'student'
        ],
        [
            'name' => 'Student Two',
            'email' => 'student2@elearning.com',
            'password_hash' => $password_hash,
            'role' => 'student'
        ]
    ];
    
    foreach ($users as $user_data) {
        // Cek apakah user sudah ada
        $check_query = "SELECT user_id FROM users WHERE email = :email";
        $check_stmt = $conn->prepare($check_query);
        $check_stmt->bindParam(':email', $user_data['email']);
        $check_stmt->execute();
        $existing = $check_stmt->fetch();
        
        if ($existing) {
            // Update jika sudah ada
            $query = "UPDATE users SET 
                      name = :name,
                      password_hash = :password_hash,
                      role = :role
                      WHERE email = :email";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':name', $user_data['name']);
            $stmt->bindParam(':password_hash', $user_data['password_hash']);
            $stmt->bindParam(':role', $user_data['role']);
            $stmt->bindParam(':email', $user_data['email']);
            
            if ($stmt->execute()) {
                echo "✓ User " . $user_data['email'] . " berhasil diupdate!\n";
            }
        } else {
            // Insert jika belum ada
            $query = "INSERT INTO users (name, email, password_hash, role) 
                      VALUES (:name, :email, :password_hash, :role)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':name', $user_data['name']);
            $stmt->bindParam(':email', $user_data['email']);
            $stmt->bindParam(':password_hash', $user_data['password_hash']);
            $stmt->bindParam(':role', $user_data['role']);
            
            if ($stmt->execute()) {
                echo "✓ User " . $user_data['email'] . " berhasil dibuat!\n";
            }
        }
    }
    
    echo "\nKredensial Login:\n";
    foreach ($users as $user) {
        echo "- Email: " . $user['email'] . " | Password: password | Role: " . $user['role'] . "\n";
    }
}

// Jalankan seeder jika file dipanggil langsung
if (php_sapi_name() === 'cli') {
    echo "=== User Seeder ===\n\n";
    seedUsers();
    echo "\n✓ Selesai!\n";
}


