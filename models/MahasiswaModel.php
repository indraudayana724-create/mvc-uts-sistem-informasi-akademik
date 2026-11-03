
<?php
require_once __DIR__ . '/../config/Config.php';

class MahasiswaModel {
    private PDO $db;

    public function __construct() {
        $this->db = Config::db();
    }

    // Menampilkan semua data mahasiswa
    public function all(): array {
        $sql = 'SELECT m.*, p.nama_prodi FROM mahasiswa m
                LEFT JOIN prodi p ON p.id = m.prodi_id
                ORDER BY m.id DESC';

        return $this->db->query($sql)->fetchAll();
    }

    // Mencari mahasiswa berdasarkan ID
    public function find(int $id): ?array {
        $stmt = $this->db->prepare(
            'SELECT * FROM mahasiswa WHERE id = ?'
        );

        $stmt->execute([$id]);
        $row = $stmt->fetch();

        return $row ?: null;
    }

    // Menambahkan data mahasiswa
    public function create(array $data): void {
        $stmt = $this->db->prepare(
            'INSERT INTO mahasiswa
            (nim, nama, email, jenis_kelamin, prodi_id)
            VALUES (?, ?, ?, ?, ?)'
        );

        $stmt->execute([
            $data['nim'],
            $data['nama'],
            $data['email'],
            $data['jenis_kelamin'],
            $data['prodi_id'] ?: null
        ]);
    }

    // Mengubah data mahasiswa
    public function update(int $id, array $data): void {
        $stmt = $this->db->prepare(
            'UPDATE mahasiswa
            SET nim=?, nama=?, email=?, jenis_kelamin=?, prodi_id=?
            WHERE id=?'
        );

        $stmt->execute([
            $data['nim'],
            $data['nama'],
            $data['email'],
            $data['jenis_kelamin'],
            $data['prodi_id'] ?: null,
            $id
        ]);
    }

    // Menghapus data mahasiswa
    public function delete(int $id): void {
        $stmt = $this->db->prepare(
            'DELETE FROM mahasiswa WHERE id = ?'
        );

        $stmt->execute([$id]);
    }

    // Menampilkan daftar program studi
    public function programs(): array {
        return $this->db->query(
            'SELECT id, nama_prodi FROM prodi ORDER BY nama_prodi'
        )->fetchAll();
    }

    // SEARCH: Mencari berdasarkan NIM, nama, atau email
    public function search(string $keyword): array {
        $sql = 'SELECT m.*, p.nama_prodi
                FROM mahasiswa m
                LEFT JOIN prodi p ON p.id = m.prodi_id
                WHERE m.nim LIKE ?
                   OR m.nama LIKE ?
                   OR m.email LIKE ?
                ORDER BY m.id DESC';

        $keyword = '%' . $keyword . '%';

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            $keyword,
            $keyword,
            $keyword
        ]);

        return $stmt->fetchAll();
    }
}
