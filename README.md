# Aplikasi Peminjaman Ruangan

Aplikasi ini dibuat dengan framework Codeigniter 4 versi 4.0.0


## Instalasi Project

- Download Project
```bash
  git clone https://github.com/itsmhyne/database-migration-ci4.git
```
- Konfigurasi Database pada file App/Config/Database.php
- Sesuaikan untuk nama database dan password jika ada. Nama database default adalah learn jika nama dan database learn belum ada silakan buat database learn terlebih dahulu. Nama database tidak harus bernama learn, bisa bernam lain selama database itu ada dalam komputer anda 
- Jalankan Migrasi Database
```bash
  php spark migrate
```
- Jalankan Seeder Database
```bash
  php spark db:seed Dummy
```
- Aplikasi siap digunakan
```bash
  localhost/nama_project
```
## Konfigurasi Aplikasi

#### Ubah nama aplikasi

- Buka folder app/Config/Constants.php
- Pada line 16, ubah menjadi
```bash
defined('APP_NAME') || define('APP_NAME', 'Nama Aplikasimu');
```

#### Ubah icon aplikasi
- Pilih icon yang akan dijadikan icon aplikasi
- pindahkan icon ke folder public/assets/icon/
- Buka folder app/Config/Constants.php
- Pada line 15, ubah menjadi
```bash
defined('APP_ICON') || define('APP_ICON', 'Nama Ikonmu.png');
```

## Fitur

- Login Administrator dan Komunitas
- Registrasi Member
- Dasboard peminjaman
- Pengaturan Ruangan
- Pengaturan Akun Administrator
- Peminjaman Ruangan
- Peminjaman Auto Dikembalikan Ketika Session Berakhir
- Grafik Peminjaman
- Export PDF Peminjaman User
