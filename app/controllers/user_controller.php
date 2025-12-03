<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/auth_model.php';
require_once __DIR__ . '/../models/user_model.php';
require_once __DIR__ . '/../models/sekolah_model.php';

// Fungsi untuk list user
function user_list() {
    require_admin();
    
    $role_filter = $_GET['role'] ?? null;
    $users = get_all_users($role_filter);
    
    include __DIR__ . '/../views/user/list.php';
}

// Fungsi untuk form tambah user
function user_create_form() {
    require_admin();
    
    $sekolah_list = get_all_sekolah();
    include __DIR__ . '/../views/user/create.php';
}

// Fungsi untuk handle tambah user
function user_create() {
    require_admin();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $nama = trim($_POST['nama'] ?? '');
        $role = $_POST['role'] ?? 'user';
        $sekolah_id = $_POST['sekolah_id'] ?? null;
        
        // Validasi
        if (empty($username) || empty($password) || empty($nama)) {
            $error = "Semua field harus diisi!";
            $sekolah_list = get_all_sekolah();
            include __DIR__ . '/../views/user/create.php';
            return;
        }
        
        if (username_exists($username)) {
            $error = "Username sudah digunakan!";
            $sekolah_list = get_all_sekolah();
            include __DIR__ . '/../views/user/create.php';
            return;
        }
        
        $result = create_user($username, $password, $nama, $role, $sekolah_id);
        
        if ($result) {
            header('Location: ' . APP_URL . '?page=user&action=list&success=1');
            exit;
        } else {
            $error = "Gagal menambah user!";
            $sekolah_list = get_all_sekolah();
            include __DIR__ . '/../views/user/create.php';
            return;
        }
    }
    
    user_create_form();
}

// Fungsi untuk form edit user
function user_edit_form() {
    require_admin();
    
    $id = $_GET['id'] ?? 0;
    $user = get_user_by_id($id);
    
    if (!$user) {
        header('Location: ' . APP_URL . '?page=user&action=list');
        exit;
    }
    
    $sekolah_list = get_all_sekolah();
    include __DIR__ . '/../views/user/edit.php';
}

// Fungsi untuk handle update user
function user_update() {
    require_admin();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? 0;
        $username = trim($_POST['username'] ?? '');
        $password = $_POST['password'] ?? '';
        $nama = trim($_POST['nama'] ?? '');
        $role = $_POST['role'] ?? 'user';
        $sekolah_id = $_POST['sekolah_id'] ?? null;
        
        // Validasi
        if (empty($username) || empty($nama)) {
            $error = "Username dan nama harus diisi!";
            $user = get_user_by_id($id);
            $sekolah_list = get_all_sekolah();
            include __DIR__ . '/../views/user/edit.php';
            return;
        }
        
        if (username_exists($username, $id)) {
            $error = "Username sudah digunakan!";
            $user = get_user_by_id($id);
            $sekolah_list = get_all_sekolah();
            include __DIR__ . '/../views/user/edit.php';
            return;
        }
        
        $result = update_user($id, $username, $password, $nama, $role, $sekolah_id);
        
        if ($result !== false) {
            header('Location: ' . APP_URL . '?page=user&action=list&success=1');
            exit;
        } else {
            $error = "Gagal mengupdate user!";
            $user = get_user_by_id($id);
            $sekolah_list = get_all_sekolah();
            include __DIR__ . '/../views/user/edit.php';
            return;
        }
    }
    
    user_edit_form();
}

// Fungsi untuk handle delete user
function user_delete() {
    require_admin();
    
    $id = $_GET['id'] ?? 0;
    
    if ($id == $_SESSION['user_id']) {
        header('Location: ' . APP_URL . '?page=user&action=list&error=1');
        exit;
    }
    
    $result = delete_user($id);
    
    if ($result) {
        header('Location: ' . APP_URL . '?page=user&action=list&success=1');
        exit;
    } else {
        header('Location: ' . APP_URL . '?page=user&action=list&error=1');
        exit;
    }
}
?>

