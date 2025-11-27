<?php
require_once __DIR__ . '/../model/Progress.php';

function progressIndex() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
        header('Location: index.php?action=login');
        exit;
    }
    
    $progress = getProgressByUser($_SESSION['user_id']);
    $statistik = getStatistikUser($_SESSION['user_id']);
    
    require_once __DIR__ . '/../view/progress/index.php';
}
