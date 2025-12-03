<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/auth_model.php';
require_once __DIR__ . '/../models/modul_model.php';
require_once __DIR__ . '/../models/upload_model.php';

// Fungsi untuk list modul (admin)
function modul_list() {
    require_admin();
    
    $modul_list = get_all_modul();
    
    include __DIR__ . '/../views/modul/list.php';
}

// Fungsi untuk view modul (user)
function modul_view() {
    require_login();
    
    $modul_list = get_modul_for_user();
    
    include __DIR__ . '/../views/modul/view.php';
}

// Fungsi untuk detail modul
function modul_detail() {
    require_login();
    
    $id = $_GET['id'] ?? 0;
    $modul = get_modul_by_id($id);
    
    if (!$modul) {
        header('Location: ' . APP_URL . '?page=modul&action=view');
        exit;
    }
    
    include __DIR__ . '/../views/modul/detail.php';
}

// Fungsi untuk form tambah modul
function modul_create_form() {
    require_admin();
    
    include __DIR__ . '/../views/modul/create.php';
}

// Fungsi untuk handle tambah modul
function modul_create() {
    require_admin();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $judul = trim($_POST['judul'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');
        $tipe_file = $_POST['tipe_file'] ?? 'video';
        $urutan = intval($_POST['urutan'] ?? 0);
        
        if (empty($judul)) {
            $error = "Judul modul harus diisi!";
            include __DIR__ . '/../views/modul/create.php';
            return;
        }
        
        $file_path = null;
        
        // Handle upload file
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $upload_result = upload_file($_FILES['file'], $tipe_file);
            
            if (!$upload_result['success']) {
                $error = implode(', ', $upload_result['errors']);
                include __DIR__ . '/../views/modul/create.php';
                return;
            }
            
            $file_path = $upload_result['filename'];
        } else {
            $error = "File harus diupload!";
            include __DIR__ . '/../views/modul/create.php';
            return;
        }
        
        $result = create_modul($judul, $deskripsi, $file_path, $tipe_file, $urutan);
        
        if ($result) {
            header('Location: ' . APP_URL . '?page=modul&action=list&success=1');
            exit;
        } else {
            // Hapus file jika gagal insert
            if ($file_path) {
                delete_upload_file($file_path);
            }
            $error = "Gagal menambah modul!";
            include __DIR__ . '/../views/modul/create.php';
            return;
        }
    }
    
    modul_create_form();
}

// Fungsi untuk form edit modul
function modul_edit_form() {
    require_admin();
    
    $id = $_GET['id'] ?? 0;
    $modul = get_modul_by_id($id);
    
    if (!$modul) {
        header('Location: ' . APP_URL . '?page=modul&action=list');
        exit;
    }
    
    include __DIR__ . '/../views/modul/edit.php';
}

// Fungsi untuk handle update modul
function modul_update() {
    require_admin();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? 0;
        $judul = trim($_POST['judul'] ?? '');
        $deskripsi = trim($_POST['deskripsi'] ?? '');
        $tipe_file = $_POST['tipe_file'] ?? 'video';
        $urutan = intval($_POST['urutan'] ?? 0);
        
        if (empty($judul)) {
            $error = "Judul modul harus diisi!";
            $modul = get_modul_by_id($id);
            include __DIR__ . '/../views/modul/edit.php';
            return;
        }
        
        $modul = get_modul_by_id($id);
        $file_path = $modul['file_path'];
        
        // Handle upload file baru jika ada
        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $upload_result = upload_file($_FILES['file'], $tipe_file);
            
            if (!$upload_result['success']) {
                $error = implode(', ', $upload_result['errors']);
                $modul = get_modul_by_id($id);
                include __DIR__ . '/../views/modul/edit.php';
                return;
            }
            
            // Hapus file lama
            if ($file_path) {
                delete_upload_file($file_path);
            }
            
            $file_path = $upload_result['filename'];
        }
        
        $result = update_modul($id, $judul, $deskripsi, $file_path, $tipe_file, $urutan);
        
        if ($result !== false) {
            header('Location: ' . APP_URL . '?page=modul&action=list&success=1');
            exit;
        } else {
            $error = "Gagal mengupdate modul!";
            $modul = get_modul_by_id($id);
            include __DIR__ . '/../views/modul/edit.php';
            return;
        }
    }
    
    modul_edit_form();
}

// Fungsi untuk handle delete modul
function modul_delete() {
    require_admin();
    
    $id = $_GET['id'] ?? 0;
    
    $result = delete_modul($id);
    
    if ($result) {
        header('Location: ' . APP_URL . '?page=modul&action=list&success=1');
        exit;
    } else {
        header('Location: ' . APP_URL . '?page=modul&action=list&error=1');
        exit;
    }
}
?>

