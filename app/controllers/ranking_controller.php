<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/auth_model.php';
require_once __DIR__ . '/../models/sekolah_model.php';

// Fungsi untuk view ranking (user)
function ranking_view() {
    require_login();
    
    $sekolah_id = $_SESSION['sekolah_id'] ?? null;
    
    if ($sekolah_id) {
        $ranking = get_ranking_by_sekolah($sekolah_id);
        $sekolah = get_sekolah_by_id($sekolah_id);
    } else {
        $ranking = [];
        $sekolah = null;
    }
    
    $page_title = "Ranking";
    include __DIR__ . '/../views/ranking/view.php';
}
?>

