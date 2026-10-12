# Tugas Rutin 11 — E-Commerce DB + Secure Auth

Aplikasi Laravel 12 dengan Laravel Breeze (Blade), katalog dan CRUD produk, relasi e-commerce, serta otorisasi tiga peran.

## Menjalankan aplikasi

Persyaratan: PHP 8.2+, Composer, dan ekstensi PHP PDO SQLite (atau driver database yang dipilih pada `.env`). Tampilan menggunakan CSS statis, sehingga Node.js tidak diperlukan untuk menjalankan aplikasi.

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Seeder membuat akun lokal berikut dengan kata sandi `password`:

| Peran | Email |
| --- | --- |
| Admin | `admin@shop.test` |
| Editor | `editor@shop.test` |
| User | `user@shop.test` |

Ganti kata sandi demo dan konfigurasi database sebelum aplikasi dipakai di lingkungan nyata. Pendaftaran Breeze hanya dapat membuat akun dengan peran `user`; peran tidak diterima dari input publik.

## Struktur database

Tujuh tabel domain: `users`, `categories`, `products`, `carts`, `cart_items`, `orders`, dan `order_items`. Foreign key memakai aturan hapus yang eksplisit agar produk yang sudah digunakan dalam pesanan tidak terhapus tanpa sengaja. Seeder menyiapkan enam kategori dan 60 produk melalui factory.

## Peran dan keamanan

- `admin`: membuat, mengubah, dan menghapus semua produk.
- `editor`: membuat produk serta mengubah/menghapus hanya produk yang dibuatnya.
- `user`: mengakses dashboard dan katalog, tanpa akses pengelolaan produk.
- Middleware `role` melindungi `/admin/products`; `ProductPolicy` memeriksa izin create, update, delete, dan melihat produk nonaktif.
- Formulir menggunakan validasi Laravel, CSRF, dan method spoofing Breeze.

## Pengujian dan bukti Tinker

```powershell
php artisan test
php artisan tinker
```

Jalankan lima query pada [docs/tinker-queries.md](./docs/tinker-queries.md) satu per satu dan ambil screenshot hasil Tinker untuk bukti tugas.
