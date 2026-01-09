# 🐾 DELI PETSHOP - SISTEM INFORMASI MANAJEMEN

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

Sistem Informasi Manajemen **Deli Petshop** berbasis web menggunakan **Laravel 12.x**, **Bootstrap 5**, dan **MySQL**. Sistem ini dirancang untuk mengelola produk, transaksi, pelanggan, dan laporan toko hewan peliharaan dengan interface yang modern dan responsif.

---

## 📋 **FITUR UTAMA**

### ✅ **Manajemen Data**
- **CRUD Kategori Produk** - Kelola kategori produk petshop
- **CRUD Produk** - Manajemen produk dengan upload gambar
- **CRUD Pelanggan** - Database pelanggan lengkap
- **CRUD User** - Manajemen user dengan role (Admin & Kasir)
- **Manajemen Stok** - Update otomatis stok saat transaksi

### 💰 **Transaksi & POS**
- **Point of Sale (POS)** - Sistem kasir interaktif
- **Multi Item** - Tambah banyak item dalam satu transaksi
- **Auto Calculate** - Hitung total, diskon, pajak otomatis
- **Print Struk** - Cetak struk transaksi
- **Multiple Payment Method** - Cash, Transfer, Card

### 📊 **Dashboard & Laporan**
- **Dashboard Statistik** - Real-time statistics
- **Alert Stok Rendah** - Notifikasi produk stok < 10
- **Riwayat Transaksi** - History lengkap
- **Top Products** - Produk terlaris
- **Quick Actions** - Akses cepat menu favorit

### 🔐 **Keamanan**
- **Authentication** - Login & Logout
- **Role-Based Access Control** - Admin & Kasir
- **CSRF Protection** - Laravel built-in security
- **Password Hashing** - Bcrypt encryption
- **Middleware Protection** - Route protection

### 🎨 **User Interface**
- **Responsive Design** - Desktop, tablet, mobile friendly
- **Modern UI** - Bootstrap 5 dengan gradient colors
- **Smooth Animation** - Transisi halus
- **Font Awesome Icons** - Icon support
- **Bootstrap Offline** - Tidak perlu internet untuk CSS

---

## 🗄️ **STRUKTUR DATABASE**

Sistem ini menggunakan **6 tabel** yang saling berelasi:

```
┌─────────────────┐
│     users       │
│─────────────────│
│ id              │
│ name            │
│ email           │
│ password        │
│ role            │
└─────────────────┘
         │
         │ user_id (FK)
         ↓
┌─────────────────┐      ┌──────────────────┐
│  transactions   │──────│ transaction_     │
│─────────────────│      │     details      │
│ id              │      │──────────────────│
│ customer_id (FK)│      │ id               │
│ user_id (FK)    │      │ transaction_id   │
│ invoice_number  │      │ product_id (FK)  │
│ total           │      │ quantity         │
└─────────────────┘      │ price            │
         │               └──────────────────┘
         │ customer_id (FK)        │
         ↓                         │ product_id (FK)
┌─────────────────┐                ↓
│   customers     │      ┌──────────────────┐
│─────────────────│      │    products      │
│ id              │      │──────────────────│
│ name            │      │ id               │
│ phone           │      │ category_id (FK) │
│ address         │      │ name             │
│ email           │      │ price            │
└─────────────────┘      │ stock            │
                         └──────────────────┘
                                  │
                                  │ category_id (FK)
                                  ↓
                         ┌──────────────────┐
                         │   categories     │
                         │──────────────────│
                         │ id               │
                         │ name             │
                         │ description      │
                         └──────────────────┘
```

---

## 📦 **REQUIREMENTS**

| Software | Versi Minimum | Recommended |
|----------|---------------|-------------|
| **PHP** | 8.2 | 8.3+ |
| **Composer** | 2.0 | Latest |
| **MySQL** | 5.7 | 8.0+ |
| **Laravel** | 12.x | 12.x |
| **Apache/Nginx** | - | Latest |

---

## 🚀 **CARA INSTALASI**

### **Metode 1: Menggunakan Migration & Seeder (Recommended)**

```bash
# 1. Clone atau extract project
cd petshop-laravel

# 2. Install dependencies
composer install

# 3. Copy file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Konfigurasi database di file .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_petshop
DB_USERNAME=root
DB_PASSWORD=

# 6. Buat database
mysql -u root -p
CREATE DATABASE db_petshop;
EXIT;

# 7. Jalankan migration
php artisan migrate

# 8. Jalankan seeder
php artisan db:seed

# 9. Create storage link
php artisan storage:link

# 10. Jalankan aplikasi
php artisan serve
```

