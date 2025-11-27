<?php
require_once __DIR__ . '/../model/Modul.php';
require_once __DIR__ . '/../model/Progress.php';

function modulIndex() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?action=login');
        exit;
    }
    
    $modul = getAllModul();
    
    // Jika user, tambahkan progress
    if ($_SESSION['role'] === 'user') {
        foreach ($modul as &$m) {
            $progress = getProgressByUserAndModul($_SESSION['user_id'], $m['id']);
            $m['progress'] = $progress ? $progress : null;
        }
    }
    
    require_once __DIR__ . '/../view/modul/index.php';
}

function modulView() {
    if (!isset($_SESSION['user_id'])) {
        header('Location: index.php?action=login');
        exit;
    }
    
    $id = $_GET['id'] ?? 0;
    $modul = getModulById($id);
    
    if (!$modul) {
        $_SESSION['error'] = 'Modul tidak ditemukan!';
        header('Location: index.php?action=modul_index');
        exit;
    }
    
    // Update progress untuk user
    if ($_SESSION['role'] === 'user') {
        $progress = getProgressByUserAndModul($_SESSION['user_id'], $id);
        $data = [
            'status' => 'sedang_belajar',
            'progress_percent' => $progress ? min($progress['progress_percent'] + 10, 100) : 10,
            'waktu_belajar' => 5,
            'completed_at' => null
        ];
        createOrUpdateProgress($_SESSION['user_id'], $id, $data);
    }
    
    require_once __DIR__ . '/../view/modul/view.php';
}

function modulCreate() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'judul' => $_POST['judul'] ?? '',
            'deskripsi' => $_POST['deskripsi'] ?? '',
            'konten' => $_POST['konten'] ?? '',
            'video_url' => $_POST['video_url'] ?? '',
            'audio_url' => $_POST['audio_url'] ?? '',
            'file_url' => $_POST['file_url'] ?? '',
            'urutan' => $_POST['urutan'] ?? 0,
            'created_by' => $_SESSION['user_id']
        ];
        
        if (createModul($data)) {
            $_SESSION['success'] = 'Modul berhasil ditambahkan!';
            header('Location: index.php?action=modul_index');
            exit;
        } else {
            $_SESSION['error'] = 'Gagal menambahkan modul!';
        }
    }
    
    require_once __DIR__ . '/../view/modul/create.php';
}

function modulEdit() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    $id = $_GET['id'] ?? 0;
    $modul = getModulById($id);
    
    if (!$modul) {
        $_SESSION['error'] = 'Modul tidak ditemukan!';
        header('Location: index.php?action=modul_index');
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'judul' => $_POST['judul'] ?? '',
            'deskripsi' => $_POST['deskripsi'] ?? '',
            'konten' => $_POST['konten'] ?? '',
            'video_url' => $_POST['video_url'] ?? '',
            'audio_url' => $_POST['audio_url'] ?? '',
            'file_url' => $_POST['file_url'] ?? '',
            'urutan' => $_POST['urutan'] ?? 0
        ];
        
        if (updateModul($id, $data)) {
            $_SESSION['success'] = 'Modul berhasil diupdate!';
            header('Location: index.php?action=modul_index');
            exit;
        } else {
            $_SESSION['error'] = 'Gagal mengupdate modul!';
        }
    }
    
    require_once __DIR__ . '/../view/modul/edit.php';
}

function modulDelete() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    $id = $_GET['id'] ?? 0;
    
    if (deleteModul($id)) {
        $_SESSION['success'] = 'Modul berhasil dihapus!';
    } else {
        $_SESSION['error'] = 'Gagal menghapus modul!';
    }
    
    header('Location: index.php?action=modul_index');
    exit;
}

function modulComplete() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
        header('Location: index.php?action=login');
        exit;
    }
    
    $id = $_GET['id'] ?? 0;
    
    $data = [
        'status' => 'selesai',
        'progress_percent' => 100,
        'waktu_belajar' => 0,
        'completed_at' => date('Y-m-d H:i:s')
    ];
    
    if (createOrUpdateProgress($_SESSION['user_id'], $id, $data)) {
        $_SESSION['success'] = 'Modul selesai dipelajari!';
    }
    
    header('Location: index.php?action=modul_view&id=' . $id);
    exit;
}
