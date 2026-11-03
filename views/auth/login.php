
<?php
$pageTitle = 'Login Sistem Informasi Akademik';
$active = 'login';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= htmlspecialchars($pageTitle) ?></title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: #eaf3ff;
            color: #12376b;
            min-height: 100vh;
        }

        /* HEADER */
        .navbar {
            min-height: 110px;
            background: #082d63;
            border-bottom: 5px solid #ffc928;
            padding: 15px 5%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 18px;
        }

        .logo {
            width: 75px;
            height: 75px;
            background: white;
            border: 3px solid #ffc928;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 40px;
        }

        .brand h2 {
            color: white;
            font-size: 25px;
        }

        .brand h2 span {
            color: #ffc928;
        }

        .brand p {
            color: #dceaff;
            font-size: 13px;
        }

        .slogan {
            color: white;
            font-size: 15px;
            font-weight: 600;
        }

        /* KONTEN UTAMA */
        .main {
            min-height: calc(100vh - 185px);
            padding: 50px 5%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 45px;
            background:
                linear-gradient(120deg, #eaf3ff, #cce4ff);
        }

        /* BAGIAN SAMBUTAN */
        .welcome h1 {
            color: #082d63;
            font-size: clamp(30px, 4vw, 48px);
            line-height: 1.25;
            font-weight: 800;
            margin-bottom: 18px;
        }

        .welcome h1 span {
            color: #f2ae00;
        }

        .welcome p {
            color: #385579;
            font-size: 16px;
            line-height: 1.8;
            max-width: 500px;
        }

        .education-icons {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 35px;
        }

        .edu-item {
            text-align: center;
            color: #12376b;
            font-size: 13px;
            font-weight: 600;
        }

        .edu-icon {
            width: 65px;
            height: 65px;
            background: white;
            border: 2px solid #8db9ec;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 30px;
            margin: 0 auto 10px;
        }

        .students {
            font-size: 85px;
            margin-top: 25px;
        }

        /* LOGIN */
        .login-container {
            display: flex;
            justify-content: center;
        }

        .login-card {
            width: 100%;
            max-width: 520px;
            background: white;
            border-radius: 25px;
            padding: 45px;
            box-shadow: 0 15px 45px rgba(8, 45, 99, .15);
            border: 1px solid #d7e7fa;
        }

        .login-heading {
            text-align: center;
            margin-bottom: 30px;
        }

        .lock {
            font-size: 45px;
            margin-bottom: 10px;
        }

        .login-heading h2 {
            color: #082d63;
            font-size: 27px;
        }

        .login-heading p {
            color: #70839c;
            font-size: 13px;
            margin-top: 8px;
        }

        /* PESAN ERROR */
        .error-message {
            background: #fff0f0;
            color: #b42318;
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        /* INPUT */
        .field {
            margin-bottom: 22px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #12376b;
        }

        .field input {
            width: 100%;
            padding: 15px 18px;
            border: 1.5px solid #c8d9ee;
            border-radius: 12px;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: .3s;
        }

        .field input:focus {
            border-color: #1261b5;
            box-shadow: 0 0 0 3px rgba(18, 97, 181, .12);
        }

        /* TOMBOL LOGIN */
        .login-button {
            width: 100%;
            padding: 15px;
            border: none;
            border-radius: 12px;
            background: #0b4388;
            color: white;
            font-family: inherit;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: .3s;
        }

        .login-button:hover {
            background: #062b5c;
            transform: translateY(-2px);
        }

        .welcome-text {
            text-align: center;
            margin-top: 25px;
            font-size: 12px;
            color: #647b9a;
        }

        /* FOOTER */
        .footer {
            background: #082d63;
            color: white;
            padding: 22px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            font-size: 12px;
        }

        .footer strong {
            color: #ffc928;
        }

        /* RESPONSIVE */
        @media (max-width: 850px) {
            .main {
                grid-template-columns: 1fr;
                padding: 40px 6%;
            }

            .welcome {
                text-align: center;
            }

            .welcome p {
                margin: auto;
            }

            .education-icons {
                justify-content: center;
            }

            .students {
                font-size: 65px;
            }

            .slogan {
                display: none;
            }
        }

        @media (max-width: 500px) {
            .navbar {
                padding: 15px;
            }

            .logo {
                width: 55px;
                height: 55px;
                font-size: 28px;
            }

            .brand h2 {
                font-size: 17px;
            }

            .login-card {
                padding: 25px 20px;
            }

            .login-heading h2 {
                font-size: 22px;
            }

            .footer {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header class="navbar">

        <div class="brand">
            <div class="logo">🎓</div>

            <div>
                <h2>
                    Sistem Informasi
                    <span>Akademik</span>
                </h2>

                <p>STMIK / Universitas</p>
            </div>
        </div>

        <div class="slogan">
            🎓 Belajar • Berkarya • Berprestasi
        </div>

    </header>

    <!-- KONTEN -->
    <main class="main">

        <!-- SAMBUTAN -->
        <section class="welcome">

            <h1>
                Selamat Datang di<br>
                Sistem Informasi<br>
                <span>Akademik</span>
            </h1>

            <p>
                Akses layanan akademik dengan mudah,
                cepat dan aman. Kelola informasi
                mahasiswa dalam satu sistem terpadu.
            </p>

            <div class="education-icons">

                <div class="edu-item">
                    <div class="edu-icon">📚</div>
                    Informasi<br>Akademik
                </div>

                <div class="edu-item">
                    <div class="edu-icon">🎓</div>
                    Administrasi<br>Mahasiswa
                </div>

                <div class="edu-item">
                    <div class="edu-icon">📊</div>
                    Prestasi<br>Akademik
                </div>

            </div>

            <div class="students">
                👨🏻‍🎓 👩🏻‍🎓
            </div>

        </section>

        <!-- FORM LOGIN -->
        <section class="login-container">

            <div class="login-card">

                <div class="login-heading">

                    <div class="lock">🔐</div>

                    <h2>Login Sistem Akademik</h2>

                    <p>
                        Masuk untuk mengakses data akademik Anda
                    </p>

                </div>

                <?php if (!empty($error)): ?>
                    <div class="error-message">
                        <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="index.php?action=login">

                    <div class="field">

                        <label for="username">
                            Username
                        </label>

                        <input
                            type="text"
                            id="username"
                            name="username"
                            placeholder="Masukkan username"
                            value="<?= htmlspecialchars($_POST['username'] ?? '') ?>"
                            autocomplete="username"
                            required
                        >

                    </div>

                    <div class="field">

                        <label for="password">
                            Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="Masukkan password"
                            autocomplete="current-password"
                            required
                        >

                    </div>

                    <button type="submit" class="login-button">
                        🔑 Login Sekarang
                    </button>

                </form>

                <div class="welcome-text">
                    Selamat datang di Sistem Informasi Akademik
                </div>

            </div>

        </section>

    </main>

    <!-- FOOTER -->
    <footer class="footer">

    <div>
        Sistem Informasi Akademik
    </div>

    <div>
        Belajar • Berkarya • Berprestasi
    </div>

</footer>

</body>
</html>
