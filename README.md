Website Grocery
Repositori ini berisi kode sumber untuk website Grocery yang dibangun menggunakan framework Slim 3, database MySQL, dan Bootstrap 5 untuk desain antarmuka depan.

Tentang Proyek
Website Grocery adalah platform untuk mengelola dan membeli barang-barang grosir. Fitur-fiturnya meliputi penjelajahan produk, menambahkan item ke keranjang, dan menyelesaikan pembelian.

Dibuat Dengan
Slim 3: Sebuah micro-framework PHP yang membantu Anda menulis aplikasi web dan API sederhana namun kuat dengan cepat.
MySQL: Sistem manajemen basis data relasional open-source.
Bootstrap 5: Pustaka HTML, CSS, dan JS yang populer untuk mengembangkan website yang responsif dan mobile-first.
Memulai
Untuk mendapatkan salinan lokal dan menjalankannya, ikuti langkah-langkah berikut:

Prasyarat
PHP 7.2 atau lebih tinggi
Composer
MySQL
Server web seperti Apache atau Nginx
Instalasi
Clone repositori
sh
Salin kode
git clone https://github.com/usernameanda/grocery-website.git
Masuk ke direktori proyek
sh
Salin kode
cd grocery-website
Instal dependensi menggunakan Composer
sh
Salin kode
composer install
Siapkan database
Buat database MySQL.
Impor file SQL yang disediakan ke dalam database Anda:
sh
Salin kode
mysql -u usernameanda -p databasenama < database.sql
Konfigurasi variabel lingkungan
Ganti nama .env.example menjadi .env.
Perbarui konfigurasi database di file .env:
env
Salin kode
DB_HOST=localhost
DB_NAME=databasenama
DB_USER=usernameanda
DB_PASS=passwordanda
Menjalankan Aplikasi
Mulai server built-in PHP

sh
Salin kode
php -S localhost:8080 -t public
Atau, Anda dapat mengkonfigurasi server web Anda untuk melayani direktori public.

Akses aplikasi
Buka browser Anda dan arahkan ke http://localhost:8080.

Kredensial Admin Default
Username: admin
Password: admin123
Screenshot

Beranda


Halaman Produk


Keranjang

Kontribusi
Kontribusi adalah apa yang membuat komunitas open-source menjadi tempat yang luar biasa untuk belajar, menginspirasi, dan menciptakan. Setiap kontribusi yang Anda buat sangat dihargai.

Fork Proyek
Buat Branch Fitur Anda (git checkout -b fitur/FiturLuarBiasa)
Commit Perubahan Anda (git commit -m 'Tambah beberapa FiturLuarBiasa')
Push ke Branch (git push origin fitur/FiturLuarBiasa)
Buka Pull Request
Lisensi
Didistribusikan di bawah Lisensi MIT. Lihat LICENSE untuk informasi lebih lanjut.

Kontak
Nama Anda - @twitterhandleanda - email@contoh.com

Link Proyek: https://github.com/usernameanda/grocery-website
