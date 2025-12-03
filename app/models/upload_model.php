<?php
require_once __DIR__ . '/../config/config.php';

// Fungsi untuk validasi file upload
function validate_upload($file, $allowed_types) {
    $errors = [];
    
    // Cek apakah file diupload
    if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "File tidak berhasil diupload";
        return $errors;
    }
    
    // Cek ukuran file
    if ($file['size'] > MAX_UPLOAD_SIZE) {
        $errors[] = "Ukuran file terlalu besar. Maksimal " . (MAX_UPLOAD_SIZE / 1024 / 1024) . " MB";
    }
    
    // Cek tipe file
    $file_type = $file['type'];
    if (!in_array($file_type, $allowed_types)) {
        $errors[] = "Tipe file tidak diizinkan. Hanya " . implode(', ', $allowed_types);
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

