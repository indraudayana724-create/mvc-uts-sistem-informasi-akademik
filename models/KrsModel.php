<?php

require_once __DIR__ . '/../config/Config.php';

class KrsModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Config::db();
    }

    // =========================================
    // MENAMPILKAN SEMUA DATA KRS
    // =========================================
    public function all(): array
    {
        $sql = "SELECT
                    k.*,
                    m.nim,
                    m.nama AS nama_mahasiswa,
                    mk.kode_mk,
                    mk.nama_mk,
                    mk.sks,
                    d.nidn,
                    d.nama AS nama_dosen
                FROM krs k
                INNER JOIN mahasiswa m
                    ON m.id = k.mahasiswa_id
                INNER JOIN mata_kuliah mk
                    ON mk.id = k.mata_kuliah_id
                LEFT JOIN dosen d
                    ON d.id = mk.dosen_id
                ORDER BY k.id DESC";

        return $this->db
                    ->query($sql)
                    ->fetchAll(PDO::FETCH_ASSOC);
    }

    // =========================================
    // MENGAMBIL SATU DATA KRS
    // =========================================
    public function find(int $id): ?array
    {
        $sql = "SELECT *
                FROM krs
                WHERE id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data ?: null;
    }

    // =========================================
    // MENAMBAHKAN DATA KRS
    // =========================================
    public function create(array $data): void
    {
        $sql = "INSERT INTO krs
                (
                    mahasiswa_id,
                    mata_kuliah_id,
                    semester,
                    tahun_ajaran,
                    created_at
                )
                VALUES (?, ?, ?, ?, NOW())";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            $data['mahasiswa_id'],
            $data['mata_kuliah_id'],
            $data['semester'],
            $data['tahun_ajaran']
        ]);
    }

    // =========================================
    // MENGUBAH DATA KRS
    // =========================================
    public function update(int $id, array $data): void
    {
        $sql = "UPDATE krs
                SET
                    mahasiswa_id = ?,
                    mata_kuliah_id = ?,
                    semester = ?,
                    tahun_ajaran = ?
                WHERE id = ?";

        $stmt = $this->db->prepare($sql);

        $stmt->execute([
            $data['mahasiswa_id'],
            $data['mata_kuliah_id'],
            $data['semester'],
            $data['tahun_ajaran'],
            $id
        ]);
    }

    // =========================================
    // MENGHAPUS DATA KRS
    // =========================================
    public function delete(int $id): void
    {
        $sql = "DELETE FROM krs
                WHERE id = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
    }

    // =========================================
    // MENGAMBIL DAFTAR MAHASISWA
    // =========================================
    public function mahasiswa(): array
    {
        $sql = "SELECT
                    id,
                    nim,
                    nama
                FROM mahasiswa
                ORDER BY nama ASC";

        return $this->db
                    ->query($sql)
                    ->fetchAll(PDO::FETCH_ASSOC);
    }

    // =========================================
    // MENGAMBIL DAFTAR MATA KULIAH
    // =========================================
    public function mataKuliah(): array
    {
        $sql = "SELECT
                    id,
                    kode_mk,
                    nama_mk,
                    sks,
                    dosen_id
                FROM mata_kuliah
                ORDER BY nama_mk ASC";

        return $this->db
                    ->query($sql)
                    ->fetchAll(PDO::FETCH_ASSOC);
    }
}