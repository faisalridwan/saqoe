<div align="center">
  <img src="assets/img/logotok.png" alt="Saqoe Logo" width="120" />

  # 💸 Saqoe (Saku-e)
  **Sistem Manajemen Keuangan Cerdas & Komprehensif**
  
  <p align="center">
    <a href="https://github.com/faisalridwan"><img src="https://img.shields.io/badge/Developer-Faisal%20Ridwan-181717?style=for-the-badge&logo=github&logoColor=white" alt="Developer"></a>
    <a href="https://qreatip.com"><img src="https://img.shields.io/badge/Studio-Qreatip-00C7B7?style=for-the-badge&logo=web&logoColor=white" alt="Qreatip.com"></a>
  </p>

  <p align="center">
    <a href="#"><img src="https://img.shields.io/badge/Framework-CodeIgniter_3-ee4323?style=for-the-badge&logo=codeigniter&logoColor=white" alt="CodeIgniter"></a>
    <a href="#"><img src="https://img.shields.io/badge/PHP-7.4+-777bb4?style=for-the-badge&logo=php&logoColor=white" alt="PHP"></a>
    <a href="#"><img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL"></a>
    <a href="#"><img src="https://img.shields.io/badge/Bootstrap-4-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap"></a>
  </p>

  <p align="center">
    Aplikasi web elegan, dinamis, dan terstruktur untuk melacak setiap transaksi finansial, memastikan arus kas Anda selalu dalam pengawasan yang sempurna dengan analitik mendalam.
  </p>
</div>

---

## 🌟 Tentang Proyek (About The Project)

**Saqoe** adalah aplikasi manajemen finansial revolusioner yang dirancang khusus untuk memonitor, mengalokasikan, dan menganalisis pengeluaran maupun pemasukan pribadi atau bisnis mikro Anda secara sangat detail. Dari pengaturan dompet, kategori yang dikustomisasi, pencatatan otomatis transaksi rutin bulanan, hingga manajemen event terpisah—semuanya ada dalam satu dashboard yang bersih dan memanjakan mata.

