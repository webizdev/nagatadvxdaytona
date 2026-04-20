# Product Requirements Document (PRD)
## Proyek: E-Catalog & Company Profile Sparepart Motor (Daytona Clone)

### 1. Ringkasan Proyek
Proyek ini bertujuan untuk membangun sebuah website katalog digital dan profil perusahaan untuk produk suku cadang sepeda motor berperforma tinggi. Website ini dirancang untuk memudahkan konsumen dan dealer mencari produk secara spesifik hingga 3 tingkat kategori mendalam, serta melihat kecocokan suku cadang dengan tipe motor tertentu.

### 2. Tech Stack (Teknologi yang Digunakan)
Untuk memudahkan AI (Gemini) dalam menghasilkan kode yang bersih, aman, dan standar industri, kita akan menggunakan:
* **Backend & Framework:** PHP 8.x dengan Laravel 10/11.
* **Frontend UI:** Tailwind CSS (untuk styling) dan Alpine.js (untuk interaktivitas ringan seperti dropdown).
* **Database:** MySQL.
* **Pola Arsitektur:** MVC (Model-View-Controller).

### 3. Struktur Halaman (Sitemap)
* **Public Area (Pengunjung):**
    * Beranda (Home)
    * Tentang Kami (About)
    * Katalog Produk (Products)
        * Halaman Detail Produk
    * Berita/Blog (News)
    * Lokasi Dealer (Where to Buy)
    * Hubungi Kami (Contact)
* **Admin Panel (Manajemen):**
    * Dashboard
    * Manajemen Kategori (3 Level)
    * Manajemen Produk & Spesifikasi
    * Manajemen Kecocokan Motor (Compatibility)
    * Manajemen Berita/Artikel

### 4. Struktur Kategori 3 Lapis (Hierarki)
Sistem menggunakan satu tabel kategori dengan sistem `parent_id` untuk mencapai 3 lapis (Level 1 > Level 2 > Level 3 > Produk).
* **Level 1 (Sistem Utama):** *Engine Parts*
* **Level 2 (Sub-sistem):** *Cylinder & Piston*
* **Level 3 (Jenis Komponen):** *Piston Kit*
* **Produk Spesifik:** *Forged Piston 58mm NMAX*

### 5. Skema Database MySQL (Core Tables)

**Tabel `categories`**
* `id` (PK)
* `parent_id` (FK ke id di tabel yang sama, Nullable) -> *Kunci untuk 3 layer*
* `name` (VARCHAR)
* `slug` (VARCHAR, Unique)

**Tabel `products`**
* `id` (PK)
* `category_id` (FK ke categories.id - harus merujuk ke Level 3)
* `sku` (VARCHAR, Unique)
* `name` (VARCHAR)
* `slug` (VARCHAR, Unique)
* `description` (TEXT)
* `image_path` (VARCHAR)

**Tabel `product_specifications`** (Untuk data teknis)
* `id` (PK)
* `product_id` (FK ke products.id)
* `spec_key` (VARCHAR) -> cth: "Diameter", "Material"
* `spec_value` (VARCHAR) -> cth: "58mm", "Forged Alumunium"

**Tabel `motorcycle_models`** (Daftar motor yang ada)
* `id` (PK)
* `brand` (VARCHAR) -> cth: Yamaha
* `model_name` (VARCHAR) -> cth: NMAX 155

**Tabel `product_motorcycle`** (Tabel Pivot/Relasi untuk Kecocokan)
* `product_id` (FK)
* `motorcycle_id` (FK)