### **Metode 2: Menggunakan File SQL**

```bash
# 1-5. Sama dengan Metode 1

# 6. Import file SQL
mysql -u root -p db_petshop < database/sql/db_petshop.sql

# 7. Create storage link
php artisan storage:link

# 8. Jalankan aplikasi
php artisan serve
```

Akses aplikasi di: **http://localhost:8000**

---

## 👤 **AKUN DEFAULT**

### **Admin**
- **Email:** `admin@petshop.com`
- **Password:** `password`
- **Akses:** Semua fitur termasuk manajemen user

### **Kasir 1**
- **Email:** `kasir@petshop.com`
- **Password:** `password`
- **Akses:** Dashboard, Kategori, Produk, Pelanggan, Transaksi

### **Kasir 2**
- **Email:** `kasir2@petshop.com`
- **Password:** `password`
- **Akses:** Dashboard, Kategori, Produk, Pelanggan, Transaksi

---

## 📱 **MENU SISTEM**

### **Menu Admin:**
1. 🏠 Dashboard (Statistik)
2. 📦 Kategori Produk (CRUD)
3. 🐾 Produk Petshop (CRUD + Upload)
4. 👥 Pelanggan (CRUD)
5. 🛒 Transaksi (POS System)
6. 📊 Laporan Transaksi
7. 👤 Manajemen User (Admin Only)
8. 🔓 Logout

### **Menu Kasir:**
1. 🏠 Dashboard (View Only)
2. 📦 Kategori Produk (View)
3. 🐾 Produk Petshop (View)
4. 👥 Pelanggan (CRUD)
5. 🛒 Transaksi (POS System)
6. 📊 Laporan Transaksi (View)
7. 🔓 Logout

---

## 📸 **SCREENSHOT**

### Login Page
Interface login modern dengan gradient background

### Dashboard
Dashboard dengan statistik real-time, alert stok rendah, transaksi terbaru, dan produk terlaris

### POS System
Point of Sale interaktif dengan keranjang belanja dan kalkulasi otomatis

### CRUD Pages
Tampilan CRUD yang clean dan user-friendly untuk semua modul

---

## 🔧 **TROUBLESHOOTING**

### **Error: Class 'CheckRole' not found**
```bash
# Register middleware di bootstrap/app.php
php artisan make:middleware CheckRole
```

### **Error: Storage link**
```bash
php artisan storage:link
```

### **Error: Permission denied**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

---

## 📚 **TEKNOLOGI YANG DIGUNAKAN**

- **Backend:** Laravel 12.x
- **Frontend:** Bootstrap 5.3, Font Awesome 6.4
- **Database:** MySQL 8.0
- **Authentication:** Laravel Breeze (Custom)
- **File Upload:** Laravel Storage
- **Security:** CSRF, Middleware, Password Hashing

---

## 📝 **CATATAN PENTING**

1. **File .env** tidak disertakan dalam repository untuk keamanan
2. Gunakan **.env.example** sebagai template
3. **Bootstrap offline** sudah tersedia di public/bootstrap
4. Pastikan **extension PHP** yang dibutuhkan sudah aktif:
   - PDO
   - Mbstring
   - OpenSSL
   - Tokenizer
   - XML
   - Ctype
   - JSON
   - BCMath
   - GD (untuk upload gambar)

---

## 👨‍💻 **DEVELOPER**

**Dibuat dengan ❤️ untuk keperluan pembelajaran dan pengembangan**

---

## 📄 **LISENSI**

Proyek ini dibuat untuk keperluan edukasi dan pembelajaran.

---

## 🙏 **CREDITS**

- [Laravel](https://laravel.com/) - PHP Framework
- [Bootstrap](https://getbootstrap.com/) - CSS Framework  
- [Font Awesome](https://fontawesome.com/) - Icon Library
- [MySQL](https://mysql.com/) - Database Management

---

## 📞 **SUPPORT**

Jika ada pertanyaan atau masalah, silakan buat issue di repository ini.

---

**⭐ Jika project ini bermanfaat, berikan star ya!**

---

© 2026 Petshop Management System - All Rights Reserved