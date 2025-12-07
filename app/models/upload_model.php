<?php
require_once __DIR__ . '/../config/config.php';

// Fungsi untuk validasi file upload
function validate_upload($file, $allowed_types) {
    $errors = [];
    
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "File tidak berhasil diupload (Error Code: " . $file['error'] . ")";
        return $errors;
    }
    
    // 2. Cek Ukuran
    if ($file['size'] > MAX_UPLOAD_SIZE) {
        $errors[] = "Ukuran file terlalu besar. Maksimal " . (MAX_UPLOAD_SIZE / 1024 / 1024) . " MB";
        return $errors;
    }
    
    $file_type = $file['type'];
    
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    

    $allowed_extensions = ['mp3', 'wav', 'ogg', 'm4a', 'wma'];
    $allowed_video_ext = ['mp4', 'webm', 'avi', 'mkv', 'mov'];
    $is_valid_mime = in_array($file_type, $allowed_types);
    $is_valid_ext = false;
    
    if (in_array('audio/mp3', $allowed_types)) {
        $is_valid_ext = in_array($extension, $allowed_extensions);
    } else {
        $is_valid_ext = in_array($extension, $allowed_video_ext);
    }

    if (!$is_valid_mime && !$is_valid_ext) {
        $errors[] = "Tipe file tidak diizinkan. Terdeteksi: $file_type, Ekstensi: $extension";
    }
    
    return $errors;
}

// Fungsi untuk upload file
function upload_file($file, $tipe_file) {
    $allowed_types = $tipe_file === 'video' ? ALLOWED_VIDEO_TYPES : ALLOWED_AUDIO_TYPES;
    
    // Validasi
    $errors = validate_upload($file, $allowed_types);
    if (!empty($errors)) {
        return ['success' => false, 'errors' => $errors];
    }
    
    // Generate nama file unik
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '_' . time() . '.' . $extension;
    $upload_path = UPLOAD_PATH . $filename;
    
    // Pastikan folder upload ada
    if (!is_dir(UPLOAD_PATH)) {
        mkdir(UPLOAD_PATH, 0777, true);
    }
    
    // Upload file
    if (move_uploaded_file($file['tmp_name'], $upload_path)) {
        return ['success' => true, 'filename' => $filename];
    } else {
        return ['success' => false, 'errors' => ['Gagal mengupload file']];
    }
}

// Fungsi untuk hapus file
function delete_upload_file($filename) {
    $file_path = UPLOAD_PATH . $filename;
    if (file_exists($file_path)) {
        return unlink($file_path);
    }
    return false;
}
?>

