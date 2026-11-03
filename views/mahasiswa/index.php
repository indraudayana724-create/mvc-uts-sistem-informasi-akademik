
<?php require __DIR__ . '/../layout/header.php'; ?>

<section class="panel">
    <h1>Data Mahasiswa</h1>

    <p class="muted">
        Kelola data mahasiswa: Create, Read, Update, dan Delete.
    </p>

    <a class="btn green" href="index.php?action=mahasiswa-create">
        + Tambah Mahasiswa
    </a>

    <!-- Form Pencarian -->
    <form method="GET" action="index.php"
          style="margin-top:20px; margin-bottom:20px;">

        <input type="hidden" name="action" value="mahasiswa">

        <input
            type="text"
            name="keyword"
            placeholder="Cari NIM, nama, atau email mahasiswa..."
            value="<?= htmlspecialchars($keyword ?? '') ?>"
            style="padding:10px; width:65%; max-width:400px;
                   border:1px solid #cbd5e1; border-radius:7px;"
        >

        <button type="submit" class="btn">
            Cari
        </button>

        <a class="btn gray" href="index.php?action=mahasiswa">
            Reset
        </a>
    </form>

    <?php if (!$mahasiswa): ?>

        <p>
            <?php if (!empty($keyword)): ?>
                Data mahasiswa dengan kata kunci
                <strong><?= htmlspecialchars($keyword) ?></strong>
                tidak ditemukan.
            <?php else: ?>
                Belum ada data. Klik “Tambah Mahasiswa” untuk mulai.
            <?php endif; ?>
        </p>

    <?php else: ?>

        <div style="overflow-x:auto">
            <table>
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th class="hide-mobile">Email</th>
                        <th>Program Studi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($mahasiswa as $m): ?>
                        <tr>
                            <td>
                                <?= htmlspecialchars($m['nim']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($m['nama']) ?>
                            </td>

                            <td class="hide-mobile">
                                <?= htmlspecialchars($m['email'] ?? '-') ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($m['nama_prodi'] ?? '-') ?>
                            </td>

                            <td style="white-space:nowrap">

                                <a class="btn"
                                   href="index.php?action=mahasiswa-edit&id=<?= (int)$m['id'] ?>">
                                    Edit
                                </a>

                                <form class="inline"
                                      method="post"
                                      action="index.php?action=mahasiswa-delete"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                    <input type="hidden" name="id"
                                           value="<?= (int)$m['id'] ?>">

                                    <button class="btn red" type="submit">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php endif; ?>

</section>

<?php require __DIR__ . '/../layout/footer.php'; ?>
