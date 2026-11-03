
<?php

require_once __DIR__ . '/../config/Config.php';

class UlasanModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Config::db();
    }

    // Menampilkan semua ulasan
    public function all(): array
    {
        $sql = "SELECT u.*, m.nama, m.nim
                FROM ulasan u
                JOIN mahasiswa m ON m.id = u.mahasiswa_id
                ORDER BY u.id DESC";

        return $this->db->query($sql)->fetchAll();
    }

    // Mengambil satu ulasan berdasarkan ID
    public function find(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM ulasan WHERE id = ?"
        );

        $stmt->execute([$id]);

        $row = $stmt->fetch();

        return $row ?: null;
    }

    // Menambahkan ulasan
    public function create(array $data): void
    {
        $sql = "INSERT INTO ulasan
                (mahasiswa_id, rating, komentar)
                VALUES (?, ?, ?)";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            $data['mahasiswa_id'],
            $data['rating'],
            $data['komentar']
        ]);
    }

    // Mengubah ulasan
    public function update(int $id, array $data): void
    {
        $sql = "UPDATE ulasan
                SET mahasiswa_id = ?, rating = ?, komentar = ?
                WHERE id = ?";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            $data['mahasiswa_id'],
            $data['rating'],
            $data['komentar'],
            $id
        ]);
    }

    // Menghapus ulasan
    public function delete(int $id): void
    {
        $stmt = $this->db->prepare(
            "DELETE FROM ulasan WHERE id = ?"
        );

        $stmt->execute([$id]);
    }

    // Mengambil daftar mahasiswa
    public function mahasiswa(): array
    {
        $sql = "SELECT id, nim, nama
                FROM mahasiswa
                ORDER BY nama ASC";

        return $this->db->query($sql)->fetchAll();
    }
}
