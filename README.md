# MVC Data Buku

Aplikasi pengelolaan data buku berbasis PHP Native yang menerapkan konsep Model-View-Controller (MVC) dan menggunakan MySQL/MariaDB sebagai database.

## Deskripsi Proyek

Proyek ini dibuat untuk memenuhi tugas penerapan konsep MVC pada PHP Native dengan workflow Git. Aplikasi digunakan untuk mengelola data buku melalui fitur tambah, lihat, ubah, dan hapus data.

## Teknologi yang Digunakan

- PHP Native
- MySQL/MariaDB
- PDO (PHP Data Objects)
- HTML dan CSS
- Git

## Fitur Aplikasi

- Menampilkan daftar buku.
- Menambahkan data buku.
- Melihat detail buku.
- Mengubah data buku.
- Menghapus data buku.
- Memvalidasi kolom wajib.
- Memvalidasi panjang teks dan tahun terbit.
- Menampilkan notifikasi hasil operasi.

## Struktur Folder

```text
mvc-databuku-109062530003/
├── app/
│   ├── controllers/
│   │   └── BukuController.php
│   ├── models/
│   │   └── Buku.php
│   └── views/
│       └── buku/
│           ├── create.php
│           ├── detail.php
│           ├── edit.php
│           └── index.php
├── config/
│   └── database.php
├── database/
│   └── buku.sql
├── public/
│   └── index.php
├── .gitignore
└── README.md
```

## Penerapan MVC

### Model

File `app/models/Buku.php` bertanggung jawab atas interaksi dengan basis data, termasuk mengambil, menambahkan, mengubah, dan menghapus data buku.

### View

Folder `app/views/buku/` berisi halaman antarmuka untuk menampilkan daftar buku, detail buku, serta formulir tambah dan edit.

### Controller

File `app/controllers/BukuController.php` mengatur alur aplikasi, memproses permintaan pengguna, menjalankan validasi, dan menghubungkan Model dengan View.

## Struktur Data Buku

Tabel `buku` memiliki atribut berikut:

| Atribut | Keterangan |
|---|---|
| id | ID buku sebagai primary key |
| judul | Judul buku |
| penulis | Nama penulis |
| penerbit | Nama penerbit |
| tahun_terbit | Tahun penerbitan buku |
| kategori | Kategori buku |

## Cara Menjalankan Aplikasi

1. Pastikan Apache dan MySQL/MariaDB sudah berjalan melalui XAMPP.
2. Buat database dengan menjalankan skrip `database/buku.sql`.
3. Sesuaikan konfigurasi koneksi pada `config/database.php`.
4. Pastikan ekstensi PDO MySQL pada PHP sudah aktif.
5. Buka aplikasi melalui browser:

   http://localhost/mvc-databuku-109062530003/public/

## Validasi dan Keamanan

- Menggunakan prepared statements melalui PDO untuk operasi basis data.
- Memvalidasi kolom wajib sebelum menyimpan data.
- Memvalidasi panjang teks sesuai batas kolom basis data.
- Memvalidasi tahun terbit.
- Menggunakan `htmlspecialchars()` untuk membantu mencegah eksekusi HTML yang tidak diinginkan pada data yang ditampilkan.
- Menggunakan metode POST untuk permintaan penghapusan data.

## Workflow Git

Riwayat perubahan proyek dikelola menggunakan Git dengan pesan commit yang menjelaskan perubahan. Riwayat commit dapat diperiksa menggunakan perintah:

```bash
git log --oneline --graph --decorate
```

## Pengembang

Nama: Zahra Ayu Diningtyas  
NIM: 109062530003  
Program Studi: Sistem Informasi
