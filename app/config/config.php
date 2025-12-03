<?php
// Konstanta aplikasi
define('APP_NAME', 'Mini E-Learning');
define('APP_URL', 'http://localhost/MINI%20E-LEARNING/public/');
define('BASE_PATH', dirname(__DIR__));

// Path untuk upload
define('UPLOAD_PATH', BASE_PATH . '/app/assets/uploads/');
define('UPLOAD_URL', 'http://localhost/MINI%20E-LEARNING/app/assets/uploads/');

// Ukuran maksimal file upload (dalam bytes) - 50MB
define('MAX_UPLOAD_SIZE', 50 * 1024 * 1024);

// Format file yang diizinkan
define('ALLOWED_VIDEO_TYPES', ['video/mp4', 'video/avi', 'video/mov', 'video/wmv']);
define('ALLOWED_AUDIO_TYPES', ['audio/mp3', 'audio/wav', 'audio/ogg', 'audio/m4a']);

// Session timeout (dalam detik) - 2 jam
define('SESSION_TIMEOUT', 7200);

// Timezone
date_default_timezone_set('Asia/Jakarta');
?>

