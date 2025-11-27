<?php
require_once __DIR__ . '/../model/Quiz.php';
require_once __DIR__ . '/../model/Modul.php';

function quizIndex() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    $modul_id = $_GET['modul_id'] ?? 0;
    $quizzes = [];
    $modul = null;
    
    if ($modul_id) {
        $modul = getModulById($modul_id);
        $quizzes = getQuizByModul($modul_id);
    }
    
    require_once __DIR__ . '/../view/quiz/index.php';
}

function quizTake() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
        header('Location: index.php?action=login');
        exit;
    }
    
    $modul_id = $_GET['modul_id'] ?? 0;
    $modul = getModulById($modul_id);
    
    if (!$modul) {
        $_SESSION['error'] = 'Modul tidak ditemukan!';
        header('Location: index.php?action=modul_index');
        exit;
    }
    
    $quizzes = getQuizByModul($modul_id);
    $jawaban = getJawabanUserByModul($_SESSION['user_id'], $modul_id);
    
    require_once __DIR__ . '/../view/quiz/take.php';
}

function quizSubmit() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
        header('Location: index.php?action=login');
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $modul_id = $_POST['modul_id'] ?? 0;
        $quiz_ids = $_POST['quiz_id'] ?? [];
        
        $success = true;
        foreach ($quiz_ids as $quiz_id) {
            $pilihan_id = null;
            $jawaban = '';
            
            // Cek apakah pilihan ganda atau essay
            if (isset($_POST['pilihan_id_' . $quiz_id]) && !empty($_POST['pilihan_id_' . $quiz_id])) {
                $pilihan_id = $_POST['pilihan_id_' . $quiz_id];
            } elseif (isset($_POST['quiz_' . $quiz_id])) {
                $pilihan_id = $_POST['quiz_' . $quiz_id];
            }
            
            if (isset($_POST['jawaban_' . $quiz_id])) {
                $jawaban = $_POST['jawaban_' . $quiz_id];
            }
            
            if (!submitJawabanQuiz($_SESSION['user_id'], $quiz_id, $jawaban, $pilihan_id)) {
                $success = false;
            }
        }
        
        if ($success) {
            $_SESSION['success'] = 'Jawaban berhasil disimpan!';
        } else {
            $_SESSION['error'] = 'Beberapa jawaban gagal disimpan!';
        }
        
        header('Location: index.php?action=quiz_take&modul_id=' . $modul_id);
        exit;
    }
}

function quizCreate() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    $modul_id = $_GET['modul_id'] ?? 0;
    $modul = getModulById($modul_id);
    
    if (!$modul) {
        $_SESSION['error'] = 'Modul tidak ditemukan!';
        header('Location: index.php?action=modul_index');
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'modul_id' => $modul_id,
            'pertanyaan' => $_POST['pertanyaan'] ?? '',
            'tipe' => $_POST['tipe'] ?? 'pilihan_ganda',
            'pilihan' => []
        ];
        
        // Jika pilihan ganda, ambil pilihan
        if ($data['tipe'] === 'pilihan_ganda' && isset($_POST['pilihan'])) {
            foreach ($_POST['pilihan'] as $index => $pilihan_text) {
                $data['pilihan'][] = [
                    'text' => $pilihan_text,
                    'is_correct' => isset($_POST['correct_answer']) && $_POST['correct_answer'] == $index ? 1 : 0
                ];
            }
        }
        
        if (createQuiz($data)) {
            $_SESSION['success'] = 'Quiz berhasil ditambahkan!';
            header('Location: index.php?action=quiz_index&modul_id=' . $modul_id);
            exit;
        } else {
            $_SESSION['error'] = 'Gagal menambahkan quiz!';
        }
    }
    
    require_once __DIR__ . '/../view/quiz/create.php';
}

function quizDelete() {
    if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
        header('Location: index.php?action=login');
        exit;
    }
    
    $id = $_GET['id'] ?? 0;
    $modul_id = $_GET['modul_id'] ?? 0;
    
    if (deleteQuiz($id)) {
        $_SESSION['success'] = 'Quiz berhasil dihapus!';
    } else {
        $_SESSION['error'] = 'Gagal menghapus quiz!';
    }
    
    header('Location: index.php?action=quiz_index&modul_id=' . $modul_id);
    exit;
}
