<?php
/** @var array $buku */
/** @var array|null $status */
/** @var string $keyword */
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Buku | MVC Data Buku</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 30px;
            color: #222;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 3px 12px #00000010;
        }

        h1 {
            margin-top: 0;
        }

        .btn {
            display: inline-block;
            padding: 9px 12px;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 13px;
            margin: 2px;
        }

        .primary {
            background: #2563eb;
        }

        .detail {
            background: #0891b2;
        }

        .edit {
            background: #d97706;
        }

        .delete {
            background: #dc2626;
        }

        .notice {
            padding: 12px 15px;
            margin: 18px 0;
            border-radius: 5px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Form pencarian */
        .search-form {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .search-input {
            flex: 1;
            min-width: 200px;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 5px;
            font-size: 14px;
        }

        .search-input:focus {
            outline: 2px solid #93c5fd;
            border-color: #2563eb;
        }

        .secondary {
            background: #64748b;
        }

        .result-info {
            margin-top: 18px;
            color: #555;
            font-size: 14px;
        }

        .table-wrapper {
            overflow-x: auto;
            margin-top: 20px;
        }

        table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #eff6ff;
        }

        .empty {
            text-align: center;
            padding: 25px;
            color: #666;
        }

        .actions {
            white-space: nowrap;
        }

        .delete-form {
            display: inline;
        }

        @media (max-width: 600px) {
            body {
                padding: 12px;
            }

            .container {
                padding: 16px;
            }

            .search-input {
                min-width: 100%;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Data Buku</h1>
    <p>Kelola dan cari data buku melalui aplikasi MVC Data Buku.</p>

    <a href="index.php?action=create" class="btn primary">
        + Tambah Buku
    </a>

    <!-- Form pencarian buku -->
    <form action="index.php" method="GET" class="search-form">
        <input
            type="hidden"
            name="action"
            value="index"
        >

        <input
            type="search"
            name="keyword"
            class="search-input"
            placeholder="Cari berdasarkan judul atau penulis..."
            value="<?= htmlspecialchars(
                $keyword ?? '',
                ENT_QUOTES,
                'UTF-8'
            ) ?>"
            aria-label="Cari berdasarkan judul atau penulis"
        >

        <button type="submit" class="btn primary">
            Cari
        </button>

        <?php if (!empty($keyword)): ?>
            <a href="index.php" class="btn secondary">
                Reset
            </a>
        <?php endif; ?>
    </form>

    <!-- Notifikasi hasil operasi -->
    <?php if ($status): ?>
        <?php if (($status['type'] ?? '') === 'success'): ?>
            <div class="notice success"
                 role="status"
                 aria-live="polite">
                <?= htmlspecialchars(
                    $status['message'] ?? '',
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </div>
        <?php else: ?>
            <div class="notice error"
                 role="alert"
                 aria-live="assertive">
                <?= htmlspecialchars(
                    $status['message'] ?? '',
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <!-- Informasi hasil pencarian -->
    <?php if (!empty($keyword)): ?>
        <p class="result-info">
            Hasil pencarian untuk
            <strong>
                "<?= htmlspecialchars(
                    $keyword,
                    ENT_QUOTES,
                    'UTF-8'
                ) ?>"
            </strong>:
            <?= count($buku) ?> buku ditemukan.
        </p>
    <?php endif; ?>

    <!-- Tabel data buku -->
    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
            <?php if (empty($buku)): ?>
                <tr>
                    <td colspan="7" class="empty">
                        <?php if (!empty($keyword)): ?>
                            Buku tidak ditemukan. Coba kata kunci lain.
                        <?php else: ?>
                            Belum ada data buku.
                        <?php endif; ?>
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($buku as $i => $item): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>

                        <td>
                            <?= htmlspecialchars(
                                $item['judul'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $item['penulis'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $item['penerbit'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                (string) $item['tahun_terbit'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </td>

                        <td>
                            <?= htmlspecialchars(
                                $item['kategori'],
                                ENT_QUOTES,
                                'UTF-8'
                            ) ?>
                        </td>

                        <td class="actions">
                            <a
                                class="btn detail"
                                href="index.php?action=detail&id=<?= (int) $item['id'] ?>"
                            >
                                Detail
                            </a>

                            <a
                                class="btn edit"
                                href="index.php?action=edit&id=<?= (int) $item['id'] ?>"
                            >
                                Edit
                            </a>

                            <form
                                class="delete-form"
                                action="index.php?action=delete"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus buku ini?')"
                            >
                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int) $item['id'] ?>"
                                >

                                <button
                                    type="submit"
                                    class="btn delete"
                                >
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
</body>
</html>
