SURATKU — REDESIGN + TANDA TANGAN + DOKUMEN
============================================

Fitur:
- Tampilan modern biru-putih, dashboard dan formulir lebih rapi.
- Area untuk menggambar tanda tangan memakai mouse/jari.
- Opsi unggah gambar tanda tangan PNG/JPG (maksimal 2 MB).
- Unggah CV, ijazah, sertifikat, dan portofolio.
- CV/ijazah/sertifikat/portofolio maksimal 5 MB per file.
- Tanda tangan muncul di pratinjau surat dan ikut dicetak ke PDF browser.
- Lampiran bisa diunduh setelah login dan hanya oleh pemilik surat.
- File disimpan di disk local/private Laravel, bukan di folder public.
- Menghapus surat juga menghapus lampirannya.

CARA MEMASANG KE PROYEK YANG SUDAH ADA:
1. Cadangkan folder proyek terlebih dahulu, minimal routes/web.php dan app/.
2. Ekstrak ZIP ini.
3. Salin folder app, database, resources, dan file routes/web.php ke folder proyek:
   C:\Users\LENOVO\apk lamaran kerja-rara\suratku
4. Jika ditanya, gabungkan folder dan ganti file yang namanya sama.
5. Pastikan app/Models/User.php masih memiliki satu saja method suratLamarans():
   public function suratLamarans(): HasMany { return $this->hasMany(SuratLamaran::class); }
6. Di PowerShell, dari folder proyek jalankan:
   php artisan optimize:clear
   php artisan migrate
   php artisan route:list
7. Buka http://127.0.0.1:8000/surat/buat, isi formulir, coba gambar tanda tangan dan unggah dokumen.

PENTING:
- Migration baru hanya menambahkan kolom lampiran ke tabel surat_lamarans yang sudah ada.
- Jangan menjalankan migrate:fresh karena itu akan menghapus tabel dan data.
- Jika server sudah berjalan, biarkan terminal server tetap terbuka; refresh browser dengan Ctrl+F5.
- Upload dokumen bersifat opsional. Format dan batas ukuran divalidasi oleh server.
- Fitur cetak PDF memakai dialog cetak browser (pilih Save as PDF), tanpa library tambahan.
