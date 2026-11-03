
<?php require __DIR__ . '/../layout/header.php'; ?>

<section class="panel">
    <h1>Tambah Ulasan</h1>

    <?php if (!empty($error)): ?>
        <div class="alert">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=ulasan-create">

        <div class="field">
            <label>Nama Mahasiswa</label>

            <select name="mahasiswa_id" required>
                <option value="">-- Pilih Mahasiswa --</option>

                <?php foreach ($mahasiswa as $m): ?>
                    <option value="<?= (int)$m['id'] ?>"
                        <?= ((int)($_POST['mahasiswa_id'] ?? 0) === (int)$m['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($m['nim'] . ' - ' . $m['nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="field">
            <label>Rating</label>

            <select name="rating" required>
                <option value="">-- Pilih Rating --</option>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>"
                        <?= (int)($_POST['rating'] ?? 0) === $i ? 'selected' : '' ?>>
                        <?= $i ?> / 5
                    </option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="field">
            <label>Komentar</label>
            <textarea name="komentar" rows="5" required><?= htmlspecialchars($_POST['komentar'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn green">
            Simpan Ulasan
        </button>

        <a href="index.php?action=ulasan" class="btn gray">
            Kembali
        </a>

    </form>
</section>

<?php require __DIR__ . '/../layout/footer.php'; ?>
