<?php
/**
 * Seeder untuk data Admin
 * Jalankan dengan: php database/seeders/AdminSeeder.php
 */

require_once __DIR__ . '/../../config/database.php';

function seedAdmin() {
    $conn = getConnection();
    
    // Hash password untuk "password"
    $password_hash = password_hash('password', PASSWORD_DEFAULT);
    
    // Data admin
    $admin_data = [
        'name' => 'Administrator',
        'email' => 'admin@elearning.com',
        'password_hash' => $password_hash,
        'role' => 'staff'
    ];
    
    // Cek apakah admin sudah ada
    $check_query = "SELECT user_id FROM users WHERE email = :email";
    $check_stmt = $conn->prepare($check_query);
    $check_stmt->bindParam(':email', $admin_data['email']);
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
        $stmt->bindParam(':name', $admin_data['name']);
        $stmt->bindParam(':password_hash', $admin_data['password_hash']);
        $stmt->bindParam(':role', $admin_data['role']);
        $stmt->bindParam(':email', $admin_data['email']);
        
        if ($stmt->execute()) {
            echo "✓ Admin berhasil diupdate!\n";
        } else {
            echo "✗ Gagal update admin\n";
        }
    } else {
        // Insert jika belum ada
        $query = "INSERT INTO users (name, email, password_hash, role) 
                  VALUES (:name, :email, :password_hash, :role)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':name', $admin_data['name']);
        $stmt->bindParam(':email', $admin_data['email']);
        $stmt->bindParam(':password_hash', $admin_data['password_hash']);
        $stmt->bindParam(':role', $admin_data['role']);
        
        if ($stmt->execute()) {
            echo "✓ Admin berhasil dibuat!\n";
        } else {
            echo "✗ Gagal membuat admin\n";
        }
    }
    
    echo "\nKredensial Login:\n";
    echo "Email: " . $admin_data['email'] . "\n";
    echo "Password: password\n";
    echo "Role: " . $admin_data['role'] . "\n";
}

// Jalankan seeder jika file dipanggil langsung
if (php_sapi_name() === 'cli') {
    echo "=== Admin Seeder ===\n\n";
    seedAdmin();
    echo "\n✓ Selesai!\n";
}


