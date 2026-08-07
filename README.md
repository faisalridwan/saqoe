<div align="center">
  <img src="assets/img/logotok.png" alt="Saqoe Logo" width="120" />

  # 💸 Saqoe (Saku-e)
  **Sistem Manajemen Keuangan Modern Khusus Mahasiswa & Profesional Muda**

  <p align="center">
    <a href="#"><img src="https://img.shields.io/badge/Framework-CodeIgniter_3-ee4323?style=for-the-badge&logo=codeigniter&logoColor=white" alt="CodeIgniter"></a>
    <a href="#"><img src="https://img.shields.io/badge/PHP-7.4+-777bb4?style=for-the-badge&logo=php&logoColor=white" alt="PHP"></a>
    <a href="#"><img src="https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL"></a>
    <a href="#"><img src="https://img.shields.io/badge/Bootstrap-4-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap"></a>
  </p>

  <p align="center">
    Aplikasi web elegan dan ringan untuk melacak setiap transaksi finansial, memastikan arus kas Anda selalu dalam pengawasan yang sempurna.
  </p>
</div>

---

## ✨ Fitur Unggulan (Key Features)

Saqoe dirancang dengan antarmuka yang _clean_, _responsive_, dan mudah dinavigasi, membawa fitur-fitur esensial ke ujung jari Anda:

- 📊 **Dashboard Analitik Dinamis**: Visualisasi langsung arus kas Anda melalui grafik dan persentase yang disajikan secara interaktif menggunakan *Chart.js*.
- 💰 **Manajemen Keuangan Harian**: Catat setiap pemasukan dan pengeluaran harian dengan presisi. Dilengkapi konversi angka ke format Rupiah secara *real-time*.
- 📅 **Manajemen Budget Event**: Fitur eksklusif untuk merencanakan anggaran kegiatan/event spesifik. Alokasikan *budget* Anda dan lacak biaya tak terduga secara terpisah dari keuangan harian.
- 🗂 **Riwayat Transaksi (History) Super Interaktif**: Tabel riwayat transaksi didukung oleh *DataTables*, memberikan Anda kekuatan untuk melakukan *Sorting* (Ascending/Descending), *Paging*, dan *Filtering* pencarian dalam hitungan milidetik.
- 🔐 **Keamanan Autentikasi**: Sistem *Login*, *Register*, dan manajemen profil pengguna yang dilengkapi *Flashdata alert* interaktif.
- 📱 **Desain Responsif Premium**: Didukung oleh template *SB Admin 2* (Bootstrap 4), memberikan pengalaman visual yang memanjakan mata di desktop maupun *smartphone*.

---

## 🛠 Teknologi (Tech Stack)

Aplikasi ini dikembangkan dengan arsitektur **MVC (Model-View-Controller)** yang terstruktur menggunakan _stack_ berikut:

**Backend & Database:**
- [CodeIgniter 3.1.11](https://codeigniter.com/userguide3/) - PHP Framework ringan dan super cepat.
- [MySQL](https://www.mysql.com/) - Relational Database Management System.

**Frontend & UI Components:**
- [Bootstrap 4](https://getbootstrap.com/docs/4.0/getting-started/introduction/) - UI Framework.
- [SB Admin 2](https://startbootstrap.com/theme/sb-admin-2) - Dashboard Template.
- [DataTables 1.10.x](https://datatables.net/) - Plugin *table* interaktif & canggih.
- [Chart.js](https://www.chartjs.org/) - Visualisasi diagram dan grafik analisis keuangan.
- [Select2](https://select2.org/) - Komponen *dropdown select* modern.

---

## 🚀 Panduan Instalasi (Installation Guide)

Ikuti langkah-langkah mudah di bawah ini untuk menjalankan **Saqoe** di _environment_ lokal Anda.

### 1. Persyaratan Sistem (*Requirements*)
- PHP Versi 7.2 atau lebih baru (Disarankan 7.4).
- Web Server lokal (XAMPP / MAMP / Laragon / Nginx).
- MySQL / MariaDB Database Server.
- Git.

### 2. Kloning Repositori
Jalankan perintah ini di terminal pada direktori `htdocs` (XAMPP) atau direktori root *web server* Anda:
```bash
git clone https://github.com/username/impal-saqoe.git
cd impal-saqoe
```

### 3. Konfigurasi Database
1. Buka **phpMyAdmin** atau *Database Client* favorit Anda (seperti DBeaver/TablePlus).
2. Buat *database* baru dengan nama `saqoe`.
3. Lakukan proses _import_ menggunakan _file_ *dump database* yang tersedia di folder proyek:
   - Pilih `Database/saqoe.sql` dan _import_ ke _database_ yang baru saja dibuat.

### 4. Konfigurasi Sistem (CodeIgniter)
Buka folder proyek ini di _Code Editor_ Anda (VS Code, Sublime, dsb).
- Pastikan konfigurasi _database_ di `application/config/database.php` sudah sesuai dengan *username* dan *password* server MySQL Anda.
  ```php
  'hostname' => 'localhost',
  'username' => 'root',      // Sesuaikan username
  'password' => '',          // Sesuaikan password
  'database' => 'saqoe',     // Nama database
  ```
- *Base URL* aplikasi telah terkonfigurasi otomatis dalam `application/config/config.php`.

### 5. Jalankan Aplikasi
Jika Anda menggunakan web server lokal tanpa *virtual host*, Anda bisa mengakses aplikasi melalui browser:
```
http://localhost/impal-saqoe/
```
Atau jika Anda ingin menjalankan *built-in server* PHP, jalankan perintah ini di terminal:
```bash
php -S localhost:8000
```
Lalu buka browser Anda: `http://localhost:8000`

---

## 🎨 Cuplikan Layar (Screenshots)

*(Area ini diperuntukkan untuk gambar demonstrasi aplikasi. Silakan letakkan gambar Anda ke dalam folder direktori `assets/img/` lalu sambungkan di bawah ini.)*

| Dashboard Utama | Riwayat Transaksi (DataTables) |
| :---: | :---: |
| <img src="assets/img/logotok.png" width="300" alt="Dashboard" /> | <img src="assets/img/logotok.png" width="300" alt="History" /> |

*(Ganti `logotok.png` di atas dengan screenshot Dashboard dan tabel History Anda yang sebenarnya).*

---

## 🤝 Kontribusi (Contributing)
Proyek ini dibuat untuk tugas mata kuliah **Implementasi dan Pengujian Perangkat Lunak (APPL)**.
Namun kami sangat menyambut kontribusi (*Pull Requests*) dari siapa saja untuk meningkatkan fungsionalitas dan keamanan dari proyek ini! 
Pastikan Anda membuat *branch* baru sebelum mengajukan pembaruan.

---

## 📄 Lisensi (License)
Dibuat dengan ❤️ oleh tim pengembang **Saqoe**.
Kode sumber ini bersifat terbuka (*Open Source*) dan dapat dimodifikasi untuk keperluan pembelajaran.

---
<p align="center"><i>"Manage your wealth, shape your future."</i></p>
