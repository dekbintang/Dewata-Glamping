# Dewata Glamping — GlampERP

Sistem ERP dan portal pemesanan terpadu untuk resor glamping. Menggabungkan portal reservasi mandiri untuk tamu dengan sistem operasional back-office (front-office, F&B, housekeeping, billing, dan DSS).

## Tech Stack

- **Framework:** Laravel 12, Livewire 4
- **Frontend:** Blade, Tailwind CSS
- **Auth & RBAC:** Laravel Breeze, Spatie Laravel-Permission
- **PDF:** Barryvdh Laravel DomPDF
- **Database:** MySQL

## Fitur

- Portal booking tamu dengan kode konfirmasi
- Check-in/check-out 2 langkah
- Pemesanan F&B yang terintegrasi ke tagihan kamar
- Manajemen housekeeping dan status unit
- Invoice PDF otomatis
- Laporan pendapatan, okupansi, dan penjualan F&B
- Decision Support System (DSS)
- CRM dan catatan preferensi tamu
- Scheduler otomatis penanganan no-show (cron harian)

## Role

| Role | Akses |
| :--- | :--- |
| Admin | Seluruh sistem |
| Front Office | Reservasi, check-in/out, data tamu |
| F&B Staff | Menu dan pesanan makanan/minuman |
| Housekeeping | Status kebersihan unit |
| Finance | Billing, invoice, laporan keuangan |
| Customer | Portal tamu dan profil |

## Setup

```bash
git clone https://github.com/dekbintang/Dewata-Glamping.git
cd Dewata-Glamping
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Sesuaikan konfigurasi database di `.env`, lalu:

```bash
php artisan migrate --seed
npm run build
php artisan serve
```

Buka `http://localhost:8000`.

## Demo Accounts

Password semua akun: `password`

| Role | Email |
| :--- | :--- |
| Admin | `admin@glamperp.com` |
| Front Office | `frontoffice@glamperp.com` |
| Finance | `finance@glamperp.com` |
| F&B Staff | `fnb@glamperp.com` |
| Housekeeping | `housekeeping@glamperp.com` |
| Customer | `customer@glamperp.com` |

## Lisensi

[MIT](LICENSE)
