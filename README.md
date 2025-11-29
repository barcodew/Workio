# WORKIO – Job Portal Laravel

WORKIO adalah platform rekrutmen berbasis web yang membantu **perusahaan** menemukan talent terbaik, dan **pelamar** mencari pekerjaan sesuai minat, keahlian, dan lokasi.

Project ini dibuat dengan **Laravel** dan menggunakan template **JB Desks** yang sudah dikustom supaya tampil modern dan nyaman dipakai.

---

## ✨ Fitur Utama

### 👤 Untuk Pelamar
- Registrasi & login sebagai **pelamar**
- **Profil pelamar lengkap**  
  - Data pribadi, kontak, alamat  
  - Pendidikan  
  - Keterampilan (skills)  
  - Riwayat pekerjaan  
  - Upload & simpan CV
- **Progress kelengkapan profil** (persentase)
- Dashboard pelamar:
  - Ringkasan profil & statistik lamaran
  - Lamaran terakhir + status
  - Rekomendasi lowongan
- **Lamaran online**
  - Kirim lamaran untuk lowongan aktif
  - Upload CV baru atau pakai CV dari profil
  - Upload surat lamaran (optional)
- **Riwayat Lamaran**
  - Filter berdasarkan judul & status
  - Status dengan badge: *Dikirim, Diproses, Diterima, Ditolak*
  - Responsive (tabel → card di mobile)

### 🏢 Untuk Perusahaan
- Registrasi & login sebagai **perusahaan**
- Profil perusahaan:
  - Logo, nama, industri, jumlah karyawan
  - Alamat kantor, website, kontak
  - Deskripsi perusahaan
- Dashboard perusahaan:
  - **Kelola lowongan**
    - Buat, edit, hapus lowongan
    - Status lowongan: `draft`, `pending`, `published`, `closed`
    - Statistik lamaran per lowongan (total, dikirim, diproses, diterima, ditolak)
  - **Kelola pelamar per lowongan**
    - Lihat daftar pelamar
    - Download CV (file lamaran / CV profil)
    - Ubah status lamaran: `dikirim`, `diproses`, `diterima`, `ditolak`
    - Buka profil pelamar dengan tampilan cantik

### 🔔 Notifikasi & Otomasi
- **Email notifikasi ke pelamar** ketika status lamaran diperbarui  
  (view khusus: *LamaranStatusUpdated* dengan desain modern)
- **Email notifikasi ke perusahaan** ketika ada lamaran baru  
  (`NewLamaranSubmitted` notification)
- **Scheduler**:
  - Lowongan yang statusnya `published` dan sudah melewati **deadline**
    akan otomatis diubah menjadi `closed` setiap hari.

---

## 🧰 Tech Stack

- **Backend**: Laravel 11.x
- **Bahasa**: PHP 8.1+
- **Database**: MySQL / MariaDB
- **View**: Blade, Bootstrap
- **Auth**: Laravel default auth + role `pelamar` & `perusahaan`
- **Notifikasi**: Laravel Notifications (Mail)


---

## 📦 Requirements

- PHP ≥ 8.1 (extension: `openssl`, `pdo`, `mbstring`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`, dll.)
- Composer
- MySQL / MariaDB
- Web server (Apache / Nginx / cPanel / Laravel Valet / Laragon, dll.)

---

## 🚀 Instalasi Lokal

```bash
# 1. Clone repository
git clone https://github.com/barcodew/Workio.git
cd Workio

# 2. Install dependensi PHP
composer install

# 3. Salin .env dan generate APP_KEY
cp .env.example .env
php artisan key:generate
