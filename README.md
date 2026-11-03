# Project UTS - Sistem Informasi Akademik MVC

## Fitur
- Navigasi Dashboard, Mahasiswa, dan About.
- CRUD tabel `mahasiswa` (tambah, tampil, edit, hapus).
- Enam tabel database: `users`, `mahasiswa`, `prodi`, `dosen`, `mata_kuliah`, `krs`.
- Pemisahan Model, View, dan Controller; query memakai PDO prepared statements.

## Cara menjalankan (XAMPP)
1. Ekstrak folder `mvc_uts_mahasiswa` ke `C:\xampp\htdocs\`.
2. Jalankan Apache dan MySQL dari XAMPP.
3. Buka `http://localhost/phpmyadmin`.
4. Import file `database/db_akademik.sql`.
5. Periksa `config/Config.php`. Default database `db_akademik`, user `root`, password kosong. Sesuaikan jika berbeda.
6. Buka `http://localhost/mvc_uts_mahasiswa/`.

## Navigasi
- `index.php` = Dashboard
- `index.php?action=mahasiswa` = daftar mahasiswa
- `index.php?action=mahasiswa-create` = tambah mahasiswa
- `index.php?action=mahasiswa-edit&id=1` = edit mahasiswa
- `index.php?action=mahasiswa-delete` = hapus melalui form POST
- `index.php?action=about` = About

## Alur MVC untuk presentasi
1. View mengirim form ke URL dengan `action`.
2. `index.php` bertindak sebagai router dan memanggil controller yang sesuai.
3. `MahasiswaController` memvalidasi input dan memanggil model.
4. `MahasiswaModel` menjalankan query database dengan PDO.
5. Controller mengarahkan kembali ke halaman daftar setelah operasi berhasil.

## Catatan
- Project ini merupakan scaffold contoh. Sesuaikan nama folder, konfigurasi database, identitas kampus, dan kebutuhan dosen.
- Tabel `users` sudah disiapkan untuk pengembangan login, tetapi autentikasi belum diaktifkan.
- Sebelum dipakai lebih lanjut, tambahkan CSRF token dan autentikasi untuk deployment nyata.
