
<?php

require_once __DIR__ . '/../models/KrsModel.php';

class KrsController
{
    private KrsModel $model;

    public function __construct()
    {
        $this->model = new KrsModel();
    }

    // =========================================
    // MENAMPILKAN DAFTAR KRS
    // =========================================
    public function index(): void
    {
        $pageTitle = 'Data KRS';
        $active = 'krs';

        $krs = $this->model->all();

        require __DIR__ . '/../views/krs/index.php';
    }

    // =========================================
    // MENAMBAHKAN DATA KRS
    // =========================================
    public function create(): void
    {
        $pageTitle = 'Tambah KRS';
        $active = 'krs';
        $error = '';

        $krs = [
            'mahasiswa_id' => '',
            'mata_kuliah_id' => '',
            'semester' => '',
            'tahun_ajaran' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'mahasiswa_id' => (int)($_POST['mahasiswa_id'] ?? 0),
                'mata_kuliah_id' => (int)($_POST['mata_kuliah_id'] ?? 0),
                'semester' => trim($_POST['semester'] ?? ''),
                'tahun_ajaran' => trim($_POST['tahun_ajaran'] ?? '')
            ];

            $krs = $data;

            if (
                $data['mahasiswa_id'] <= 0 ||
                $data['mata_kuliah_id'] <= 0 ||
                $data['semester'] === '' ||
                $data['tahun_ajaran'] === ''
            ) {
                $error = 'Semua data wajib diisi.';
            } else {

                try {
                    $this->model->create($data);

                    header('Location: index.php?action=krs');
                    exit;

                } catch (PDOException $e) {
                    $error = 'Gagal menyimpan KRS. Periksa kembali data yang dipilih.';
                }
            }
        }

        $mahasiswa = $this->model->mahasiswa();
        $mataKuliah = $this->model->mataKuliah();

        require __DIR__ . '/../views/krs/form.php';
    }

    // =========================================
    // MENAMPILKAN FORM EDIT KRS
    // =========================================
    public function edit(): void
    {
        $id = (int)($_GET['id'] ?? 0);

        $krs = $this->model->find($id);

        if (!$krs) {
            header('Location: index.php?action=krs');
            exit;
        }

        $pageTitle = 'Edit KRS';
        $active = 'krs';
        $error = '';

        $mahasiswa = $this->model->mahasiswa();
        $mataKuliah = $this->model->mataKuliah();

        require __DIR__ . '/../views/krs/form.php';
    }

    // =========================================
    // MENYIMPAN PERUBAHAN DATA KRS
    // =========================================
    public function update(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Metode tidak diizinkan.');
        }

        $id = (int)($_POST['id'] ?? 0);

        $krs = $this->model->find($id);

        if (!$krs) {
            header('Location: index.php?action=krs');
            exit;
        }

        $data = [
            'mahasiswa_id' => (int)($_POST['mahasiswa_id'] ?? 0),
            'mata_kuliah_id' => (int)($_POST['mata_kuliah_id'] ?? 0),
            'semester' => trim($_POST['semester'] ?? ''),
            'tahun_ajaran' => trim($_POST['tahun_ajaran'] ?? '')
        ];

        $pageTitle = 'Edit KRS';
        $active = 'krs';
        $error = '';

        if (
            $data['mahasiswa_id'] <= 0 ||
            $data['mata_kuliah_id'] <= 0 ||
            $data['semester'] === '' ||
            $data['tahun_ajaran'] === ''
        ) {
            $error = 'Semua data wajib diisi.';

            $krs = array_merge($krs, $data);

            $mahasiswa = $this->model->mahasiswa();
            $mataKuliah = $this->model->mataKuliah();

            require __DIR__ . '/../views/krs/form.php';
            return;
        }

        try {

            $this->model->update($id, $data);

            header('Location: index.php?action=krs');
            exit;

        } catch (PDOException $e) {

            $error = 'Gagal mengubah KRS. Periksa kembali data yang dipilih.';

            $krs = array_merge($krs, $data);

            $mahasiswa = $this->model->mahasiswa();
            $mataKuliah = $this->model->mataKuliah();

            require __DIR__ . '/../views/krs/form.php';
        }
    }

    // =========================================
    // MENGHAPUS DATA KRS
    // =========================================
    public function delete(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            exit('Metode tidak diizinkan.');
        }

        $id = (int)($_POST['id'] ?? 0);

        if ($id > 0) {
            $this->model->delete($id);
        }

        header('Location: index.php?action=krs');
        exit;
    }
}
