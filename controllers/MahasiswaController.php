
<?php
require_once __DIR__ . '/../models/MahasiswaModel.php';

class MahasiswaController {
    private MahasiswaModel $model;

    public function __construct() {
        $this->model = new MahasiswaModel();
    }

    // Menampilkan data mahasiswa dan pencarian
    public function index(): void {
        $pageTitle = 'Data Mahasiswa';
        $active = 'mahasiswa';

        $keyword = trim($_GET['keyword'] ?? '');

        if ($keyword !== '') {
            $mahasiswa = $this->model->search($keyword);
        } else {
            $mahasiswa = $this->model->all();
        }

        require __DIR__ . '/../views/mahasiswa/index.php';
    }

    // Menambahkan mahasiswa
    public function create(): void {
        $active = 'mahasiswa';
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->validate();

            if ($data['error'] === '') {
                try {
                    $this->model->create($data);
                    header('Location: index.php?action=mahasiswa');
                    exit;
                } catch (PDOException $e) {
                    $error = 'Gagal menyimpan. Pastikan NIM belum digunakan dan data sudah benar.';
                }
            } else {
                $error = $data['error'];
            }
        }

        $programs = $this->model->programs();
        $row = [
            'nim' => '',
            'nama' => '',
            'email' => '',
            'jenis_kelamin' => 'L',
            'prodi_id' => ''
        ];

        $pageTitle = 'Tambah Mahasiswa';
        require __DIR__ . '/../views/mahasiswa/form.php';
    }

    // Mengedit mahasiswa
    public function edit(): void {
        $active = 'mahasiswa';

        $id = (int)($_GET['id'] ?? 0);

        $row = $this->model->find($id);

        if (!$row) {
            http_response_code(404);
            exit('Data mahasiswa tidak ditemukan.');
        }

        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->validate();

            if ($data['error'] === '') {
                try {
                    $this->model->update($id, $data);
                    header('Location: index.php?action=mahasiswa');
                    exit;
                } catch (PDOException $e) {
                    $error = 'Gagal memperbarui. Pastikan NIM tidak sama dengan data lain.';
                }
            } else {
                $error = $data['error'];
            }

            $row = array_merge($row, $data);
        }

        $programs = $this->model->programs();
        $pageTitle = 'Edit Mahasiswa';

        require __DIR__ . '/../views/mahasiswa/form.php';
    }

    // Menghapus mahasiswa
    public function delete(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Metode tidak diizinkan.');
        }

        $this->model->delete((int)($_POST['id'] ?? 0));

        header('Location: index.php?action=mahasiswa');
        exit;
    }

    // Validasi data
    private function validate(): array {
        $data = [
            'nim' => trim($_POST['nim'] ?? ''),
            'nama' => trim($_POST['nama'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'jenis_kelamin' => $_POST['jenis_kelamin'] ?? 'L',
            'prodi_id' => $_POST['prodi_id'] ?? '',
            'error' => ''
        ];

        if ($data['nim'] === '' || $data['nama'] === '') {
            $data['error'] = 'NIM dan nama wajib diisi.';
        } elseif (
            $data['email'] !== '' &&
            !filter_var($data['email'], FILTER_VALIDATE_EMAIL)
        ) {
            $data['error'] = 'Format email tidak valid.';
        } elseif (!in_array($data['jenis_kelamin'], ['L', 'P'], true)) {
            $data['error'] = 'Jenis kelamin tidak valid.';
        }

        return $data;
    }
}
