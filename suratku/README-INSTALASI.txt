SURATKU — STARTER PROJECT LARAVEL + MYSQL
=========================================

PENTING:
- Bundle ini berisi file aplikasi untuk disalin ke proyek Laravel baru.
- Jangan menimpa folder ai-monitoring milikmu. Buat proyek terpisah bernama suratku.
- Tampilan memakai Blade + CSS biasa; tidak memerlukan npm untuk styling.
- PDF dibuat lewat tombol Cetak / Simpan PDF pada browser (Print > Save as PDF).

A. CEK PHP DAN COMPOSER
Buka CMD atau PowerShell:
  php -v
  composer --version

B. BUAT PROYEK BARU
Pindah ke folder tempat proyek sekolah disimpan:
  cd "$HOME\Documents\laravel-prj-Radhisya"
  composer create-project laravel/laravel suratku
  cd suratku

Jika Composer gagal karena SSL/OpenSSL atau koneksi, jangan hapus Composer atau proyek lama. Simpan pesan error untuk diperiksa.

C. BUAT DATABASE MYSQL
Pastikan layanan MySQL84 berjalan. Buka MySQL Workbench, atau masuk ke MySQL lalu jalankan:
  CREATE DATABASE suratku CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

D. ATUR FILE .env
Buka .env di folder suratku, lalu pastikan pengaturan database seperti ini (sesuaikan username/password MySQL milikmu):
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=suratku
  DB_USERNAME=root
  DB_PASSWORD=

Jika root MySQL memakai password, isi DB_PASSWORD dengan password itu. Jangan mengirim password ke chat.

E. SALIN FILE DARI BUNDLE
Ekstrak ZIP. Salin isi folder app/, database/, resources/, routes/ ke folder proyek suratku dengan mempertahankan struktur folder. Jika Windows bertanya mengganti file, file yang namanya sama pada bundle ini memang perlu ditambahkan/diubah sesuai petunjuk:
- routes/web.php: ganti isi file dengan isi bundle.
- app/Models/SuratLamaran.php: file baru.
- app/Http/Controllers/AuthController.php: file baru.
- app/Http/Controllers/SuratLamaranController.php: file baru.
- database/migrations/2026_10_13_000000_create_surat_lamarans_table.php: file baru.
- resources/views/layouts/app.blade.php: file baru.
- resources/views/auth/login.blade.php: file baru.
- resources/views/auth/register.blade.php: file baru.
- resources/views/surats/index.blade.php, create.blade.php, show.blade.php: file baru.

F. JALANKAN MIGRASI DAN SERVER
Di terminal folder suratku:
  php artisan optimize:clear
  php artisan migrate
  php artisan serve --host=127.0.0.1 --port=8000

Buka http://127.0.0.1:8000/register untuk membuat akun pertama.
Jika port 8000 sedang digunakan:
  php artisan serve --host=127.0.0.1 --port=8080
Lalu buka http://127.0.0.1:8080/register

FITUR
- Register, login, logout
- Form surat lamaran kerja
- Daftar/riwayat surat
- Lihat surat, hapus surat
- Cetak / simpan PDF melalui browser
- Data surat dipisahkan per pengguna (user_id)

Jika muncul error, kirim teks error lengkap dan jangan langsung menghapus folder/database.
