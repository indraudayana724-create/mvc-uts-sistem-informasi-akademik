
<?php

require_once __DIR__ . '/../models/UlasanModel.php';

class UlasanController
{
    private UlasanModel $model;

    public function __construct()
    {
        $this->model = new UlasanModel();
    }

    // Menampilkan semua ulasan
    public function index(): void
    {
        $pageTitle = 'Ulasan Mahasiswa';
        $active = 'ulasan';

        $ulasan = $this->model->all();

        require __DIR__ . '/../views/ulasan/index.php';
    }

    // Menambahkan ulasan
    public function create(): void
    {
        $pageTitle = 'Tambah Ulasan';
        $active = 'ulasan';
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mahasiswaId = (int)($_POST['mahasiswa_id'] ?? 0);
            $rating = (int)($_POST['rating'] ?? 0);
            $komentar = trim($_POST['komentar'] ?? '');

            if ($mahasiswaId <= 0 || $rating < 1 || $rating > 5 || $komentar === '') {
                $error = 'Semua data wajib diisi dan rating harus 1 sampai 5.';
            } else {
                try {
                    $this->model->create([
                        'mahasiswa_id' => $mahasiswaId,
                        'rating' => $rating,
                        'komentar' => $komentar
                    ]);

                    header('Location: index.php?action=ulasan');
                    exit;
                } catch (PDOException $e) {
                    $error = 'Gagal menyimpan ulasan. Periksa data mahasiswa.';
                }
            }
        }

        $mahasiswa = $this->model->mahasiswa();

        require __DIR__ . '/../views/ulasan/form.php';
    }

    // Menampilkan form edit ulasan
    public function edit(): void
    {
        $id = (int)($_GET['id'] ?? 0);
        $ulasan = $this->model->find($id);

        if (!$ulasan) {
            header('Location: index.php?action=ulasan');
            exit;
        }

        $pageTitle = 'Edit Ulasan';
        $active = 'ulasan';
        $error = '';
        $mahasiswa = $this->model->mahasiswa();

        require __DIR__ . '/../views/ulasan/edit.php';
    }

    // Menyimpan perubahan ulasan
    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Metode tidak diizinkan.');
        }

        $id = (int)($_POST['id'] ?? 0);
        $mahasiswaId = (int)($_POST['mahasiswa_id'] ?? 0);
        $rating = (int)($_POST['rating'] ?? 0);
        $komentar = trim($_POST['komentar'] ?? '');

        $ulasan = $this->model->find($id);

        if (!$ulasan) {
            header('Location: index.php?action=ulasan');
            exit;
        }

        if ($mahasiswaId <= 0 || $rating < 1 || $rating > 5 || $komentar === '') {
            $pageTitle = 'Edit Ulasan';
            $active = 'ulasan';
            $error = 'Semua data wajib diisi dan rating harus 1 sampai 5.';
            $mahasiswa = $this->model->mahasiswa();

            $ulasan['mahasiswa_id'] = $mahasiswaId;
            $ulasan['rating'] = $rating;
            $ulasan['komentar'] = $komentar;

            require __DIR__ . '/../views/ulasan/edit.php';
            return;
        }

        try {
            $this->model->update($id, [
                'mahasiswa_id' => $mahasiswaId,
                'rating' => $rating,
                'komentar' => $komentar
            ]);

            header('Location: index.php?action=ulasan');
            exit;
        } catch (PDOException $e) {
            header('Location: index.php?action=ulasan-edit&id=' . $id);
            exit;
        }
    }

    // Menghapus ulasan
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Metode tidak diizinkan.');
        }

        $this->model->delete((int)($_POST['id'] ?? 0));

        header('Location: index.php?action=ulasan');
        exit;
    }
}
