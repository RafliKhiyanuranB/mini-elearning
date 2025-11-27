<?php
require_once __DIR__ . '/../model/Sekolah.php';

function sekolahIndex() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    $sekolah = getAllSekolah();
    require_once __DIR__ . '/../view/sekolah/index.php';
}

function sekolahCreate() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'nama_sekolah' => $_POST['nama_sekolah'] ?? '',
            'alamat' => $_POST['alamat'] ?? '',
            'no_telp' => $_POST['no_telp'] ?? '',
            'email' => $_POST['email'] ?? ''
        ];
        
        if (createSekolah($data)) {
            $_SESSION['success'] = 'Sekolah berhasil ditambahkan!';
            header('Location: index.php?action=sekolah_index');
            exit;
        } else {
            $_SESSION['error'] = 'Gagal menambahkan sekolah!';
        }
    }
    
    require_once __DIR__ . '/../view/sekolah/create.php';
}

function sekolahEdit() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    $id = $_GET['id'] ?? 0;
    $sekolah = getSekolahById($id);
    
    if (!$sekolah) {
        $_SESSION['error'] = 'Sekolah tidak ditemukan!';
        header('Location: index.php?action=sekolah_index');
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'nama_sekolah' => $_POST['nama_sekolah'] ?? '',
            'alamat' => $_POST['alamat'] ?? '',
            'no_telp' => $_POST['no_telp'] ?? '',
            'email' => $_POST['email'] ?? ''
        ];
        
        if (updateSekolah($id, $data)) {
            $_SESSION['success'] = 'Sekolah berhasil diupdate!';
            header('Location: index.php?action=sekolah_index');
            exit;
        } else {
            $_SESSION['error'] = 'Gagal mengupdate sekolah!';
        }
    }
    
    require_once __DIR__ . '/../view/sekolah/edit.php';
}

function sekolahDelete() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    $id = $_GET['id'] ?? 0;
    
    if (deleteSekolah($id)) {
        $_SESSION['success'] = 'Sekolah berhasil dihapus!';
    } else {
        $_SESSION['error'] = 'Gagal menghapus sekolah!';
    }
    
    header('Location: index.php?action=sekolah_index');
    exit;
}
