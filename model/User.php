<?php
class User {
    // Data dummy untuk login (tanpa database)
    private $users = [
        'admin' => ['password' => 'admin123', 'role' => 'admin', 'id' => 1],
        'user1' => ['password' => 'user123', 'role' => 'user', 'id' => 2],
        'user2' => ['password' => 'user123', 'role' => 'user', 'id' => 3]
    ];
    
    // Data dummy untuk dashboard
    private $dummyUsers = [
        ['id' => 1, 'username' => 'admin', 'role' => 'admin', 'created_at' => '2024-01-15 10:00:00'],
        ['id' => 2, 'username' => 'user1', 'role' => 'user', 'created_at' => '2024-01-16 11:30:00'],
        ['id' => 3, 'username' => 'user2', 'role' => 'user', 'created_at' => '2024-01-17 14:20:00'],
        ['id' => 4, 'username' => 'user3', 'role' => 'user', 'created_at' => '2024-01-18 09:15:00'],
        ['id' => 5, 'username' => 'user4', 'role' => 'user', 'created_at' => '2024-01-19 16:45:00']
    ];
    
    public function login($username, $password) {
        if (isset($this->users[$username]) && $this->users[$username]['password'] === $password) {
            return $this->users[$username];
        }
        return false;
    }
    
    public function getTotalUsers() {
        return count(array_filter($this->dummyUsers, function($u) { 
            return $u['role'] === 'user'; 
        }));
    }
    
    public function getTotalAdmins() {
        return count(array_filter($this->dummyUsers, function($u) { 
            return $u['role'] === 'admin'; 
        }));
    }
    
    public function getAllUsers() {
        return $this->dummyUsers;
    }
}

