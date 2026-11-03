
<?php require __DIR__ . '/../layout/header.php'; ?>

<section class="panel">
    <h1>Ulasan Mahasiswa</h1>

    <p class="muted">
        Daftar penilaian dan komentar mahasiswa terhadap layanan akademik.
    </p>

    <!-- Tombol Tambah Ulasan -->
    <a class="btn green" href="index.php?action=ulasan-create">
        + Tambah Ulasan
    </a>

    <?php if (empty($ulasan)): ?>

        <p>Belum ada ulasan yang tersedia.</p>

    <?php else: ?>

        <div style="overflow-x:auto">
            <table>
                <thead>
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>NIM</th>
                        <th>Rating</th>
                        <th>Komentar</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($ulasan as $u): ?>
                        <tr>
                            <td>
                                <?= htmlspecialchars($u['nama']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($u['nim']) ?>
                            </td>

                            <td>
                                <?= (int)$u['rating'] ?> / 5
                            </td>

                            <td>
                                <?= htmlspecialchars($u['komentar']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($u['created_at']) ?>
                            </td>

                            <td>
                                <!-- Tombol Edit -->
                                <a class="btn green"
                                   href="index.php?action=ulasan-edit&id=<?= (int)$u['id'] ?>">
                                    Edit
                                </a>

                                <!-- Tombol Hapus -->
                                <form method="POST"
                                      action="index.php?action=ulasan-delete"
                                      onsubmit="return confirm('Hapus ulasan ini?')">

                                    <input type="hidden"
                                           name="id"
                                           value="<?= (int)$u['id'] ?>">

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
