<?php
/** @var array $buku */
/** @var array|null $status */
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

        form {
            display: inline;
        }

        @media (max-width: 600px) {
            body {
                padding: 12px;
            }

            .container {
                padding: 16px;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <h1>Data Buku</h1>
    <p>Kelola data buku melalui aplikasi MVC Data Buku.</p>

    <a href="index.php?action=create" class="btn primary">
        + Tambah Buku
    </a>

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
                        Belum ada data buku.
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

                        <td>
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
