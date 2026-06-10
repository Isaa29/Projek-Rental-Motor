Panduan Instalasi dan Menjalankan Website Rental Motor Jaya

Rental Motor Jaya merupakan website penyewaan motor berbasis Laravel yang digunakan untuk mempermudah proses rental motor secara online. Sistem ini memiliki dua jenis pengguna, yaitu admin dan customer. Admin dapat mengelola data motor, transaksi, customer, dan laporan. Customer dapat melihat daftar motor, melakukan penyewaan, mengunggah bukti pembayaran, serta melihat riwayat transaksi.

Sebelum menjalankan website, pastikan perangkat sudah terinstal:

PHP
Composer
MySQL
Laragon/XAMPP
Git
Browser (Chrome, Edge, Firefox, dan lain-lain)

Aktifkan terlebih dahulu web server dan database. Jika menggunakan Laragon, klik Start All.

1. Clone Repository dari GitHub

Masuk ke folder yang telah dibuat kemudian clone repository:

git clone https://github.com/username/Projek-Rental-Motor.git

Setelah selesai masuk ke folder project:

cd Projek-Rental-Motor

Pastikan sudah terdapat file seperti:

artisan
composer.json
app
routes
public
resources

Jika file tersebut sudah ada, berarti project berhasil di-clone.

2. Install Dependency Laravel

Jalankan perintah berikut:
composer install

Jika berhasil maka akan muncul folder:
vendor,

3. Generate Application Key

Jalankan:
php artisan key:generate

Jika berhasil akan muncul pesan:
Application key set successfully.

4. Membuat Database

Buka phpMyAdmin melalui browser:
http://localhost/phpmyadmin

Kemudian:
Klik menu Database
Buat database baru dengan nama:
rental_motor
Klik Create

Pastikan database berhasil dibuat.

5. Konfigurasi Database

Buka file .env yang sudah tersedia pada project Laravel, kemudian sesuaikan bagian database:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rental_motor
DB_USERNAME=root
DB_PASSWORD=

Sesuaikan username dan password dengan konfigurasi MySQL yang digunakan.

6. Migrasi Database dan Seeder

Jalankan perintah:
php artisan migrate --seed

Perintah ini digunakan untuk membuat seluruh tabel database sekaligus mengisi data awal yang diperlukan sistem.

7. Membuat Storage Link

Agar file bukti pembayaran dapat ditampilkan pada website, jalankan:
php artisan storage:link

8. Membersihkan Cache Laravel

Jalankan:
php artisan optimize:clear

Perintah ini digunakan untuk membersihkan cache aplikasi sehingga perubahan konfigurasi dapat terbaca dengan baik.

9. Menjalankan Server Laravel

Jalankan:
php artisan serve

Jika berhasil akan muncul alamat:
http://127.0.0.1:8000

10. Membuka Website di Browser

Buka browser kemudian akses:
http://127.0.0.1:8000

Apabila seluruh langkah sudah dilakukan dengan benar maka website Rental Motor Jaya akan tampil.

Ringkasan Perintah Instalasi
cd C:\laragon\www
mkdir projek_rental
cd projek_rental
git clone https://github.com/username/rental-motor-jaya.git
cd rental-motor-jaya
composer install
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan optimize:clear
php artisan serve

A. Cara Login Admin

Gunakan akun admin yang tersedia pada database hasil seeder:
Email    : admin@gmail.com
Password : password

Setelah login sebagai admin, pengguna dapat mengakses fitur:
Dashboard
Manajemen Jenis Motor
Tambah Jenis Motor
Edit Jenis Motor
Hapus Jenis Motor
Manajemen Unit Motor
Tambah Unit Motor
Edit Unit Motor
Hapus Unit Motor
Data Customer
Riwayat Transaksi Customer
Verifikasi Pembayaran
Ubah Status Transaksi
Laporan Transaksi
Logout

B. Cara Login Customer
Buka halaman Register
Isi nama lengkap
Isi email
Isi password
Isi konfirmasi password
Klik Register
Login menggunakan akun yang telah dibuat

Setelah login sebagai customer, pengguna dapat mengakses fitur:
Data Akun
Edit Profil
Daftar Motor
Detail Motor
Penyewaan Motor
Upload Bukti Pembayaran
Riwayat Transaksi
Melihat Status Penyewaan
Membatalkan Transaksi
Halaman Syarat dan Ketentuan
Halaman Kontak
Logout
