# 🛍️ AlkesStore — E-Commerce Alat Kesehatan

Proyek ini merupakan aplikasi e-commerce berbasis **Laravel 12** dengan fitur multi-role antara **User (Pembeli)** dan **Vendor (Penjual)**.  
Vendor dapat mengelola produk, melihat laporan penjualan otomatis, sedangkan user dapat berbelanja, mengelola keranjang, dan melakukan checkout.

---

## 🚀 Fitur Utama

### 👤 User (Pembeli)

-   Registrasi & Login
-   Melihat daftar produk
-   Menambahkan produk ke keranjang
-   Menghapus item dari keranjang
-   Melakukan checkout
-   Melihat riwayat pesanan

### 🏪 Vendor (Penjual)

-   Manajemen toko & produk
-   Melihat laporan penjualan otomatis berdasarkan bulan
-   Menghapus laporan yang tidak diinginkan

### 👑 Admin

-   Menggunakan **Admin Panel** untuk memantau user, vendor, produk, dan laporan

---

## 🧩 Teknologi yang Digunakan

| Komponen          | Teknologi                                      |
| ----------------- | ---------------------------------------------- |
| Framework         | Laravel 12                                     |
| Styling Framework | Bootstrap 5                                    |
| Database          | MySQL                                          |
| Library Tambahan  | Carbon, Eloquent Relationships, Blade Template |

---

## 🧱 Struktur Fitur

### 📦 Model

-   **User** — akun pembeli dan vendor
-   **Shop** — data toko milik vendor
-   **Product** — data produk yang dijual
-   **Cart** — keranjang belanja user
-   **Order** — transaksi pesanan user
-   **OrderItem** — detail produk dalam pesanan
-   **Report** — laporan penjualan vendor per bulan

---

## ⚙️ Instalasi Proyek

### 1️⃣ Clone Repository

```bash
git clone https://github.com/Ivunnn/AlkesStore.git
cd AlkesStore

composer install
npm install && npm run dev

cp .env.example .env

DB_CONNECTION=mysql
DB_DATABASE=ecommerce
DB_USERNAME=root
DB_PASSWORD=

php artisan key:generate
php artisan migrate --seed

php artisan serve
```
