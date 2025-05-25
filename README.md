# web-kasir
Final Project UAS - Basis Data &amp; Desain Pemrograman Web

# Web Kasir Admin Panel

Aplikasi kasir berbasis web (PHP) untuk mengelola produk, pelanggan, pesanan, dan admin. Dirancang dengan struktur folder rapi dan mudah dikembangkan secara tim.

## Struktur Folder

```
web-kasir/
├── login.php
├── logout.php
├── registrasi.php
├── README.md
├── config/
│   ├── dbcon.php
│   ├── auth.php
│   ├── functions-produk.php
│   ├── functions-pelanggan.php
│   ├── hapus-produk.php
│   ├── hapus-pelanggan.php
├── admin/
│   ├── index.php
│   ├── list-produk.php
│   ├── tambah-produk.php
│   ├── edit-produk.php
│   ├── list-pelanggan.php
│   ├── tambah-pelanggan.php
│   ├── edit-pelanggan.php
│   ├── list-admin.php
│   ├── buat-pesanan.php
│   ├── pesanan.php
│   ├── assets/
│   │   ├── css/
│   │   ├── js/
│   │   ├── img/
│   │   └── ajax/
│   └── includes/
│       ├── header.php
│       ├── footer.php
│       ├── navbar.php
│       └── sidebar.php
├── includes/
│   ├── header.php
│   ├── footer.php
│   └── scripts.php
├── js/
│   └── sweetalert2@11.js
├── sql/
└── .gitignore
```

## Fitur Utama
- Login & registrasi admin
- CRUD produk (tambah, edit, hapus, cari)
- CRUD pelanggan
- CRUD pesanan
- Manajemen admin
- Upload gambar produk
- Sidebar & navbar dinamis

## Cara Instalasi
1. Clone repo ini
2. Import database dari folder `sql/` (jika ada)
3. Atur koneksi database di `config/dbcon.php`
4. Jalankan di localhost (XAMPP/Laragon)

## Kontribusi
- Pull request & issue welcome!
- Ikuti standar penamaan dan struktur folder

---

> Dibuat untuk pembelajaran dan pengembangan aplikasi kasir berbasis web.
