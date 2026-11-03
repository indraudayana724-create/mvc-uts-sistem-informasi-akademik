
<?php require_once __DIR__ . '/../../config/Config.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>
<?= htmlspecialchars($pageTitle ?? Config::$appName) ?>
- <?= htmlspecialchars(Config::$appName) ?>
</title>

<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f4f6fb;
    color: #1f2937;
}

header {
    background: #172554;
    color: white;
    padding: 18px 5%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

header strong {
    font-size: 20px;
}

nav {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

nav a {
    color: white;
    text-decoration: none;
    padding: 9px 12px;
    border-radius: 7px;
}

nav a:hover,
nav a.active {
    background: #2563eb;
}

main {
    max-width: 1100px;
    margin: 28px auto;
    padding: 0 18px;
}

.panel {
    background: white;
    border-radius: 12px;
    padding: 22px;
    box-shadow: 0 4px 18px #0f172a0d;
}

h1 {
    margin-top: 0;
    font-size: 26px;
}

.muted {
    color: #64748b;
}

.btn {
    display: inline-block;
    border: 0;
    border-radius: 7px;
    padding: 10px 14px;
    text-decoration: none;
    background: #2563eb;
    color: white;
    cursor: pointer;
    font-size: 14px;
}

.btn.gray {
    background: #64748b;
}

.btn.red {
    background: #dc2626;
}

.btn.green {
    background: #15803d;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 18px;
}

th, td {
    text-align: left;
    padding: 12px;
    border-bottom: 1px solid #e5e7eb;
}

th {
    background: #eff6ff;
}

form.inline {
    display: inline;
}

.field {
    margin: 14px 0;
}

.field label {
    display: block;
    font-weight: bold;
    margin-bottom: 6px;
}

.field input,
.field select,
.field textarea {
    width: 100%;
    padding: 11px;
    border: 1px solid #cbd5e1;
    border-radius: 7px;
}

.alert {
    padding: 12px;
    background: #fee2e2;
    color: #991b1b;
    border-radius: 7px;
    margin-bottom: 14px;
}

.cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
    gap: 16px;
}

.stat {
    background: #eff6ff;
    padding: 20px;
    border-radius: 10px;
}

.stat strong {
    display: block;
    font-size: 26px;
    color: #1d4ed8;
    margin-top: 8px;
}

footer {
    text-align: center;
    color: #64748b;
    padding: 25px;
}

@media(max-width: 650px) {
    table {
        font-size: 13px;
    }

    th, td {
        padding: 8px;
    }

    .hide-mobile {
        display: none;
    }
}
</style>
</head>

<body>

<header>

    <strong>
        <?= htmlspecialchars(Config::$appName) ?>
    </strong>

    <nav>

        <!-- Dashboard -->
        <a href="index.php"
           class="<?= ($active ?? '') === 'home' ? 'active' : '' ?>">
            Dashboard
        </a>

        <!-- Mahasiswa -->
        <a href="index.php?action=mahasiswa"
           class="<?= ($active ?? '') === 'mahasiswa' ? 'active' : '' ?>">
            Mahasiswa
        </a>

        <!-- KRS -->
        <a href="index.php?action=krs"
           class="<?= ($active ?? '') === 'krs' ? 'active' : '' ?>">
            KRS
        </a>

        <!-- Ulasan -->
        <a href="index.php?action=ulasan"
           class="<?= ($active ?? '') === 'ulasan' ? 'active' : '' ?>">
            Ulasan
        </a>

        <!-- About -->
        <a href="index.php?action=about"
           class="<?= ($active ?? '') === 'about' ? 'active' : '' ?>">
            About
        </a>

        <!-- Login dan Logout -->
        <?php if (isset($_SESSION['user'])): ?>

            <span style="padding:9px 12px;color:white;">
                Halo, <?= htmlspecialchars($_SESSION['user']['nama']) ?>
            </span>

            <a href="index.php?action=logout"
               style="background:#dc2626;">
                Logout
            </a>

        <?php else: ?>

            <a href="index.php?action=login"
               style="background:#15803d;">
                Login
            </a>

        <?php endif; ?>

    </nav>

</header>

<main>
