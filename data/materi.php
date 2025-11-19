<?php
$materiPaw = [
    [
        'id' => 'minggu-1',
        'pertemuan' => 'Minggu 1',
        'judul' => 'Kenalan dengan Perangkat Belajar',
        'deskripsi' => 'Siswa mengenali bagian komputer/tablet, aturan merawat, dan etika memakai perangkat.',
        'learning_outcomes' => [
            'Menyebutkan fungsi dasar perangkat (mouse, keyboard, layar).',
            'Menjelaskan aturan keamanan sederhana saat memakai perangkat di rumah/sekolah.',
        ],
        'aktivitas' => [
            'Permainan tebak fungsi alat menggunakan kartu gambar.',
            'Janji kelas “Teman Digital Baik” dan poster mini.',
        ],
        'praktikum' => [
            'Mengerjakan lembar kerja memasangkan gambar perangkat dengan nama.',
            'Latihan membuka aplikasi belajar dan menutup dengan benar.',
        ],
        'referensi' => [
            'Modul TIK SD Kelas 4 Kemendikbud',
            'Video Animasi “Cara Merawat Gadget”',
        ],
    ],
    [
        'id' => 'minggu-2',
        'pertemuan' => 'Minggu 2',
        'judul' => 'Jelajah Internet Aman',
        'deskripsi' => 'Mengenalkan mesin pencari ramah anak, etika daring, dan cara meminta bantuan orang dewasa.',
        'learning_outcomes' => [
            'Mencari informasi sederhana (cuaca, hewan) dengan kata kunci mudah.',
            'Menyebutkan tiga aturan keselamatan saat online.',
        ],
        'aktivitas' => [
            'Role play “Apa yang harus kulakukan jika…” terkait pesan asing.',
            'Quiz interaktif tentang ikon rambu internet aman.',
        ],
        'praktikum' => [
            'Menyiapkan daftar situs edukasi favorit kelas.',
            'Mencatat kata kunci ramah anak dan hasil pencarian di jurnal siswa.',
        ],
        'referensi' => [
            'Web Kiddle & KidzSearch',
            'Panduan Google Be Internet Awesome (ID)',
        ],
    ],
    [
        'id' => 'minggu-3',
        'pertemuan' => 'Minggu 3',
        'judul' => 'Membuat Poster Digital Ceria',
        'deskripsi' => 'Siswa belajar dasar layout, warna, dan teks pendek untuk mengkampanyekan kebiasaan baik.',
        'learning_outcomes' => [
            'Mengatur elemen teks dan gambar sederhana di kanvas digital.',
            'Memilih kombinasi warna cerah yang nyaman dibaca.',
        ],
        'aktivitas' => [
            'Observasi poster contoh dan diskusi “Apa yang membuatnya menarik?”.',
            'Latihan sketsa di kertas sebelum ke aplikasi.',
        ],
        'praktikum' => [
            'Menggunakan Canva for Education / Google Slides untuk poster “Hemat Air”.',
            'Mengunggah hasil ke galeri kelas mini e-learning.',
        ],
        'referensi' => [
            'Template Poster SD Canva',
            'Buku Tematik Kelas 4 Tema 2 (Hidup Bersih)',
        ],
    ],
    [
        'id' => 'minggu-4',
        'pertemuan' => 'Minggu 4',
        'judul' => 'Cerita Interaktif dengan Scratch Jr',
        'deskripsi' => 'Pengantar logika sederhana melalui cerita bergerak menggunakan blok visual.',
        'learning_outcomes' => [
            'Mengurutkan blok perintah mulai-bergerak-bicara dengan benar.',
            'Mendeskripsikan alur cerita awal-tengah-akhir secara runtut.',
        ],
        'aktivitas' => [
            'Membaca dongeng pendek lalu menentukan tokoh & latar.',
            'Kelompok kecil merancang storyboard tiga panel.',
        ],
        'praktikum' => [
            'Membangun proyek Scratch Jr dengan tokoh favorit siswa.',
            'Mempresentasikan cerita ke teman dan menerima umpan balik.',
        ],
        'referensi' => [
            'Scratch Jr Teach Resources',
            'Modul Literasi Digital SD: Kreasi Cerita',
        ],
    ],
];

function cariMateri(string $id): ?array
{
    global $materiPaw;
    foreach ($materiPaw as $materi) {
        if ($materi['id'] === $id) {
            return $materi;
        }
    }
    return null;
}

