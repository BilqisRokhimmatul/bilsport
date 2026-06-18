<div align="center">

# ⚽ BILSPORT

### Platform Penyewaan Lapangan Olahraga Terintegrasi di Jember

![Laravel](https://img.shields.io/badge/Laravel-12-red?style=for-the-badge\&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8+-blue?style=for-the-badge\&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge\&logo=mysql)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-v4-06B6D4?style=for-the-badge\&logo=tailwindcss)
![JavaScript](https://img.shields.io/badge/JavaScript-Vanilla-yellow?style=for-the-badge\&logo=javascript)

---

**Modern Sports Field Booking System**

BILSPORT merupakan platform reservasi lapangan olahraga berbasis web yang dirancang untuk mempermudah proses pemesanan lapangan secara digital, cepat, dan terintegrasi.

Sistem memungkinkan pelanggan melakukan reservasi secara mandiri, melihat jadwal yang tersedia secara real-time, melakukan pembayaran, serta memantau status penyewaan. Di sisi lain, admin dapat mengelola lapangan, memverifikasi transaksi, serta memantau performa bisnis melalui dashboard analitik interaktif.

---

✨ **Smart Booking • Real-Time Availability • Admin Dashboard • Weather Integration**

</div>

## 📚 Dokumentasi Project

| Dokumen | Link |
|----------|------|
| 📄 Laporan Project | [Lihat Laporan](https://drive.google.com/file/d/1zSx33dyt6hULCCjefJEL7Szr7jPVCaku/view?usp=sharing) |
| 🎥 Video Demo | [Lihat Demo](https://youtu.be/q3xqnvufqCE) |
| 🌐 Live Demo | [Kunjungi Website](https://bilsport-production.up.railway.app/) |

---

# 📖 Daftar Isi

* [Tentang Project](#-tentang-project)
* [Fitur Utama](#-fitur-utama)
* [Teknologi yang Digunakan](#-teknologi-yang-digunakan)
* [Arsitektur Sistem](#-arsitektur-sistem)
* [Struktur Database](#-struktur-database)
* [Daftar Halaman](#-daftar-halaman)
* [Akun Demo](#-akun-demo)
* [Instalasi](#-instalasi)
* [Kontributor](#-kontributor)

---

# 🎯 Tentang Project

Industri penyewaan lapangan olahraga masih banyak menggunakan metode pencatatan manual melalui telepon, pesan instan, atau buku reservasi. Proses tersebut rentan terhadap kesalahan pencatatan, bentrok jadwal, hingga kesulitan dalam pengelolaan transaksi.

BILSPORT hadir sebagai solusi digital yang menyediakan sistem reservasi lapangan olahraga berbasis web dengan fitur validasi jadwal otomatis, pengelolaan transaksi terintegrasi, serta dashboard administrasi yang informatif.

Melalui platform ini, pengguna dapat:

✅ Melihat ketersediaan lapangan secara real-time
✅ Melakukan reservasi secara online
✅ Mengunggah bukti pembayaran
✅ Memantau status transaksi
✅ Mengakses histori penyewaan

Sementara admin dapat:

✅ Mengelola data lapangan
✅ Memvalidasi pembayaran pelanggan
✅ Memantau statistik bisnis
✅ Mengelola status reservasi
✅ Melihat informasi cuaca lokal

---

# ✨ Fitur Utama

## 👤 Fitur Pelanggan

### 🔐 Authentication System

* Registrasi akun
* Login & Logout
* Session Management
* Role-based Access

### ⚽ Booking Lapangan

* Katalog lapangan berdasarkan jenis olahraga
* Informasi harga sewa per jam
* Pengecekan ketersediaan jadwal
* Validasi slot otomatis
* Pencegahan double booking

### 💳 Pembayaran

* Upload bukti transfer
* Status transaksi real-time
* Tracking proses verifikasi

### 📋 Riwayat Reservasi

* Histori penyewaan lengkap
* Monitoring status pesanan
* Detail transaksi

---

## 🛠️ Fitur Admin

### 📊 Dashboard Analitik

* Total pendapatan
* Total transaksi
* Jumlah lapangan aktif
* Ringkasan statistik bisnis

### 📈 Visualisasi Data

* Grafik pendapatan
* Tren transaksi
* Monitoring performa bisnis
* Integrasi Chart.js

### 🌦️ Informasi Cuaca

* Cuaca terkini wilayah Jember
* Dukungan operasional lapangan outdoor

### ⚙️ Manajemen Lapangan

* Tambah lapangan
* Edit informasi lapangan
* Pengaturan harga sewa
* Status perawatan lapangan

### ✅ Verifikasi Booking

* Approval transaksi
* Penolakan transaksi
* Manajemen status pesanan

---

# 🏗️ Arsitektur Sistem

```text
Pelanggan
    │
    ▼
Melihat Jadwal Lapangan
    │
    ▼
Pilih Lapangan & Jam Sewa
    │
    ▼
Upload Bukti Pembayaran
    │
    ▼
Status Pending
    │
    ▼
Verifikasi Admin
    │
 ┌──┴──┐
 ▼     ▼
Aktif  Ditolak
    │
    ▼
Selesai
```

---

# 🧰 Teknologi yang Digunakan

| Teknologi       | Kegunaan                  |
| --------------- | ------------------------- |
| Laravel 12      | Backend Framework         |
| PHP             | Server Side Programming   |
| MySQL           | Database Management       |
| Tailwind CSS v4 | UI Styling                |
| JavaScript      | Interaktivitas Frontend   |
| Chart.js        | Visualisasi Data          |
| OpenWeather API | Integrasi Informasi Cuaca |

---

# 🗄️ Struktur Database

## users

Menyimpan data akun pengguna dan administrator.

## lapangan

Menyimpan informasi lapangan olahraga yang tersedia.

## orders

Menyimpan data transaksi utama pelanggan.

## order_items

Menyimpan detail item pemesanan lapangan.

### Relasi Database

```text
users
 └── orders

lapangan
 └── order_items

orders
 └── order_items
```

---

# 📄 Daftar Halaman

| URL                       | Deskripsi          |
| ------------------------- | ------------------ |
| /                         | Halaman utama      |
| /login                    | Login pengguna     |
| /register                 | Registrasi akun    |
| /dashboard                | Dashboard pengguna |
| /lapangan                 | Katalog lapangan   |
| /booking                  | Form reservasi     |
| /riwayat                  | Histori transaksi  |
| /admin/booking-admin      | Verifikasi booking |
| /admin/lapangan/create    | Tambah lapangan    |
| /admin/lapangan/{id}/edit | Edit lapangan      |

---

# 🔑 Akun Demo

## Administrator

**Email**

```text
bilsport@gmail.com
```

**Password**

```text
admin123
```

---

## Pelanggan

**Email**

```text
vibiy@gmail.com
```

**Password**

```text
vibicantik
```

---

# 🚀 Instalasi

### Clone Repository

```bash
git clone https://github.com/BilqisRokhimmatul/bilsport.git
```

### Install Dependency

```bash
composer install
npm install
```

### Copy Environment

```bash
cp .env.example .env
```

### Generate Application Key

```bash
php artisan key:generate
```

### Migrasi Database

```bash
php artisan migrate
```

### Jalankan Server

```bash
php artisan serve
```

---

# 👨‍💻 Kontributor

**Bilqis Rokhimmatul Khajjah Mabruroh**

Mahasiswa Sistem Informasi
Universitas Jember
242410101051

---

