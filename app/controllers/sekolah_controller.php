<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/auth_model.php';
require_once __DIR__ . '/../models/sekolah_model.php';

// Fungsi untuk list sekolah
function sekolah_list() {
    require_admin();
    
    $sekolah_list = get_all_sekolah();
    
    include __DIR__ . '/../views/sekolah/list.php';
}

// Fungsi untuk form tambah sekolah
function sekolah_create_form() {
    require_admin();
    
    include __DIR__ . '/../views/sekolah/create.php';
}

// Fungsi untuk handle tambah sekolah
function sekolah_create() {
    require_admin();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nama_sekolah = trim($_POST['nama_sekolah'] ?? '');
        $alamat = trim($_POST['alamat'] ?? '');
        
        if (empty($nama_sekolah)) {
            $error = "Nama sekolah harus diisi!";
            include __DIR__ . '/../views/sekolah/create.php';
            return;
        }
        
        $result = create_sekolah($nama_sekolah, $alamat);
        
        if ($result) {
            header('Location: ' . APP_URL . '?page=sekolah&action=list&success=1');
            exit;
        } else {
            $error = "Gagal menambah sekolah!";
            include __DIR__ . '/../views/sekolah/create.php';
            return;
        }
    }
    
    sekolah_create_form();
}

// Fungsi untuk form edit sekolah
function sekolah_edit_form() {
    require_admin();
    
    $id = $_GET['id'] ?? 0;
    $sekolah = get_sekolah_by_id($id);
    
    if (!$sekolah) {
        header('Location: ' . APP_URL . '?page=sekolah&action=list');
        exit;
    }
    
    include __DIR__ . '/../views/sekolah/edit.php';
}

// Fungsi untuk handle update sekolah
function sekolah_update() {
    require_admin();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'] ?? 0;
        $nama_sekolah = trim($_POST['nama_sekolah'] ?? '');
        $alamat = trim($_POST['alamat'] ?? '');
        
        if (empty($nama_sekolah)) {
            $error = "Nama sekolah harus diisi!";
            $sekolah = get_sekolah_by_id($id);
            include __DIR__ . '/../views/sekolah/edit.php';
            return;
        }
        
        $result = update_sekolah($id, $nama_sekolah, $alamat);
        
        if ($result !== false) {
            header('Location: ' . APP_URL . '?page=sekolah&action=list&success=1');
            exit;
        } else {
            $error = "Gagal mengupdate sekolah!";
            $sekolah = get_sekolah_by_id($id);
            include __DIR__ . '/../views/sekolah/edit.php';
            return;
        }
    }
    
    sekolah_edit_form();
}

// Fungsi untuk handle delete sekolah
function sekolah_delete() {
    require_admin();
    
    $id = $_GET['id'] ?? 0;
    
    $result = delete_sekolah($id);
    
    if ($result) {
        header('Location: ' . APP_URL . '?page=sekolah&action=list&success=1');
        exit;
    } else {
        header('Location: ' . APP_URL . '?page=sekolah&action=list&error=1');
        exit;
    }
}

// Fungsi untuk view ranking
function sekolah_ranking() {
    require_admin();
    
    $sekolah_id = $_GET['sekolah_id'] ?? null;
    
    if ($sekolah_id) {
        $ranking = get_ranking_by_sekolah($sekolah_id);
        $sekolah = get_sekolah_by_id($sekolah_id);
    } else {
        $ranking = [];
        $sekolah = null;
    }
    
    $sekolah_list = get_all_sekolah();
    
    include __DIR__ . '/../views/sekolah/ranking.php';
}
?>

