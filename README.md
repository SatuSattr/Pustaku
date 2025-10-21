# 📚 Pustaku — Library Management System

**Pustaku** adalah platform manajemen perpustakaan berbasis web yang dibangun dengan Laravel 12. Proyek ini memfasilitasi dua jenis pengguna:

- **Admin** – mengelola katalog buku, stok, serta status peminjaman.
- **Siswa** – menjelajahi koleksi buku ala toko daring, membaca detail, dan mengajukan peminjaman secara daring.

Dengan tampilan modern berbasis TailwindCSS, Pustaku menghadirkan pengalaman yang familiar seperti marketplace buku namun ditujukan untuk kebutuhan perpustakaan sekolah.

---

## ✨ Fitur Utama

- 👤 **Autentikasi Berbasis Peran** – Login menggunakan username dengan hak akses Admin & Siswa (Laravel Breeze).
- 📚 **Manajemen Buku Lengkap** – CRUD buku, unggah cover, atur kategori, dan status ketersediaan.
- 🗂️ **Kontrol Peminjaman** – Admin memantau status (_processing_, _borrowed_, _returned_) lengkap dengan history.
- 🛒 **Katalog Interaktif** – Siswa dapat mencari, memfilter, dan melihat detail buku ala kartu e-commerce.
- 📝 **Form Peminjaman Dinamis** – Validasi stok otomatis, serta form akan muncul setelah siswa login atau registrasi.
- 📊 **Dashboard Statistik** – Ringkasan koleksi, aktivitas peminjaman terakhir, dan shortcut aksi cepat untuk admin.

---

## 🛠️ Teknologi

- ⚙️ **Laravel 12** – Framework backend utama.
- 🔐 **Laravel Breeze** – Scaffolding autentikasi berbasis Blade & Tailwind.
- 💾 **SQLite** – Basis data ringan untuk kemudahan distribusi.
- 🎨 **TailwindCSS** – Utility-first styling dengan Vite.
- 🧪 **Pest / PHPUnit** – Unit & feature testing.

---

## 🚀 Instalasi & Setup

> Pastikan PHP ≥ 8.2, Composer, Node.js ≥ 18, dan npm sudah terpasang.

```bash
# 1. Clone repository
git clone https://github.com/username/pustaku.git
cd pustaku

# 2. Install dependency PHP
composer install

# 3. Salin konfigurasi lingkungan
cp .env.example .env
php artisan key:generate

# 4. Siapkan basis data SQLite
touch database/database.sqlite

# 5. Migrasi & seeding data awal (admin + katalog buku)
php artisan migrate --seed

# 6. Install dan build asset frontend
npm install
npm run dev   # gunakan npm run build untuk produksi

# 7. Jalankan aplikasi
php artisan serve
```

### 🔑 Kredensial Default

| Peran  | Username | Password  |
| ------ | -------- | ---------- |
| Admin  | `admin`  | `password` |

Setelah login sebagai admin, kamu bisa menambah akun siswa atau meminta siswa mendaftar sendiri melalui landing page.

---

## 📸 Galeri Antarmuka

<table>
  <tr>
    <td><img src="https://placehold.co/600x400?text=Landing+Hero" alt="Landing Hero" /></td>
    <td><img src="https://placehold.co/600x400?text=Catalogue+Grid" alt="Catalogue Grid" /></td>
  </tr>
  <tr>
    <td><img src="https://placehold.co/600x400?text=Book+Detail" alt="Book Detail" /></td>
    <td><img src="https://placehold.co/600x400?text=Borrow+Form" alt="Borrow Form" /></td>
  </tr>
  <tr>
    <td><img src="https://placehold.co/600x400?text=Admin+Dashboard" alt="Admin Dashboard" /></td>
    <td><img src="https://placehold.co/600x400?text=Book+Management" alt="Book Management" /></td>
  </tr>
</table>

> 🖼️ Ganti URL placeholder di atas dengan screenshot final sesuai kebutuhanmu.

---

## 🧪 Testing

Jalankan seluruh feature & unit test dengan:

```bash
php artisan test
```

---

## 🤝 Kontribusi

Saran fitur atau perbaikan tampilan? Silakan buat _issue_ atau _pull request_.

---

Selamat menggunakan **Pustaku**. Semoga membantu digitalisasi perpustakaan sekolahmu! 🚀
