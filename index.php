
<?php

session_start();

// Memanggil konfigurasi
require_once __DIR__ . '/config/Config.php';

// Memanggil controller
require_once __DIR__ . '/controllers/ProfileController.php';
require_once __DIR__ . '/controllers/MahasiswaController.php';
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/UlasanController.php';
require_once __DIR__ . '/controllers/KrsController.php';

// Mengambil action dari URL
$action = $_GET['action'] ?? 'home';

// Proteksi halaman: semua halaman selain login harus login dahulu
if ($action !== 'login') {
    (new AuthController())->checkLogin();
}

// Routing halaman
switch ($action) {

    // Dashboard
    case 'home':
        (new ProfileController())->index();
        break;

    // About
    case 'about':
        (new ProfileController())->about();
        break;

    // Login
    case 'login':
        (new AuthController())->login();
        break;

    // Logout
    case 'logout':
        (new AuthController())->logout();
        break;

    // =========================
    // CRUD MAHASISWA
    // =========================

    case 'mahasiswa':
        (new MahasiswaController())->index();
        break;

    case 'mahasiswa-create':
        (new MahasiswaController())->create();
        break;

    case 'mahasiswa-edit':
        (new MahasiswaController())->edit();
        break;

    case 'mahasiswa-update':
        (new MahasiswaController())->update();
        break;

    case 'mahasiswa-delete':
        (new MahasiswaController())->delete();
        break;

    // =========================
    // CRUD ULASAN
    // =========================

    case 'ulasan':
        (new UlasanController())->index();
        break;

    case 'ulasan-create':
        (new UlasanController())->create();
        break;

    case 'ulasan-edit':
        (new UlasanController())->edit();
        break;

    case 'ulasan-update':
        (new UlasanController())->update();
        break;

    case 'ulasan-delete':
        (new UlasanController())->delete();
        break;

    // =========================
    // CRUD KRS
    // =========================

    case 'krs':
        (new KrsController())->index();
        break;

    case 'krs-create':
        (new KrsController())->create();
        break;

    case 'krs-edit':
        (new KrsController())->edit();
        break;

    case 'krs-update':
        (new KrsController())->update();
        break;

    case 'krs-delete':
        (new KrsController())->delete();
        break;

    // =========================
    // HALAMAN TIDAK DITEMUKAN
    // =========================

    default:
        http_response_code(404);
        echo '<h1>404 - Halaman Tidak Ditemukan</h1>';
        echo '<p>Halaman yang kamu cari tidak tersedia.</p>';
        echo '<a href="index.php?action=home">Kembali ke Dashboard</a>';
        break;
}
