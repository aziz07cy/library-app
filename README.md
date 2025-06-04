# APLIKASI PERPUSTAKAAN :

1. ✅ login
2. ✅ ⁠Menu master :

-   Anggota (no anggota, tanggal lahir, nama, stock)
-   ⁠Buku (judul buku, penerbit, dimensi, stock)

3. ✅ Menu Transaksi :

-   Peminjaman (tanggal pinjam, anggota yang meminjam, buku yang dipinjam)
-   Pengembalian (buku yang dipinjam, tanggal kembali)

4. ✅ Dashboard :

-   rekap peminjaman perminggu dalam bentuk grafik

## Setelah project di clone, gunakan CMD pada directory kemudian jalankan

-   `composer install` dan `npm install`
-   copy-paste _.env.example_ menjadi _.env_
-   membuat database (jika belum ada) sesuai dengan konfigurasi pada _.env.example_
-   `php artisan key:generate`
-   `php artisan migrate --seed` mohon gunakan seeder untuk menampilkan chart dengan baik
-   `php artisan serve`
-   buat jendela CMD baru dan jalankan `npm run dev`
-   buka web browser dan masuk ke http://localhost:8000 kemudian login dengan email = _test@example.com_ dan password _password_

## Catatan

1. pada windows OS direkomendasikan menggunakan aplikasi `laragon`
2. memastikan versi PHP 8.4 atau lebih, composer 2.8.6 ata lebih dan node v22 atau lebih
3. memastikan local serve dan compile berjalan `php artisan serve` dan `npm run dev`
4. memastikan MySQL berjalan
5. jika port _8000_ telah digunakan mohon konfigurasikan
