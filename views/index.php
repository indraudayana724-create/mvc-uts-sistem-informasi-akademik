
<?php
$pageTitle = 'Dashboard Sistem Informasi Akademik';
$active = 'home';

$nama = $user['nama'] ?? ($_SESSION['user']['nama'] ?? 'Administrator');
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

        .navbar {
            background: #082d63;
            border-bottom: 5px solid #ffc928;
            padding: 17px 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 18px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo {
            width: 65px;
            height: 65px;
            background: white;
            border: 3px solid #ffc928;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 35px;
        }

        .brand h2 {
            color: white;
            font-size: 22px;
        }

        .brand h2 span {
            color: #ffc928;
        }

        .brand p {
            color: #dceaff;
            font-size: 12px;
        }

        .nav-menu {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }

        .nav-menu a {
            color: white;
            text-decoration: none;
            padding: 10px 14px;
            border-radius: 9px;
            font-size: 13px;
            transition: .3s;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            background: #1763bd;
        }

        .nav-menu a.logout {
            background: #d93030;
        }

        .nav-menu a.logout:hover {
            background: #a91f1f;
        }

        .hero {
            padding: 55px 6%;
            background: linear-gradient(120deg, #eaf3ff, #cce4ff);
        }

        .hero-content {
            max-width: 1250px;
            margin: auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            align-items: center;
            gap: 40px;
        }

        .hero-text h1 {
            font-size: clamp(30px, 4vw, 48px);
            line-height: 1.3;
            color: #082d63;
            margin-bottom: 18px;
        }

        .hero-text h1 span {
            color: #f2ae00;
        }

        .hero-text p {
            color: #385579;
            line-height: 1.8;
            font-size: 15px;
            margin-bottom: 22px;
        }

        .user-info {
            background: white;
            border-left: 5px solid #ffc928;
            border-radius: 12px;
            padding: 18px 22px;
            line-height: 2;
            box-shadow: 0 5px 20px rgba(8,45,99,.08);
        }

        .hero-illustration {
            text-align: center;
            background: rgba(255,255,255,.7);
            border-radius: 30px;
            padding: 40px 20px;
            border: 1px solid white;
        }

        .big-icon {
            font-size: 100px;
            margin-bottom: 15px;
        }

        .hero-illustration h2 {
            color: #082d63;
            font-size: 23px;
        }

        .hero-illustration p {
            color: #647b9a;
            margin-top: 10px;
            font-size: 13px;
        }

        .modules {
            max-width: 1250px;
            margin: 0 auto;
            padding: 35px 6% 55px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .module-card {
            background: white;
            padding: 28px;
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(8,45,99,.08);
            border: 1px solid #dceaff;
            transition: .3s;
        }

        .module-card:hover {
            transform: translateY(-5px);
        }

        .module-icon {
            font-size: 40px;
            margin-bottom: 15px;
        }

        .module-card h3 {
            color: #082d63;
            font-size: 20px;
            margin-bottom: 10px;
        }

        .module-card p {
            color: #647b9a;
            font-size: 13px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .module-card a {
            display: inline-block;
            text-decoration: none;
            background: #0b4388;
            color: white;
            padding: 10px 17px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 600;
        }

        .module-card a:hover {
            background: #062b5c;
        }

        .footer {
            background: #082d63;
            border-top: 5px solid #ffc928;
            padding: 23px 5%;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            font-size: 13px;
        }

        .footer strong {
            color: #ffc928;
        }

        @media(max-width: 850px) {
            .hero-content {
                grid-template-columns: 1fr;
            }

            .hero-text {
                text-align: center;
            }

            .modules {
                grid-template-columns: 1fr 1fr;
            }

            .nav-menu {
                justify-content: center;
            }
        }

        @media(max-width: 550px) {
            .navbar {
                justify-content: center;
            }

            .brand {
                flex-direction: column;
                text-align: center;
            }

            .modules {
                grid-template-columns: 1fr;
            }

            .footer {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>

<header class="navbar">

    <div class="brand">
        <div class="logo">🎓</div>

        <div>
            <h2>Sistem Informasi <span>Akademik</span></h2>
            <p>STMIK / Universitas</p>
        </div>
    </div>

    <nav class="nav-menu">
        <a href="index.php" class="active">Dashboard</a>
        <a href="index.php?action=mahasiswa">Mahasiswa</a>
        <a href="index.php?action=ulasan">Ulasan</a>
        <a href="index.php?action=about">About</a>
        <a href="index.php?action=logout" class="logout">Logout</a>
    </nav>

</header>

<section class="hero">

    <div class="hero-content">

        <div class="hero-text">

            <h1>
                Selamat Datang di<br>
                Sistem Informasi<br>
                <span>Akademik</span>
            </h1>

            <p>
                Sistem informasi akademik untuk membantu
                pengelolaan data mahasiswa dan informasi
                akademik secara mudah, cepat, dan terstruktur.
            </p>

            <div class="user-info">
                <div>
                    <strong>Nama:</strong>
                    <?= htmlspecialchars($nama) ?>
                </div>

                <div>
                    <strong>Status:</strong> Administrator
                </div>

                <div>
                    <strong>Sistem:</strong> Informasi Akademik
                </div>
            </div>

        </div>

        <div class="hero-illustration">
            <div class="big-icon">👨🏻‍🎓 📚 👩🏻‍🎓</div>
            <h2>Belajar • Berkarya • Berprestasi</h2>
            <p>Selamat menggunakan Sistem Informasi Akademik</p>
        </div>

    </div>

</section>

<section class="modules">

    <div class="module-card">
        <div class="module-icon">🎓</div>
        <h3>Data Mahasiswa</h3>
        <p>
            Kelola data mahasiswa dengan fitur tambah,
            tampil, edit, hapus, dan pencarian data.
        </p>
        <a href="index.php?action=mahasiswa">Buka Data Mahasiswa</a>
    </div>

    <div class="module-card">
        <div class="module-icon">📚</div>
        <h3>Ulasan Akademik</h3>
        <p>
            Kelola penilaian dan komentar terkait
            layanan akademik.
        </p>
        <a href="index.php?action=ulasan">Buka Ulasan</a>
    </div>

    <div class="module-card">
        <div class="module-icon">🏛️</div>
        <h3>Arsitektur MVC</h3>
        <p>
            Sistem menggunakan Model, View, dan Controller
            untuk memisahkan pengelolaan aplikasi.
        </p>
        <a href="index.php?action=about">Tentang Sistem</a>
    </div>

</section>

<footer class="footer">
    <div>
        🎓 <strong>Sistem Informasi Akademik</strong>
    </div>

    <div>
        Belajar • Berkarya • Berprestasi
    </div>
</footer>

</body>
</html>
