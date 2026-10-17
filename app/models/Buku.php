<?php

class Buku
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Mengambil seluruh data buku
    public function getAll(): array
    {
        $sql = "SELECT * FROM buku ORDER BY id DESC";
        return $this->pdo->query($sql)->fetchAll();
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
                (judul, penulis, penerbit, tahun_terbit, kategori)
                VALUES
                (:judul, :penulis, :penerbit, :tahun_terbit, :kategori)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'judul' => $data['judul'],
            'penulis' => $data['penulis'],
            'penerbit' => $data['penerbit'],
            'tahun_terbit' => $data['tahun_terbit'],
            'kategori' => $data['kategori']
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
                    kategori = :kategori
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'judul' => $data['judul'],
            'penulis' => $data['penulis'],
            'penerbit' => $data['penerbit'],
            'tahun_terbit' => $data['tahun_terbit'],
            'kategori' => $data['kategori']
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