Dibuat secara teliti oleh **[Faisal Ridwan](https://github.com/faisalridwan)** dan didukung oleh **[qreatip.com](https://qreatip.com)**.

---

## ✨ Fitur Super Lengkap (Comprehensive Features)

Saqoe dirancang dengan antarmuka yang _clean_, _responsive_, dan mudah dinavigasi, membawa fitur-fitur esensial ke ujung jari Anda:

### 1. 📊 Dashboard Analitik Dinamis & Interaktif
Visualisasi langsung arus kas Anda melalui grafik lingkaran (Pie Chart) maupun diagram batang (Bar Chart) yang disajikan secara interaktif menggunakan *Chart.js*. Memantau rasio pengeluaran antar-kategori kini semudah membalikkan telapak tangan.

### 2. 👝 Sistem Multi-Dompet (Multi-Wallet System) & Split-Payment
Catat keuangan Anda dengan sistem multi-dompet yang sangat fleksibel. Fitur unggulan *Split-Payment* memungkinkan Anda untuk membayar satu transaksi dengan kombinasi 2 dompet sekaligus jika saldo dompet utama tidak mencukupi, memastikan akurasi saldo yang mutlak di setiap rekening/e-wallet Anda.

### 3. 📅 Manajemen Budget Event Independen
Merencanakan liburan, kepanitiaan, atau hajatan? Fitur **Kelola Event** memungkinkan Anda merencanakan anggaran kegiatan spesifik. Alokasikan *budget* Anda dan lacak biaya pemasukan serta pengeluaran tak terduga secara terpisah dan independen dari arus kas harian Anda.

### 4. 🔄 Transaksi Rutin (Recurring Transactions) Otomatis
Tak perlu repot mencatat langganan Netflix, Spotify, atau tagihan kos setiap bulan. Atur sekali di menu **Transaksi Rutin** dan biarkan sistem mengeksekusi pemasukan/pengeluaran tersebut secara otomatis di latar belakang setiap bulannya.

### 5. 🗂 Riwayat Transaksi (History) Cerdas
Tabel riwayat transaksi sangat mendetail didukung oleh *DataTables*. Memberikan Anda kekuatan untuk melakukan *Sorting* (Ascending/Descending), *Paging*, dan *Filtering* pencarian instan dalam hitungan milidetik. Menampilkan informasi dompet, kategori, waktu transaksi, dan *tracking* saldo akhir dari setiap transaksi.

### 6. 🔒 Keamanan Autentikasi & Otorisasi
Sistem *Login*, *Register*, manajemen *User Profile*, pengubah kata sandi, dan proteksi URL (*session-hijacking prevention*) terpasang rapi. Dilengkapi *Flashdata alert* interaktif yang cantik dan modal konfirmasi yang aman (termasuk *Logout Modal* yang elegan).

### 7. 📱 UI/UX & Desain Responsif Premium
Dibangun di atas *SB Admin 2* dan Bootstrap 4, dengan dukungan kustomisasi CSS terpusat (`custom.css`), halaman *Landing Page* informatif yang mendeteksi sesi pengguna otomatis, menu navigasi interaktif (Active Menu Highlights), *Breadcrumbs* pendukung alur kerja, hingga *Custom 404 Error Page* khusus yang didesain memukau.

---

## 🛠 Arsitektur & Teknologi (Tech Stack)

Aplikasi ini dikembangkan dengan arsitektur **MVC (Model-View-Controller)** yang sangat terstruktur, modul-modul independen (modular controllers), menggunakan _stack_ berikut:

**Backend & Database:**
- [CodeIgniter 3.1.11](https://codeigniter.com/userguide3/) - PHP Framework ringan, *rock-solid* dan super cepat.
- [PHP 7.4+](https://www.php.net/) - Standar pengkodean backend.
- [MySQL/MariaDB](https://www.mysql.com/) - RDBMS mumpuni untuk integritas data.

**Frontend & UI Components:**
- [Bootstrap 4.6](https://getbootstrap.com) - Framework UI.
- [SB Admin 2](https://startbootstrap.com/theme/sb-admin-2) - Dashboard Template modifikasi premium.
- [DataTables 1.10.x](https://datatables.net/) - Plugin HTML tables interaktif.
- [Chart.js](https://www.chartjs.org/) - Visualisasi data berbasis HTML5 Canvas.
- [Select2](https://select2.org/) - Komponen dropdown cerdas.

---

## 🚀 Panduan Instalasi (Installation Guide)

Ikuti langkah-langkah mudah di bawah ini untuk menjalankan **Saqoe** di _environment_ lokal Anda.

### 1. Persyaratan Sistem (*Requirements*)
- PHP Versi 7.4 - 8.x
- Web Server lokal (Apache/XAMPP / Nginx / Laragon / MAMP).
- MySQL / MariaDB Database Server.
- Git / Composer.

### 2. Kloning Repositori
Jalankan perintah ini di terminal pada direktori `htdocs` (XAMPP) atau direktori root *web server* Anda:
```bash
git clone https://github.com/faisalridwan/saqoe.git
cd saqoe
```

### 3. Konfigurasi Database
1. Buka **phpMyAdmin** atau *Database Client* favorit Anda.
2. Buat *database* baru dengan nama `saqoe`.
3. Lakukan proses _import_ menggunakan _file_ `phase123.sql` (atau file *dump database* terbaru) yang ada di direktori root aplikasi.

### 4. Konfigurasi Sistem (CodeIgniter)
- Pastikan konfigurasi _database_ di `application/config/database.php` sesuai dengan server MySQL lokal Anda:
  ```php
  'hostname' => 'localhost',
  'username' => 'root',      // Sesuaikan username
  'password' => '',          // Sesuaikan password
  'database' => 'saqoe',     // Nama database yang diimport
  ```
- *Base URL* aplikasi dikonfigurasi dinamis di `application/config/config.php` menggunakan mekanisme deteksi $_SERVER.

### 5. Menjalankan Aplikasi
Akses melalui virtual host lokal Anda, atau gunakan *built-in server* PHP (cara tercepat):
```bash
php -S localhost:8000
```
Lalu buka browser Anda: `http://localhost:8000`

---

## 🤝 Kontributor & Pembuat (Credits)

Proyek ini diprakarsai, dikonsep, dan dikembangkan secara penuh oleh:
* **Faisal Ridwan** (Full-Stack Engineer) 
  * GitHub: [@faisalridwan](https://github.com/faisalridwan)
  * Website: [qreatip.com](https://qreatip.com)

Kami sangat menyambut kontribusi (*Pull Requests*, *Issue Reports*) dari komunitas pengembang *open source* untuk terus meningkatkan fungsionalitas dan keamanan dari proyek ini!

---

## 📄 Lisensi (License)

Hak Cipta © <?= date('Y'); ?> **qreatip studio**.

Kode sumber ini bersifat terbuka (*Open Source*) dan dapat dimodifikasi untuk keperluan pembelajaran atau implementasi komersial selama mematuhi *fair-use policy* atau perizinan dari pengembang asli.

---
<p align="center"><i>"Kendalikan uangmu, sebelum uang mengendalikan hidupmu."</i></p>
