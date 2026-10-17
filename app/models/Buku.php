<?php

class Buku
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Mengambil seluruh data buku dengan pengurutan
    public function getAll(string $sort = 'terbaru'): array
    {
        $orderBy = $this->getOrderBy($sort);

        $sql = "SELECT * FROM buku ORDER BY $orderBy";

        return $this->pdo->query($sql)->fetchAll();
    }

    // Mencari buku berdasarkan judul atau penulis
    public function search(string $keyword, string $sort = 'terbaru'): array
    {
        $orderBy = $this->getOrderBy($sort);

        $sql = "SELECT * FROM buku
                WHERE judul LIKE :judul
                   OR penulis LIKE :penulis
                ORDER BY $orderBy";

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            'judul' => '%' . $keyword . '%',
            'penulis' => '%' . $keyword . '%'
        ]);

        return $stmt->fetchAll();
    }

    // Menentukan pengurutan yang diizinkan
    private function getOrderBy(string $sort): string
    {
        $orders = [
            'terbaru' => 'id DESC',
            'judul_asc' => 'judul ASC, id DESC',
            'judul_desc' => 'judul DESC, id DESC',
            'tahun_desc' => 'tahun_terbit DESC, id DESC',
            'tahun_asc' => 'tahun_terbit ASC, id DESC'
        ];

        return $orders[$sort] ?? $orders['terbaru'];
    }

    // Mengambil satu buku berdasarkan ID
    public function getById(int $id): array|false
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM buku WHERE id = :id"
        );

        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }

    // Menambahkan buku
    public function create(array $data): bool
    {
        $sql = "INSERT INTO buku
                (judul, penulis, penerbit, tahun_terbit, kategori, stok)
                VALUES
                (:judul, :penulis, :penerbit, :tahun_terbit, :kategori, :stok)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'judul' => $data['judul'],
            'penulis' => $data['penulis'],
            'penerbit' => $data['penerbit'],
            'tahun_terbit' => $data['tahun_terbit'],
            'kategori' => $data['kategori'],
            'stok' => $data['stok']
        ]);
    }

    // Memperbarui buku
    public function update(int $id, array $data): bool
    {
        $sql = "UPDATE buku SET
                    judul = :judul,
                    penulis = :penulis,
                    penerbit = :penerbit,
                    tahun_terbit = :tahun_terbit,
                    kategori = :kategori,
                    stok = :stok
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'judul' => $data['judul'],
            'penulis' => $data['penulis'],
            'penerbit' => $data['penerbit'],
            'tahun_terbit' => $data['tahun_terbit'],
            'kategori' => $data['kategori'],
            'stok' => $data['stok']
        ]);
    }

    // Menghapus buku
    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM buku WHERE id = :id"
        );

        $stmt->execute(['id' => $id]);

        return $stmt->rowCount() > 0;
    }
}
