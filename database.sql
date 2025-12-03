CREATE DATABASE IF NOT EXISTS mini_e_learning CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE mini_e_learning;

-- Tabel sekolah
CREATE TABLE IF NOT EXISTS sekolah (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_sekolah VARCHAR(255) NOT NULL,
    alamat TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') NOT NULL DEFAULT 'user',
    sekolah_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (sekolah_id) REFERENCES sekolah(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel modul
CREATE TABLE IF NOT EXISTS modul (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    deskripsi TEXT,
    file_path VARCHAR(500),
    tipe_file ENUM('video', 'audio') NOT NULL,
    urutan INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel quiz
CREATE TABLE IF NOT EXISTS quiz (
    id INT AUTO_INCREMENT PRIMARY KEY,
    modul_id INT NOT NULL,
    pertanyaan TEXT NOT NULL,
    pilihan_a VARCHAR(500) NOT NULL,
    pilihan_b VARCHAR(500) NOT NULL,
    pilihan_c VARCHAR(500) NOT NULL,
    pilihan_d VARCHAR(500) NOT NULL,
    jawaban_benar ENUM('a', 'b', 'c', 'd') NOT NULL,
    poin INT DEFAULT 10,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (modul_id) REFERENCES modul(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel progress
CREATE TABLE IF NOT EXISTS progress (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    quiz_id INT NOT NULL,
    nilai INT DEFAULT 0,
    status ENUM('selesai', 'belum') DEFAULT 'belum',
    tanggal_selesai TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (quiz_id) REFERENCES quiz(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_quiz (user_id, quiz_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Tabel ranking
CREATE TABLE IF NOT EXISTS ranking (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    sekolah_id INT NOT NULL,
    total_nilai INT DEFAULT 0,
    peringkat INT DEFAULT 0,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (sekolah_id) REFERENCES sekolah(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_ranking (user_id, sekolah_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert data default sekolah
INSERT INTO sekolah (nama_sekolah, alamat) VALUES 
('SMA Negeri 1', 'Jl. Pendidikan No. 123');

-- Insert admin default (password: admin123)
INSERT INTO users (username, password, nama, role, sekolah_id) VALUES 
('admin', '$2y$10$4E8WhOHE6x7pdH/J5dv4Bub4bYoK9VoCSc679VKLRiMCND9F1Xn.i', 'Administrator', 'admin', 1);

-- Insert user default (password: user123)
INSERT INTO users (username, password, nama, role, sekolah_id) VALUES 
('user1', '$2y$10$DXMhuly.d.zpzhuDT07YNeDpNAfEjhGJHVUBTp3eKRpIUaiVzJS4C', 'User Test', 'user', 1);

