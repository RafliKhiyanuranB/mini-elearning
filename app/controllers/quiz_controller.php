<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../models/auth_model.php';
require_once __DIR__ . '/../models/quiz_model.php';
require_once __DIR__ . '/../models/progress_model.php';
require_once __DIR__ . '/../models/modul_model.php';

// Fungsi untuk list quiz (admin)
function quiz_list() {
    require_admin();
    
    $modul_id = $_GET['modul_id'] ?? null;
    $quiz_list = get_all_quiz($modul_id);
    $modul_list = get_all_modul_for_quiz();
    
    include __DIR__ . '/../views/quiz/list.php';
}

// Fungsi untuk view quiz (user)
function quiz_view() {
    require_login();
    
    $modul_id = $_GET['modul_id'] ?? null;
    $modul_id = $modul_id ? intval($modul_id) : null;
    
    if ($modul_id) {
        $quiz_list = get_quiz_by_modul_for_user($modul_id);
        $modul = get_modul_by_id($modul_id);
    } else {
        $quiz_list = [];
        $modul = null;
    }
    
    $modul_list = get_all_modul_for_quiz();
    
    include __DIR__ . '/../views/quiz/view.php';
}

// Fungsi untuk form tambah quiz
function quiz_create_form() {
    require_admin();
    
    $modul_list = get_all_modul_for_quiz();
    
    include __DIR__ . '/../views/quiz/create.php';
}

// Fungsi untuk handle tambah quiz
function quiz_create() {
    require_admin();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $modul_id = intval($_POST['modul_id'] ?? 0);
        $pertanyaan = trim($_POST['pertanyaan'] ?? '');
        $pilihan_a = trim($_POST['pilihan_a'] ?? '');
        $pilihan_b = trim($_POST['pilihan_b'] ?? '');
        $pilihan_c = trim($_POST['pilihan_c'] ?? '');
        $pilihan_d = trim($_POST['pilihan_d'] ?? '');
        $jawaban_benar = $_POST['jawaban_benar'] ?? 'a';
        $poin = intval($_POST['poin'] ?? 10);
        
        if (empty($pertanyaan) || empty($pilihan_a) || empty($pilihan_b) || empty($pilihan_c) || empty($pilihan_d)) {
            $error = "Semua field harus diisi!";
            $modul_list = get_all_modul_for_quiz();
            include __DIR__ . '/../views/quiz/create.php';
            return;
        }
        
        if ($modul_id <= 0) {
            $error = "Modul harus dipilih!";
            $modul_list = get_all_modul_for_quiz();
            include __DIR__ . '/../views/quiz/create.php';
            return;
        }
        
        $result = create_quiz($modul_id, $pertanyaan, $pilihan_a, $pilihan_b, $pilihan_c, $pilihan_d, $jawaban_benar, $poin);
        
        if ($result) {
            header('Location: ' . APP_URL . '?page=quiz&action=list&success=1');
            exit;
        } else {
            $error = "Gagal menambah quiz!";
            $modul_list = get_all_modul_for_quiz();
            include __DIR__ . '/../views/quiz/create.php';
            return;
        }
    }
    
    quiz_create_form();
}

// Fungsi untuk form edit quiz
function quiz_edit_form() {
    require_admin();
    
    $id = $_GET['id'] ?? 0;
    $quiz = get_quiz_by_id($id);
    
    if (!$quiz) {
        header('Location: ' . APP_URL . '?page=quiz&action=list');
        exit;
    }
    
    $modul_list = get_all_modul_for_quiz();
    
    include __DIR__ . '/../views/quiz/edit.php';
}

