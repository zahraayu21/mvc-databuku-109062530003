<?php
/** @var array $data */
/** @var array $errors */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f4f6f9; padding: 30px; }
        .container { max-width: 650px; margin: auto; padding: 28px; background: white; border-radius: 10px; }
        label { display: block; margin: 16px 0 7px; font-weight: bold; }
        input { width: 100%; padding: 11px; border: 1px solid #ccc; border-radius: 5px; font-size: 15px; }
        .btn { display: inline-block; margin-top: 22px; padding: 11px 16px; border: 0; border-radius: 5px; background: #2563eb; color: white; text-decoration: none; cursor: pointer; }
        .secondary { background: #64748b; }
        .error { padding: 12px; background: #fee2e2; color: #991b1b; border-radius: 5px; }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Buku</h1>
    <p>Perbarui informasi buku di bawah ini.</p>

    <?php if ($errors): ?>
        <div class="error">
            <strong>Periksa kembali data:</strong>
            <ul>
                <?php foreach ($errors as $message): ?>
                    <li><?= htmlspecialchars($message) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="index.php?action=edit&id=<?= (int) $data['id'] ?>"
          method="POST">

        <label for="judul">Judul Buku</label>
        <input id="judul" name="judul" maxlength="150" required
               value="<?= htmlspecialchars($data['judul']) ?>">

        <label for="penulis">Penulis</label>
        <input id="penulis" name="penulis" maxlength="100" required
               value="<?= htmlspecialchars($data['penulis']) ?>">

        <label for="penerbit">Penerbit</label>
        <input id="penerbit" name="penerbit" maxlength="100" required
               value="<?= htmlspecialchars($data['penerbit']) ?>">

        <label for="tahun_terbit">Tahun Terbit</label>
        <input type="number" id="tahun_terbit" name="tahun_terbit"
               min="1901" max="<?= date('Y') ?>" required
               value="<?= htmlspecialchars((string) $data['tahun_terbit']) ?>">

        <label for="kategori">Kategori</label>
        <input id="kategori" name="kategori" maxlength="50" required
               value="<?= htmlspecialchars($data['kategori']) ?>">

        <label for="stok">Stok Buku</label>
        <input type="number" id="stok" name="stok"
               min="0" step="1" required
               value="<?= htmlspecialchars((string) ($data['stok'] ?? '0')) ?>">

        <button type="submit" class="btn">Simpan Perubahan</button>
        <a href="index.php" class="btn secondary">Batal</a>
    </form>
</div>
</body>
</html>
