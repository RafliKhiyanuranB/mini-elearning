<?php
require_once __DIR__ . '/../model/User.php';
require_once __DIR__ . '/../model/Sekolah.php';

function userIndex() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    $users = getAllUsers();
    require_once __DIR__ . '/../view/user/index.php';
}

function userCreate() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'username' => $_POST['username'] ?? '',
            'password' => $_POST['password'] ?? '',
            'email' => $_POST['email'] ?? '',
            'full_name' => $_POST['full_name'] ?? '',
            'role' => $_POST['role'] ?? 'user',
            'sekolah_id' => !empty($_POST['sekolah_id']) ? $_POST['sekolah_id'] : null
        ];
        
        if (createUser($data)) {
            $_SESSION['success'] = 'User berhasil ditambahkan!';
            header('Location: index.php?action=user_index');
            exit;
        } else {
            $_SESSION['error'] = 'Gagal menambahkan user!';
        }
    }
    
    $sekolah = getAllSekolah();
    require_once __DIR__ . '/../view/user/create.php';
}

function userEdit() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    $id = $_GET['id'] ?? 0;
    $user = getUserById($id);
    
    if (!$user) {
        $_SESSION['error'] = 'User tidak ditemukan!';
        header('Location: index.php?action=user_index');
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'username' => $_POST['username'] ?? '',
            'email' => $_POST['email'] ?? '',
            'full_name' => $_POST['full_name'] ?? '',
            'role' => $_POST['role'] ?? 'user',
            'sekolah_id' => !empty($_POST['sekolah_id']) ? $_POST['sekolah_id'] : null,
            'password' => $_POST['password'] ?? ''
        ];
        
        if (updateUser($id, $data)) {
            $_SESSION['success'] = 'User berhasil diupdate!';
            header('Location: index.php?action=user_index');
            exit;
        } else {
            $_SESSION['error'] = 'Gagal mengupdate user!';
        }
    }
    
    $sekolah = getAllSekolah();
    require_once __DIR__ . '/../view/user/edit.php';
}

function userDelete() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    $id = $_GET['id'] ?? 0;
    
    if (deleteUser($id)) {
        $_SESSION['success'] = 'User berhasil dihapus!';
    } else {
        $_SESSION['error'] = 'Gagal menghapus user!';
    }
    
    header('Location: index.php?action=user_index');
    exit;
}