// Fungsi untuk handle update quiz
function quiz_update() {
    require_admin();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = intval($_POST['id'] ?? 0);
        $modul_id = intval($_POST['modul_id'] ?? 0);
        $pertanyaan = trim($_POST['pertanyaan'] ?? '');
        $pilihan_a = trim($_POST['pilihan_a'] ?? '');
        $pilihan_b = trim($_POST['pilihan_b'] ?? '');
        $pilihan_c = trim($_POST['pilihan_c'] ?? '');
        $pilihan_d = trim($_POST['pilihan_d'] ?? '');
        $jawaban_benar = $_POST['jawaban_benar'] ?? 'a';
        $poin = intval($_POST['poin'] ?? 10);
        
        if (empty($pertanyaan) || empty($pilihan_a) || empty($pilihan_b) || empty($pilihan_c) || empty($pilihan_d)) {
            $error = "Semua field harus diisi!";
            $quiz = get_quiz_by_id($id);
            $modul_list = get_all_modul_for_quiz();
            include __DIR__ . '/../views/quiz/edit.php';
            return;
        }
        
        if ($modul_id <= 0) {
            $error = "Modul harus dipilih!";
            $quiz = get_quiz_by_id($id);
            $modul_list = get_all_modul_for_quiz();
            include __DIR__ . '/../views/quiz/edit.php';
            return;
        }
        
        $result = update_quiz($id, $modul_id, $pertanyaan, $pilihan_a, $pilihan_b, $pilihan_c, $pilihan_d, $jawaban_benar, $poin);
        
        if ($result !== false) {
            header('Location: ' . APP_URL . '?page=quiz&action=list&success=1');
            exit;
        } else {
            $error = "Gagal mengupdate quiz!";
            $quiz = get_quiz_by_id($id);
            $modul_list = get_all_modul_for_quiz();
            include __DIR__ . '/../views/quiz/edit.php';
            return;
        }
    }
    
    quiz_edit_form();
}

// Fungsi untuk handle delete quiz
function quiz_delete() {
    require_admin();
    
    $id = $_GET['id'] ?? 0;
    
    $result = delete_quiz($id);
    
    if ($result) {
        header('Location: ' . APP_URL . '?page=quiz&action=list&success=1');
        exit;
    } else {
        header('Location: ' . APP_URL . '?page=quiz&action=list&error=1');
        exit;
    }
}

// Fungsi untuk form kerjakan quiz
function quiz_do_form() {
    require_login();
    
    $modul_id = $_GET['modul_id'] ?? 0;
    
    if ($modul_id <= 0) {
        header('Location: ' . APP_URL . '?page=quiz&action=view');
        exit;
    }
    
    $quiz_list = get_quiz_by_modul_for_user($modul_id);
    $modul = get_modul_by_id($modul_id);
    
    if (empty($quiz_list)) {
        header('Location: ' . APP_URL . '?page=quiz&action=view&error=1');
        exit;
    }
    
    // Ambil progress user untuk quiz ini
    $progress_list = [];
    foreach ($quiz_list as $quiz) {
        $progress = get_user_progress($_SESSION['user_id'], $quiz['id']);
        $progress_list[$quiz['id']] = $progress;
    }
    
    // Pastikan modul_id tersedia untuk view
    $modul_id = intval($modul_id);
    
    include __DIR__ . '/../views/quiz/do.php';
}

// Fungsi untuk handle submit quiz
function quiz_submit() {
    require_login();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $modul_id = intval($_POST['modul_id'] ?? 0);
        $jawaban = $_POST['jawaban'] ?? [];
        
        $quiz_list = get_quiz_by_modul_for_user($modul_id);
        $total_nilai = 0;
        $total_soal = count($quiz_list);
        $benar = 0;
        
        foreach ($quiz_list as $quiz) {
            $quiz_id = $quiz['id'];
            $jawaban_user = $jawaban[$quiz_id] ?? null;
            
            if ($jawaban_user) {
                $nilai = calculate_quiz_score($quiz_id, $jawaban_user);
                $total_nilai += $nilai;
                
                if ($nilai > 0) {
                    $benar++;
                }
                
                // Simpan progress
                $status = 'selesai';
                save_quiz_progress($_SESSION['user_id'], $quiz_id, $jawaban_user, $nilai, $status);
            }
        }
        
        // Redirect ke hasil
        header('Location: ' . APP_URL . '?page=quiz&action=result&modul_id=' . $modul_id . '&nilai=' . $total_nilai . '&benar=' . $benar . '&total=' . $total_soal);
        exit;
    }
    
    header('Location: ' . APP_URL . '?page=quiz&action=view');
    exit;
}

// Fungsi untuk hasil quiz
function quiz_result() {
    require_login();
    
    $modul_id = $_GET['modul_id'] ?? 0;
    $nilai = intval($_GET['nilai'] ?? 0);
    $benar = intval($_GET['benar'] ?? 0);
    $total = intval($_GET['total'] ?? 0);
    
    $modul = get_modul_by_id($modul_id);
    
    include __DIR__ . '/../views/quiz/result.php';
}
?>

