<?php
require_once __DIR__ . '/../model/MediaFile.php';
require_once __DIR__ . '/../model/Modul.php';

function mediaIndex() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    $media = getAllMediaFiles();
    require_once __DIR__ . '/../view/media/index.php';
}

function mediaUpload() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $modul_id = !empty($_POST['modul_id']) ? $_POST['modul_id'] : null;
        
        // Validasi file
        $allowed_types = ['video/mp4', 'video/avi', 'video/quicktime', 'audio/mpeg', 'audio/mp3', 'audio/wav', 'application/pdf'];
        $file_type_map = [
            'video/mp4' => 'video',
            'video/avi' => 'video',
            'video/quicktime' => 'video',
            'audio/mpeg' => 'audio',
            'audio/mp3' => 'audio',
            'audio/wav' => 'audio',
            'application/pdf' => 'document'
        ];
        
        if (!in_array($file['type'], $allowed_types)) {
            $_SESSION['error'] = 'Tipe file tidak diizinkan! Hanya video, audio, dan PDF.';
            header('Location: index.php?action=media_upload');
            exit;
        }
        
        // Buat direktori upload jika belum ada
        $upload_dir = __DIR__ . '/../uploads/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        // Generate nama file unik
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid() . '_' . time() . '.' . $file_extension;
        $file_path = $upload_dir . $filename;
        
        if (move_uploaded_file($file['tmp_name'], $file_path)) {
            $data = [
                'modul_id' => $modul_id,
                'filename' => $filename,
                'original_filename' => $file['name'],
                'file_type' => $file_type_map[$file['type']],
                'file_path' => 'uploads/' . $filename,
                'file_size' => $file['size'],
                'uploaded_by' => $_SESSION['user_id']
            ];
            
            if (createMediaFile($data)) {
                $_SESSION['success'] = 'File berhasil diupload!';
                
                // Update modul jika ada modul_id
                if ($modul_id) {
                    $modul = getModulById($modul_id);
                    if ($modul) {
                        $update_data = [];
                        if ($data['file_type'] === 'video') {
                            $update_data['video_url'] = 'uploads/' . $filename;
                        } elseif ($data['file_type'] === 'audio') {
                            $update_data['audio_url'] = 'uploads/' . $filename;
                        } else {
                            $update_data['file_url'] = 'uploads/' . $filename;
                        }
                        updateModul($modul_id, array_merge($modul, $update_data));
                    }
                }
                
                header('Location: index.php?action=media_index');
                exit;
            } else {
                unlink($file_path);
                $_SESSION['error'] = 'Gagal menyimpan data file!';
            }
        } else {
            $_SESSION['error'] = 'Gagal mengupload file!';
        }
    }
    
    $modul = getAllModul();
    require_once __DIR__ . '/../view/media/upload.php';
}

function mediaDelete() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    $id = $_GET['id'] ?? 0;
    
    if (deleteMediaFile($id)) {
        $_SESSION['success'] = 'File berhasil dihapus!';
    } else {
        $_SESSION['error'] = 'Gagal menghapus file!';
    }
    
    header('Location: index.php?action=media_index');
    exit;
}
