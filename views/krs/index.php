
<?php
$pageTitle = 'Data KRS';
$active = 'krs';

require __DIR__ . '/../layout/header.php';
?>

<section class="panel">

    <h1>Data Kartu Rencana Studi (KRS)</h1>

    <p class="muted">
        Kelola data pengambilan mata kuliah oleh mahasiswa.
    </p>

    <a class="btn green" href="index.php?action=krs-create">
        + Tambah KRS
    </a>

    <?php if (empty($krs)): ?>

        <p style="margin-top:20px;">
            Belum ada data KRS.
        </p>

    <?php else: ?>

        <div style="overflow-x:auto; margin-top:20px;">

            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Mahasiswa</th>
                        <th>NIM</th>
                        <th>Kode MK</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($krs as $i => $data): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>

                            <td>
                                <?= htmlspecialchars($data['nama_mahasiswa']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['nim']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['kode_mk']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['nama_mk']) ?>
                            </td>

                            <td><?= (int)$data['sks'] ?></td>

                            <td>
                                <?= htmlspecialchars($data['semester']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($data['tahun_ajaran']) ?>
                            </td>

                            <td>
                                <a
                                    class="btn green"
                                    href="index.php?action=krs-edit&id=<?= (int)$data['id'] ?>">
                                    Edit
                                </a>

                                <form
                                    class="inline"
                                    method="POST"
                                    action="index.php?action=krs-delete"
                                    onsubmit="return confirm('Yakin ingin menghapus KRS ini?')">

                                    <input
                                        type="hidden"
                                        name="id"
                                        value="<?= (int)$data['id'] ?>">

                                    <button
                                        type="submit"
                                        class="btn red">
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
