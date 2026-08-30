# ✈️ Projek Pemeliharaan & Digital Service Manual Pesawat Cessna 172

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12" />
  <img src="https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS" />
  <img src="https://img.shields.io/badge/Alpine.js-3.x-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white" alt="Alpine.js" />
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+" />
  <img src="https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL" />
</p>

Sistem Portal Digital dan Panel Kontrol Operasi Pemeliharaan Pesawat **Cessna 172-Series (Skyhawk 1969–1976)**. Dibuat dengan arsitektur modern untuk memudahkan teknisi penerbangan, pilot, dan insinyur aviasi dalam membaca buku manual resmi pabrik, melihat diagram instalasi mekanis/kelistrikan, melakukan checklist inspeksi berkala, serta mengelola data teknis secara terpusat.

---

## 🌟 Fitur Unggulan

### 📖 1. Portal Publik & Pembaca Manual Digital
- **Katalog 21 Bab Manual Lengkap (§01 – §20)**: Seluruh bab buku pedoman pemeliharaan pabrik dengan penomoran paragraf terindeks (`¶1-1`, `¶2-1`, dst).
- **Terjemahan Dwibahasa Instan (🇮🇩 ID / 🇺🇸 EN)**: Dilengkapi dengan fitur penerjemah halaman dan kartu terjemahan per-paragraf dengan cache cerdas.
- **Dukungan Penuh Mode Terang & Gelap (☀️ Light / 🌙 Dark Mode)**: Tampilan kontras tinggi yang nyaman di mata pada siang maupun malam hari dengan penyimpanan preferensi lokal.
- **Pencarian Cepat Seluruh Manual (Global Search)**: Pencarian instan teks manual, nomor komponen, kabel, torsi, dan bab dengan sistem *debounce* dan *highlight*.
- **Pencarian Nomor Seri Pesawat (Serial Lookup Tool)**: Alat identifikasi tahun produksi dan varian mesin berdasarkan nomor seri rangka pesawat (*Airframe Serial Number*).
- **Checklist Inspeksi Interaktif**: Daftar tugas pemeliharaan berkala (50-Jam, 100-Jam, 200-Jam, dan Tahunan) lengkap dengan indikator progres *real-time*.
- **Galeri Gambar & Skema Kelistrikan**: Tampilan visual resolusi tinggi untuk diagram kabel (Seksi 20), instalasi avionik, dan batas torsi pengencangan baut standar pabrik.

### 🛡️ 2. Panel Kontrol Admin (CMS Operasi Aviasi)
- **Navigasi Sidebar Kiri Khusus**: Tata letak sidebar modern tanpa tabrakan dengan tabel data yang luas.
- **Manajemen Bab & Sub-Bab (CRUD Manual Sections)**: Tambah, edit, dan hapus teks prosedur pemeliharaan dan rentang halaman dokumen.
- **Manajemen Gambar & Skema (Figures CMS)**: Unggah dan kelola blueprint instalasi dan diagram teknis.
- **Manajemen Spesifikasi & Batas Torsi (Specifications CMS)**: Pengaturan data teknis mesin, dimensi, kapasitas bahan bakar, dan torsi pengencangan baut.
- **Manajemen Model & Varian Pesawat (Models CMS)**: Pendataan tipe pesawat Cessna 172K, 172L, 172M, serta varian Reims F172.
- **Manajemen Kartu Tugas Inspeksi (Inspection Tasks CMS)**: Penambahan dan pembaruan item checklist berkala.
- **Fitur 1-Click Demo Login & Register**: Tombol otomatis untuk pengisian akun demonstrasi teknisi dan administrator.

---

## 🛠️ Teknologi yang Digunakan

- **Backend Framework**: [Laravel 12](https://laravel.com)
- **Frontend & Styling**: [Tailwind CSS](https://tailwindcss.com), [Alpine.js](https://alpinejs.dev), Blade Templating
- **Database**: MySQL / MariaDB
- **Build Tools**: [Vite](https://vitejs.dev)
- **Asset Icons & Fonts**: Plus Jakarta Sans, JetBrains Mono, Heroicons

---

## 🚀 Panduan Instalasi & Menjalankan di Komputer Lokal

Pastikan Anda telah menginstal **PHP (>= 8.2)**, **Composer**, **Node.js**, dan **MySQL** (misalnya via XAMPP).

### 1. Clone Repository
```bash
git clone https://github.com/asepsurahman03/Projek-Maintanance-Pesawat.git
cd Projek-Maintanance-Pesawat
```

### 2. Install Dependensi PHP & JavaScript
```bash
composer install
npm install
```

### 3. Konfigurasi Environment (`.env`)
Salin file konfigurasi environment:
```bash
cp .env.example .env
php artisan key:generate
```

Buka file `.env` dan sesuaikan koneksi database MySQL Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=maintanance_pesawat
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Jalankan Migrasi & Seeder Database
Perintah ini akan membuat seluruh tabel dan mengisi data awal 21 seksi manual, gambar, spesifikasi, dan checklist inspeksi:
```bash
php artisan migrate:fresh --seed
```

### 5. Kompilasi Asset & Jalankan Server Lokal
Buka dua terminal terpisah:

**Terminal 1 (Build Asset Frontend):**
```bash
npm run build
# atau untuk mode live reload:
npm run dev
```

**Terminal 2 (Server PHP Laravel):**
```bash
php artisan serve
```

Aplikasi sekarang dapat diakses melalui browser di:
👉 **[http://127.0.0.1:8000](http://127.0.0.1:8000)**

---

## 🔐 Kredensial Akun Demonstrasi (Default)

Untuk masuk ke Panel Admin CMS:
- **URL Login**: [http://127.0.0.1:8000/login](http://127.0.0.1:8000/login)
- **Email**: `admin@gmail.com`
- **Password**: `password`
*(Tersedia tombol **Auto-fill** 1-klik di halaman login)*

---

## ⚠️ Penafian Aviasi (Aviation Advisory)

> Dokumen dan aplikasi digital ini disediakan semata-mata untuk tujuan dokumentasi, studi, dan referensi teknis. Untuk pekerjaan perawatan pesawat terbang sebenarnya, selalu gunakan dan verifikasi terhadap data pemeliharaan terbaru yang telah disetujui oleh otoritas penerbangan resmi (FAA/DGCA) serta Petunjuk Kelaikudaraan (*Airworthiness Directives*) yang berlaku.

---

## 📄 Lisensi

Projek ini bersifat terbuka di bawah lisensi [MIT License](LICENSE).
Dikembangkan untuk repositori [asepsurahman03/Projek-Maintanance-Pesawat](https://github.com/asepsurahman03/Projek-Maintanance-Pesawat).
