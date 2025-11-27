<?php
/**
 * Database Seeder - Menjalankan semua seeder
 * Jalankan dengan: php database/seeders/DatabaseSeeder.php
 */

require_once __DIR__ . '/AdminSeeder.php';
require_once __DIR__ . '/UserSeeder.php';

function runAllSeeders() {
    echo "=== Database Seeder ===\n\n";
    
    echo "1. Seeding Admin...\n";
    seedAdmin();
    echo "\n";
    
    echo "2. Seeding Users...\n";
    seedUsers();
    echo "\n";
    
    echo "=== Semua Seeder Selesai ===\n";
}

// Jalankan seeder jika file dipanggil langsung
if (php_sapi_name() === 'cli') {
    runAllSeeders();
}


