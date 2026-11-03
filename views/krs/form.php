<?php

require __DIR__ . '/../layout/header.php';

$isEdit = isset($krs['id']);

?>

<section class="panel">

    <h1>
        <?= $isEdit ? 'Edit Data KRS' : 'Tambah Data KRS' ?>
    </h1>

    <p class="muted">
        <?= $isEdit
            ? 'Ubah informasi Kartu Rencana Studi mahasiswa.'
            : 'Masukkan informasi Kartu Rencana Studi mahasiswa.' ?>
    </p>

    <?php if (!empty($error)): ?>
        <div class="alert">
            <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <form
        method="POST"
        action="index.php?action=<?= $isEdit ? 'krs-update' : 'krs-create' ?>">

        <?php if ($isEdit): ?>
            <input
                type="hidden"
                name="id"
                value="<?= (int)$krs['id'] ?>">
        <?php endif; ?>

        <!-- MAHASISWA -->
        <div class="field">

            <label>Nama Mahasiswa</label>

            <select name="mahasiswa_id" required>

                <option value="">-- Pilih Mahasiswa --</option>

                <?php foreach ($mahasiswa as $m): ?>

                    <option
                        value="<?= (int)$m['id'] ?>"
                        <?= (string)($krs['mahasiswa_id'] ?? '') === (string)$m['id']
                            ? 'selected'
                            : '' ?>>

                        <?= htmlspecialchars(
                            $m['nim'] . ' - ' . $m['nama'],
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>

                    </option>

                <?php endforeach; ?>

            </select>

            <?php if (empty($mahasiswa)): ?>
                <small>Belum ada data mahasiswa.</small>
            <?php endif; ?>

        </div>

        <!-- MATA KULIAH -->
        <div class="field">

            <label>Mata Kuliah</label>

            <select name="mata_kuliah_id" required>

                <option value="">-- Pilih Mata Kuliah --</option>

                <?php foreach ($mataKuliah as $mk): ?>

                    <option
                        value="<?= (int)$mk['id'] ?>"
                        <?= (string)($krs['mata_kuliah_id'] ?? '') === (string)$mk['id']
                            ? 'selected'
                            : '' ?>>

                        <?= htmlspecialchars(
                            $mk['kode_mk'] . ' - ' .
                            $mk['nama_mk'] . ' (' .
                            $mk['sks'] . ' SKS)',
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>

                    </option>

                <?php endforeach; ?>

            </select>

            <?php if (empty($mataKuliah)): ?>
                <small>Belum ada data mata kuliah.</small>
            <?php endif; ?>

        </div>

        <!-- SEMESTER -->
        <div class="field">

            <label>Semester</label>

            <select name="semester" required>

                <option value="">-- Pilih Semester --</option>

                <option
                    value="Ganjil"
                    <?= ($krs['semester'] ?? '') === 'Ganjil'
                        ? 'selected'
                        : '' ?>>

                    Semester Ganjil

                </option>

                <option
                    value="Genap"
                    <?= ($krs['semester'] ?? '') === 'Genap'
                        ? 'selected'
                        : '' ?>>

                    Semester Genap

                </option>

            </select>

        </div>

        <!-- TAHUN AJARAN -->
        <div class="field">

            <label>Tahun Ajaran</label>

            <input
                type="text"
                name="tahun_ajaran"
                placeholder="Contoh: 2026/2027"
                value="<?= htmlspecialchars(
                    $krs['tahun_ajaran'] ?? '',
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>"
                maxlength="20"
                required>

        </div>

        <!-- TOMBOL -->
        <button type="submit" class="btn green">

            <?= $isEdit ? 'Simpan Perubahan' : 'Simpan KRS' ?>

        </button>

        <a href="index.php?action=krs" class="btn gray">
            Kembali
        </a>

    </form>

</section>

<?php require __DIR__ . '/../layout/footer.php'; ?>