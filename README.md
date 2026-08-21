# APV - IAC SABILULUNGAN — Aplikasi Manajemen Anggota (Laravel)

Scaffold ini berisi source code inti (migration, model, controller, view, route)
untuk aplikasi manajemen anggota klub mobil APV: data anggota, kendaraan, iuran bulanan,
role multi-user, export Excel, upload foto, dan grafik iuran per wilayah.

## Cara pakai (di Laragon / lokal Windows kamu)

### 1. Buat project Laravel baru
```bash
composer create-project laravel/laravel apv-nusantara
cd apv-nusantara
```

### 2. Install package tambahan
```bash
composer require maatwebsite/excel
composer require laravel/ui
php artisan ui bootstrap --auth
```
(Auth login bawaan Laravel UI dipakai sebagai basis, lalu kita tambah kolom role.)

### 3. Salin semua file dari folder ini
Salin isi folder scaffold ini (database/, app/, resources/, routes/) ke dalam
folder project Laravel yang baru dibuat, timpa file yang sudah ada bila diminta.

### 4. Konfigurasi database (.env)
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=apv_nusantara
DB_USERNAME=root
DB_PASSWORD=
```
Buat database `apv_nusantara` di HeidiSQL / phpMyAdmin (Laragon sudah sediakan).

### 5. Migrasi & seed data awal
```bash
php artisan migrate --seed
```
Ini akan membuat 1 akun admin pusat default:
- Email: admin@apvnusantara.id
- Password: password

**Ganti password ini setelah login pertama kali.**

### 6. Buat symlink storage (untuk upload foto)
```bash
php artisan storage:link
```

### 7. Jalankan
```bash
php artisan serve
```
Buka `http://127.0.0.1:8000`

## Struktur peran (role)

- **admin_pusat** — bisa lihat & kelola semua data seluruh Indonesia, kelola akun pengurus wilayah
- **pengurus_wilayah** — hanya bisa kelola anggota, kendaraan, dan iuran di wilayahnya sendiri (kolom `wilayah` di akun pengurus dicocokkan otomatis)

## Fitur

- CRUD anggota, kendaraan, iuran bulanan
- Upload foto KTP anggota & foto kendaraan (disimpan di `storage/app/public`)
- Export data anggota & rekap iuran ke Excel (`maatwebsite/excel`)
- Grafik batang iuran per wilayah per bulan (Chart.js, data dari `DashboardController`)
- Dashboard ringkasan: total anggota, kendaraan, tunggakan bulan berjalan

## Deploy ke web (produksi)

- Hosting: VPS (DigitalOcean/Vultr/Biznet Gio) dengan MySQL 8, atau shared hosting yang dukung Laravel (Niagahoster/Domainesia paket Cloud Hosting)
- Set `APP_ENV=production`, `APP_DEBUG=false` di `.env`
- Jalankan `php artisan config:cache && php artisan route:cache`
- Pasang SSL (Let's Encrypt gratis via Certbot atau otomatis dari panel hosting)
