CREATE DATABASE IF NOT EXISTS db_akademik CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE db_akademik;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100) NOT NULL,
  username VARCHAR(50) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS prodi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kode_prodi VARCHAR(15) NOT NULL UNIQUE,
  nama_prodi VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS mahasiswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nim VARCHAR(30) NOT NULL UNIQUE,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(120) NULL,
  jenis_kelamin ENUM('L','P') NOT NULL DEFAULT 'L',
  prodi_id INT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_mahasiswa_prodi FOREIGN KEY (prodi_id) REFERENCES prodi(id)
    ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS dosen (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nidn VARCHAR(30) NOT NULL UNIQUE,
  nama VARCHAR(100) NOT NULL,
  email VARCHAR(120) NULL,
  prodi_id INT NULL,
  CONSTRAINT fk_dosen_prodi FOREIGN KEY (prodi_id) REFERENCES prodi(id)
    ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS mata_kuliah (
  id INT AUTO_INCREMENT PRIMARY KEY,
  kode_mk VARCHAR(20) NOT NULL UNIQUE,
  nama_mk VARCHAR(120) NOT NULL,
  sks TINYINT UNSIGNED NOT NULL DEFAULT 2,
  dosen_id INT NULL,
  CONSTRAINT fk_mk_dosen FOREIGN KEY (dosen_id) REFERENCES dosen(id)
    ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS krs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mahasiswa_id INT NOT NULL,
  mata_kuliah_id INT NOT NULL,
  semester VARCHAR(20) NOT NULL,
  tahun_ajaran VARCHAR(20) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_krs_mahasiswa FOREIGN KEY (mahasiswa_id) REFERENCES mahasiswa(id)
    ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT fk_krs_mk FOREIGN KEY (mata_kuliah_id) REFERENCES mata_kuliah(id)
    ON UPDATE CASCADE ON DELETE CASCADE,
  UNIQUE KEY uq_krs (mahasiswa_id, mata_kuliah_id, semester, tahun_ajaran)
);

INSERT IGNORE INTO prodi (id, kode_prodi, nama_prodi) VALUES
(1, 'TI', 'Teknik Informatika'),
(2, 'SI', 'Sistem Informasi'),
(3, 'MI', 'Manajemen Informatika');

INSERT IGNORE INTO mahasiswa (nim, nama, email, jenis_kelamin, prodi_id) VALUES
('2026001', 'Andi Saputra', 'andi@example.com', 'L', 1),
('2026002', 'Siti Lestari', 'siti@example.com', 'P', 2);
