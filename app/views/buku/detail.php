<?php
/** @var array $buku */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f9; padding: 30px; color: #222; }
        .container { max-width: 650px; margin: auto; padding: 28px; background: white; border-radius: 10px; }
        .item { padding: 14px 0; border-bottom: 1px solid #e5e7eb; }
        .label { display: block; font-weight: bold; margin-bottom: 6px; }
        .btn { display: inline-block; margin-top: 22px; padding: 11px 16px; background: #2563eb; color: white; text-decoration: none; border-radius: 5px; }
        .secondary { background: #64748b; }
    </style>
</head>
<body>
<div class="container">
    <h1>Detail Buku</h1>

    <div class="item">
        <span class="label">Judul Buku</span>
        <?= htmlspecialchars($buku['judul']) ?>
    </div>

    <div class="item">
        <span class="label">Penulis</span>
        <?= htmlspecialchars($buku['penulis']) ?>
    </div>

    <div class="item">
        <span class="label">Penerbit</span>
        <?= htmlspecialchars($buku['penerbit']) ?>
    </div>

    <div class="item">
        <span class="label">Tahun Terbit</span>
        <?= htmlspecialchars((string) $buku['tahun_terbit']) ?>
    </div>

    <div class="item">
        <span class="label">Kategori</span>
        <?= htmlspecialchars($buku['kategori']) ?>
    </div>

    <a class="btn"
       href="index.php?action=edit&id=<?= (int) $buku['id'] ?>">
        Edit Buku
    </a>

    <a class="btn secondary" href="index.php">
        Kembali
    </a>
</div>
</body>
</html>
