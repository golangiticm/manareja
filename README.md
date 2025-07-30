<p align="center"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Manareja Logo"></p>

<p align="center">
<a href="#"><img src="https://img.shields.io/badge/build-passing-brightgreen" alt="Build Status"></a>
<a href="#"><img src="https://img.shields.io/badge/license-MIT-blue" alt="License"></a>
</p>

## Manareja

Manareja adalah sebuah aplikasi manajemen restoran berbasis web yang dibangun menggunakan Laravel. Proyek ini bertujuan untuk memudahkan pengelolaan menu, pesanan, stok, dan laporan keuangan restoran secara efisien dan terintegrasi.

### Fitur Utama

- **Manajemen Menu:** Tambah, edit, dan hapus menu makanan/minuman.
- **Manajemen Pesanan:** Kelola pesanan pelanggan secara real-time.
- **Manajemen Stok:** Pantau dan update stok bahan baku.
- **Laporan Keuangan:** Lihat laporan penjualan dan pengeluaran.
- **Manajemen User:** Hak akses admin, kasir, dan dapur.

## Instalasi

1. Clone repository:
    ```bash
    git clone https://github.com/username/manareja.git
    ```
2. Install dependencies:
    ```bash
    composer install
    npm install
    ```
3. Copy file `.env.example` ke `.env` dan sesuaikan konfigurasi database.
4. Generate key aplikasi:
    ```bash
    php artisan key:generate
    ```
5. Jalankan migrasi dan seeder:
    ```bash
    php artisan migrate --seed
    ```
6. Jalankan aplikasi:
    ```bash
    php artisan serve
    ```

## Dokumentasi

Dokumentasi lengkap tersedia di folder `docs/` atau kunjungi [Wiki Manareja](#).

## Kontribusi

Kontribusi sangat terbuka! Silakan buat pull request atau buka issue untuk perbaikan dan penambahan fitur.

## License

Manareja menggunakan lisensi [MIT](https://opensource.org/licenses/MIT).

