<?php

require_once __DIR__ . '/../models/Buku.php';

class BukuController
{
    private Buku $model;

    public function __construct(PDO $pdo)
    {
        $this->model = new Buku($pdo);
    }

    // Menampilkan seluruh data buku
    public function index(): void
    {
        $buku = $this->model->getAll();

        $status = $_SESSION['status'] ?? null;
        unset($_SESSION['status']);

        require __DIR__ . '/../views/buku/index.php';
    }

    // Menampilkan detail buku
    public function detail(int $id): void
    {
        $buku = $this->model->getById($id);

        if (!$buku) {
            http_response_code(404);
            exit('Data buku tidak ditemukan.');
        }

        require __DIR__ . '/../views/buku/detail.php';
    }

    // Menambahkan buku baru
    public function create(): void
    {
        $data = [
            'judul' => '',
            'penulis' => '',
            'penerbit' => '',
            'tahun_terbit' => '',
            'kategori' => ''
        ];

        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getInputData();
            $errors = $this->validate($data);

            if (empty($errors)) {
                try {
                    $this->model->create($data);

                    $_SESSION['status'] = [
                        'type' => 'success',
                        'message' => 'Buku berhasil ditambahkan.'
                    ];

                    header('Location: index.php');
                    exit;
                } catch (PDOException $e) {
                    error_log($e->getMessage());

                    $errors['database'] =
                        'Buku gagal ditambahkan. Silakan coba lagi.';
                }
            }
        }

        require __DIR__ . '/../views/buku/create.php';
    }

    // Mengubah data buku
    public function edit(int $id): void
    {
        $buku = $this->model->getById($id);

        if (!$buku) {
            http_response_code(404);
            exit('Data buku tidak ditemukan.');
        }

        $data = $buku;
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->getInputData();
            $errors = $this->validate($data);

            if (empty($errors)) {
                try {
                    $this->model->update($id, $data);

                    $_SESSION['status'] = [
                        'type' => 'success',
                        'message' => 'Data buku berhasil diperbarui.'
                    ];

                    header('Location: index.php');
                    exit;
                } catch (PDOException $e) {
                    error_log($e->getMessage());

                    $errors['database'] =
                        'Buku gagal diperbarui. Silakan coba lagi.';
                }
            }
        }

        require __DIR__ . '/../views/buku/edit.php';
    }

    // Menghapus data buku
    public function delete(int $id): void
    {
        try {
            if (!$this->model->delete($id)) {
                $_SESSION['status'] = [
                    'type' => 'error',
                    'message' => 'Buku tidak ditemukan atau sudah dihapus.'
                ];
            } else {
                $_SESSION['status'] = [
                    'type' => 'success',
                    'message' => 'Buku berhasil dihapus.'
                ];
            }
        } catch (PDOException $e) {
            error_log($e->getMessage());

            $_SESSION['status'] = [
                'type' => 'error',
                'message' => 'Buku gagal dihapus.'
            ];
        }

        header('Location: index.php');
        exit;
    }

    // Mengambil input dari formulir
    private function getInputData(): array
    {
        return [
            'judul' => trim($_POST['judul'] ?? ''),
            'penulis' => trim($_POST['penulis'] ?? ''),
            'penerbit' => trim($_POST['penerbit'] ?? ''),
            'tahun_terbit' => trim($_POST['tahun_terbit'] ?? ''),
            'kategori' => trim($_POST['kategori'] ?? '')
        ];
    }

    // Memvalidasi data buku
    private function validate(array $data): array
    {
        $errors = [];

        // Memastikan semua kolom wajib diisi
        foreach ($data as $field => $value) {
            if ($value === '') {
                $errors[$field] = 'Kolom ini wajib diisi.';
            }
        }

        // Memastikan panjang teks sesuai struktur database
        $batasPanjang = [
            'judul' => 150,
            'penulis' => 100,
            'penerbit' => 100,
            'kategori' => 50
        ];

        foreach ($batasPanjang as $field => $batas) {
            if (
                isset($data[$field]) &&
                $data[$field] !== '' &&
                mb_strlen($data[$field]) > $batas
            ) {
                $errors[$field] = "Maksimal $batas karakter.";
            }
        }

        // Memvalidasi tahun terbit
        $tahun = $data['tahun_terbit'];
        $tahunSekarang = (int) date('Y');

        if (
            $tahun !== '' &&
            (
                !ctype_digit($tahun) ||
                (int) $tahun < 1901 ||
                (int) $tahun > $tahunSekarang
            )
        ) {
            $errors['tahun_terbit'] =
                'Tahun terbit harus antara 1901 dan ' .
                $tahunSekarang . '.';
        }

        return $errors;
    }
}
