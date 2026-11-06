<div align="center">

# 🏕️ Dewata Glamping (GlampERP)
### *Integrated Hospitality Enterprise Resource Planning & Guest Booking Platform*

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Livewire](https://img.shields.io/badge/Livewire-4.x-FB70A9?style=for-the-badge&logo=livewire&logoColor=white)](https://livewire.laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com)
[![Spatie RBAC](https://img.shields.io/badge/RBAC-Spatie_Permission-0052CC?style=for-the-badge&logo=shield&logoColor=white)](https://spatie.be/docs/laravel-permission)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](LICENSE)

<p align="center">
  Platform ERP dan portal pemesanan terpadu untuk industri *hospitality* dan resor glamping. Memadukan pengalaman reservasi mandiri untuk tamu (*Guest Portal*) dengan sistem operasional resor menyeluruh (*Back-Office ERP*), meliputi manajemen front-office, F&B order, housekeeping, billing otomatis, serta *Decision Support System* (DSS).
</p>

</div>

---

## 📌 Gambaran Umum & Solusi Bisnis

Pengelolaan resor glamping dan *boutique stay* sering kali menghadapi tantangan operasional: koordinasi manual antara bagian reservasi dan housekeeping, keterlambatan pencatatan pesanan F&B tamu, penanganan *no-show*, serta kompleksitas penagihan akhir (*checkout folio*). 

**Dewata Glamping (GlampERP)** hadir sebagai solusi *all-in-one* yang mendigitalkan seluruh rantai operasional resor:
1. **Self-Service Booking untuk Tamu:** Tamu dapat memilih unit, melihat ketersediaan tanggal, dan menerima kode konfirmasi instan.
2. **Otomatisasi Operasional Front-Office:** Alur *check-in* dan *check-out* 2 langkah dengan pratinjau tagihan instan serta *scheduler* otomatis penanganan tamu *no-show*.
3. **Penyatuan Tagihan (Consolidated Billing):** Biaya inap, pesanan makanan/minuman (F&B), dan biaya tambahan terintegrasi dalam satu invoice resmi berbasis PDF.
4. **Keamanan & Tata Kelola Berbasis Peran:** Akses bertingkat dengan 6 peran organisasi (Admin, Front Office, F&B Staff, Housekeeping, Finance, Customer).

---

## 🌟 Modul & Fitur Utama

```
                      ┌──────────────────────────────────────┐
                      │    Dewata Glamping System Hub        │
                      └──────────────────┬───────────────────┘
                                         │
        ┌────────────────────────────────┴────────────────────────────────┐
        ▼                                                                 ▼
┌───────────────────────────────┐                       ┌──────────────────────────────────┐
│      PUBLIC GUEST PORTAL      │                       │          ENTERPRISE ERP          │
├───────────────────────────────┤                       ├──────────────────────────────────┤
│ • Katalog Unit & Fasilitas    │                       │ • Front Office (Check-in/out)    │
│ • Real-time Availability      │                       │ • F&B Order & Room Service       │
│ • Instant Booking Form        │                       │ • Housekeeping & Room Status     │
│ • Kode Unik Konfirmasi        │                       │ • Billing & PDF Invoice (DomPDF) │
│ • Cek Status Reservasi        │                       │ • Decision Support System (DSS)  │
│                               │                       │ • CRM & Catatan Preferensi Tamu  │
└───────────────────────────────┘                       └──────────────────────────────────┘
```

### 1. 🌐 Public Customer Portal
* **Katalog Unit:** Pratinjau unit glamping lengkap dengan spesifikasi, kapasitas, dan galeri foto.
* **Sistem Reservasi Cerdas:** Pemilihan tanggal menginap dengan validasi ketersediaan unit secara dinamis.
* **Cek Reservasi Mandiri:** Tamu dapat mengecek status pemesanan mereka kapan saja cukup dengan kode pemesanan.

### 2. 🛎️ Front Office & Transaksi
* **Alur Check-in 2 Langkah:** Dilengkapi fitur *preview* rincian tamu dan deposit sebelum status kamar diaktifkan.
* **Check-out Terintegrasi:** Rekonsiliasi otomatis seluruh pengeluaran tamu (sewa unit + pesanan F&B).
* **Automated No-Show Cron Scheduler:** Sistem secara otomatis menjalankan *background task* setiap pukul 23:59 untuk mendeteksi reservasi yang batal/tidak hadir (`reservations:handle-noshow`).

### 3. 🍽️ Food & Beverage (F&B) Management
* Pemesanan menu makanan & minuman yang langsung tercatat ke dalam tagihan kamar tamu yang sedang menginap (*in-house folio*).
* Manajemen stok menu dan status pemesanan (Diproses, Siap, Terkirim).

### 4. 🧹 Housekeeping & Unit Maintenance
* Pengelolaan siklus kebersihan unit (Tersedia, Terisi, Kotor / Perlu Dibersihkan, Dalam Pemeliharaan).
* Koordinasi langsung dengan front-office saat kamar telah siap ditempati.

### 5. 💰 Finance, Billing & Invoicing
* Pembuatan **Invoice PDF resmi** dengan sekali klik memanfaatkan `barryvdh/laravel-dompdf`.
* Pencatatan metode pembayaran fleksibel (Transfer Bank, QRIS, Tunai, Kartu Kredit).
* Laporan keuangan berkala: Laporan Okupansi Kamar, Laporan Pendapatan, dan Performa Penjualan F&B.

### 6. 🧠 Decision Support System (DSS) & CRM
* Analisis data okupansi dan tren musiman untuk membantu manajemen menentukan strategi tarif kamar.
* Riwayat loyalitas tamu beserta modul catatan preferensi (*Guest Preference Notes*).

---

## 👥 Role-Based Access Control (RBAC)

Aplikasi menerapkan pembatasan hak akses ketat menggunakan paket **Spatie Laravel Permission**:

| Role | Akses Modul | Tanggung Jawab Utama |
| :--- | :--- | :--- |
| **Admin** | Seluruh Sistem | Konfigurasi sistem, tarif, hak akses staff, DSS & laporan eksekutif. |
| **Front Office** | Reservasi, Check-in/out, Tamu | Pelayanan tamu, validasi reservasi, koordinasi unit. |
| **F&B Staff** | Menu & Pesanan F&B | Input dan pemrosesan pesanan makanan/minuman kamar. |
| **Housekeeping** | Jadwal Kebersihan Unit | Update status kebersihan dan kesiapan unit glamping. |
| **Finance** | Billing & Laporan Keuangan | Verifikasi pembayaran, penerbitan invoice PDF, audit pendapatan. |
| **Customer** | Portal Tamu & Profil Pribadi | Pemesanan mandiri dan riwayat kunjungan. |

---

## 🛠️ Tech Stack & Arsitektur

* **Framework:** [Laravel 12](https://laravel.com/)
* **Frontend / UI:** [Livewire 4](https://livewire.laravel.com/), [Tailwind CSS 3](https://tailwindcss.com/), [Blade Templates](https://laravel.com/docs/blade)
* **Autentikasi & Otorisasi:** Laravel Breeze & [Spatie Laravel-Permission 6](https://spatie.be/docs/laravel-permission)
* **Dokumentasi & Dokumen:** [Barryvdh Laravel DomPDF](https://github.com/barryvdh/laravel-dompdf)
* **Database:** MySQL 8.0 / MariaDB
* **Build Tool:** Vite

---

## ⚡ Panduan Instalasi Lokal

### Prasyarat
* PHP >= 8.2 (ekstensi aktif: `pdo_mysql`, `mbstring`, `openssl`, `gd`)
* Composer >= 2.5
* Node.js >= 18.x & NPM
* MySQL / MariaDB Server

### Langkah-Langkah

1. **Clone Repositori:**
   ```bash
   git clone https://github.com/dekbintang/Dewata-Glamping.git
   cd Dewata-Glamping
   ```

2. **Instal Dependensi PHP & JavaScript:**
   ```bash
   composer install
   npm install
   ```

3. **Konfigurasi Environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Sesuaikan koneksi database Anda pada file `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=dewata_glamping
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Jalankan Migrasi & Seeder Demo:**
   ```bash
   php artisan migrate --seed
   ```
   *Seeder akan secara otomatis mengisi peran, akun demo, unit glamping, dan menu makanan.*

5. **Kompilasi Aset Frontend & Jalankan Server:**
   ```bash
   npm run build
   php artisan serve
   ```
   Akses aplikasi di browser pada: `http://localhost:8000`

---

## 🔑 Akun Uji Coba (Demo Accounts)

Semua akun demo bawaan menggunakan password yang seragam: `password`

| Role | Email Login | Password |
| :--- | :--- | :--- |
| **Super Admin** | `admin@glamperp.com` | `password` |
| **Front Office** | `frontoffice@glamperp.com` | `password` |
| **Finance Officer** | `finance@glamperp.com` | `password` |
| **F&B Staff** | `fnb@glamperp.com` | `password` |
| **Housekeeping** | `housekeeping@glamperp.com` | `password` |
| **Customer** | `customer@glamperp.com` | `password` |

---

## 👨‍💻 Pengembang

**I Kadek Bintang Adi Bimantara**  
*Program Studi Teknologi Informasi — Universitas Udayana*  
* [GitHub Profile](https://github.com/dekbintang)
* [Instagram](https://instagram.com/ikadek_bintang)

---

## 📄 Lisensi
Proyek ini dilisensikan di bawah [Lisensi MIT](LICENSE). Bebas digunakan dan dikembangkan untuk keperluan riset dan akademis.
