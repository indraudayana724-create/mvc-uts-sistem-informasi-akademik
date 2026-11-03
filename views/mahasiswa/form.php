<?php require __DIR__ . '/../layout/header.php'; ?>
<section class="panel">
<h1><?= htmlspecialchars($pageTitle) ?></h1>
<?php if ($error): ?><div class="alert"><?= htmlspecialchars($error) ?></div><?php endif; ?>
<form method="post" action="<?= isset($_GET['id']) ? 'index.php?action=mahasiswa-edit&id='.(int)$_GET['id'] : 'index.php?action=mahasiswa-create' ?>">
<div class="field"><label for="nim">NIM *</label><input id="nim" name="nim" required maxlength="30" value="<?= htmlspecialchars($row['nim'] ?? '') ?>"></div>
<div class="field"><label for="nama">Nama lengkap *</label><input id="nama" name="nama" required maxlength="100" value="<?= htmlspecialchars($row['nama'] ?? '') ?>"></div>
<div class="field"><label for="email">Email</label><input id="email" type="email" name="email" value="<?= htmlspecialchars($row['email'] ?? '') ?>"></div>
<div class="field"><label for="jenis_kelamin">Jenis kelamin</label><select id="jenis_kelamin" name="jenis_kelamin">
<option value="L" <?= ($row['jenis_kelamin'] ?? 'L')==='L'?'selected':'' ?>>Laki-laki</option>
<option value="P" <?= ($row['jenis_kelamin'] ?? '')==='P'?'selected':'' ?>>Perempuan</option></select></div>
<div class="field"><label for="prodi_id">Program studi</label><select id="prodi_id" name="prodi_id"><option value="">-- Pilih program studi --</option>
<?php foreach ($programs as $p): ?><option value="<?= (int)$p['id'] ?>" <?= (string)($row['prodi_id'] ?? '')===(string)$p['id']?'selected':'' ?>><?= htmlspecialchars($p['nama_prodi']) ?></option><?php endforeach; ?>
</select></div>
<button class="btn green" type="submit">Simpan</button>
<a class="btn gray" href="index.php?action=mahasiswa">Batal</a>
</form>
</section>
<?php require __DIR__ . '/../layout/footer.php'; ?>
