
<?php

require_once __DIR__ . '/../config/Config.php';

class AuthController
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Config::db();
    }

    // Menampilkan halaman Login dan memproses autentikasi
    public function login(): void
    {
        $error = '';

        // Jika sudah login, arahkan ke Dashboard
        if (!empty($_SESSION['user'])) {
            header('Location: index.php?action=home');
            exit;
        }

        // Memproses form Login
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = trim($_POST['username'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($username === '' || $password === '') {

                $error = 'Username dan password wajib diisi.';

            } else {

                try {
                    // Mengambil data pengguna dari tabel users
                    $stmt = $this->db->prepare(
                        "SELECT id, nama, username, password_hash
                         FROM users
                         WHERE username = ?
                         LIMIT 1"
                    );

                    $stmt->execute([$username]);

                    $user = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Memeriksa password
                    if ($user && password_verify(
                        $password,
                        $user['password_hash']
                    )) {

                        // Membuat session baru
                        session_regenerate_id(true);

                        $_SESSION['user'] = [
                            'id' => $user['id'],
                            'nama' => $user['nama'],
                            'username' => $user['username']
                        ];

                        // Masuk ke Dashboard
                        header('Location: index.php?action=home');
                        exit;

                    } else {

                        $error = 'Username atau password salah.';

                    }

                } catch (PDOException $e) {

                    $error = 'Terjadi kesalahan saat mengakses database.';

                }
            }
        }

        // Memanggil halaman Login
        require __DIR__ . '/../views/auth/login.php';
    }

    // Logout
    public function logout(): void
    {
        // Menghapus seluruh data session
        $_SESSION = [];

        // Menghapus cookie session jika digunakan
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        // Menghancurkan session
        session_destroy();

        // Kembali ke halaman Login
        header('Location: index.php?action=login');
        exit;
    }

    // Proteksi halaman
    public function checkLogin(): void
    {
        if (empty($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }
    }
}
