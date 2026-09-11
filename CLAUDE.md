# Product Requirements Document (PRD)
## Toko Online Sederhana

| | |
|---|---|
| **Versi** | 1.0 |
| **Jenis Produk** | Website E-Commerce (Single Store, Multi Buyer) |
| **Stack** | Laravel (MVC, Blade, Eloquent ORM) |
| **Konteks** | Proyek pembelajaran — Pemrograman Web dan Perangkat Bergerak, Kelas XI RPL |

---

## 1. Latar Belakang

Aplikasi ini merepresentasikan **satu toko** yang menjual produknya ke **banyak pembeli** — bukan marketplace multi-penjual. Siapa pun bisa melihat katalog produk tanpa login, tapi harus login untuk melakukan checkout. Ada dua peran: **Admin** (kelola produk & pesanan) dan **Pembeli** (checkout & pantau pesanan sendiri).

## 2. Tujuan Produk

- Menyediakan katalog produk yang bisa diakses publik.
- Memungkinkan pembeli terdaftar melakukan pemesanan dengan dua metode pembayaran (COD dan transfer).
- Memberikan admin kontrol penuh atas data produk dan status pesanan.
- Menerapkan pemisahan akses berbasis peran (admin vs pembeli) melalui middleware.

## 3. Aktor / User Roles

| Role | Deskripsi |
|---|---|
| **Guest (belum login)** | Bisa melihat landing page dan katalog produk. Tidak bisa checkout. |
| **Pembeli** | Bisa checkout, memilih metode pembayaran, dan memantau pesanan miliknya sendiri. |
| **Admin** | Bisa mengelola produk (CRUD) dan mengubah status pengiriman seluruh pesanan yang masuk. |

## 4. Functional Requirements

| ID | Fitur | Deskripsi | Role |
|---|---|---|---|
| FR-1 | Landing Page | Menampilkan seluruh produk toko (nama, gambar, harga, stok) dengan tombol Checkout di tiap produk | Umum |
| FR-2 | Register & Login | Pembeli dapat membuat akun dan masuk ke sistem | Pembeli |
| FR-3 | Middleware Cek Login | Checkout hanya bisa diakses user yang sudah login; jika belum, tampilkan alert dan redirect ke halaman login | Pembeli |
| FR-4 | Checkout / Pemesanan | Menyimpan pesanan baru (produk, jumlah, pembeli, alamat) dengan status awal `Menunggu Pembayaran` | Pembeli |
| FR-5 | Pemilihan Metode Pembayaran | Pembeli memilih COD atau Transfer; jika Transfer, wajib mengunggah bukti pembayaran | Pembeli |
| FR-6 | Kelola Produk (CRUD) | Admin dapat menambah, mengubah, menghapus data produk | Admin |
| FR-7 | Daftar Pesanan Masuk | Admin dapat melihat seluruh pesanan beserta identitas pembeli | Admin |
| FR-8 | Ubah Status Pengiriman | Admin memperbarui status pesanan: `Diproses → Dikirim → Selesai` (atau `Dibatalkan`) | Admin |
| FR-9 | Middleware Otorisasi Admin | Seluruh halaman admin hanya bisa diakses role `admin` | Admin |
| FR-10 | Halaman Pesanan Saya | Pembeli melihat riwayat & status pesanan miliknya sendiri saja | Pembeli |

## 5. Alur Sistem (User Flow)

1. Pembeli membuka landing page dan melihat katalog produk tanpa perlu login.
2. Pembeli menekan tombol **Checkout** pada produk yang diinginkan.
3. Middleware memeriksa status login:
   - Belum login → alert "Anda harus login terlebih dahulu" → redirect ke halaman login.
   - Sudah login → lanjut ke form checkout.
4. Sistem menyimpan pesanan baru dengan status `Menunggu Pembayaran`.
5. Pembeli memilih metode pembayaran: **COD** atau **Transfer**.
   - Jika Transfer, pembeli mengunggah gambar bukti pembayaran.
6. Admin login ke panel admin dan melihat daftar pesanan masuk beserta identitas pembeli.
7. Admin memperbarui status pesanan sesuai perkembangan pengiriman.
8. Pembeli login dan membuka halaman **Pesanan Saya** untuk memantau status pesanannya.

## 6. Data Model

### Entitas Utama

**User**
- `id`, `nama_lengkap`, `nickname`, `email`, `password`, `role`

**Alamat**
- `id`, `alamat`, `kecamatan`, `kota`, `provinsi`, `kode_pos`
- FK: `user_id` → satu user bisa punya banyak alamat

**Produk**
- `id`, `nama_produk`, `harga`, `stok`, `deskripsi`, `image`

**Pesanan**
- `id`, `total_harga`, `kuantitas`, `tipe` ENUM(`cod`, `transfer`), `bukti_pembayaran` (nullable, wajib jika tipe = transfer), `status` ENUM(`Menunggu Pembayaran`, `Diproses`, `Dikirim`, `Selesai`, `Dibatalkan`)
- FK: `user_id`, `produk_id`, `alamat_id`

### Relasi

| Dari | Ke | Jenis Relasi | Keterangan |
|---|---|---|---|
| User | Alamat | hasMany / belongsTo | Satu user punya banyak alamat |
| User | Pesanan | hasMany / belongsTo | Satu user punya banyak pesanan |
| Alamat | Pesanan | hasMany / belongsTo | Alamat dipilih & di-snapshot saat checkout |
| Produk | Pesanan | hasMany / belongsTo | Satu produk dipesan di banyak pesanan |

## 7. Non-Functional Requirements

- **Arsitektur:** MVC dengan Laravel, tampilan menggunakan Blade Templating.
- **Autentikasi:** Laravel built-in auth (atau Breeze/Fortify) untuk register/login.
- **Otorisasi:** Middleware berbasis `role` (admin/pembeli) untuk membatasi akses halaman admin.
- **Validasi:** Form request validation, terutama untuk bukti pembayaran wajib saat metode transfer.
- **Keamanan:** Password di-hash, akses data pesanan dibatasi hanya untuk pemiliknya (kecuali admin).

## 8. Out of Scope

- Tidak ada fitur keranjang belanja multi-produk (checkout dilakukan per produk).
- Tidak ada payment gateway otomatis — verifikasi transfer dilakukan manual oleh admin.
- Tidak ada fitur multi-toko/multi-penjual (marketplace).
- Tidak ada sistem rating/ulasan produk.