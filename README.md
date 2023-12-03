# ANALISIS KEBUTUHAN SISTEM PADA APLIKASI FORUM DISKUSI

## A. Requirement

Aplikasi Forum Diskusi ini menggunakan [CodeIgniter](https://www.codeigniter.com/download) 4.4.3 dan PHP 8.1.

### a. Prasyarat
1. [PHP](https://www.php.net/downloads.php) 7.4 atau versi diatasnya.
2. [Composer](https://getcomposer.org/).
3. [GIT](https://git-scm.com/).
4. Local Server ([XAMPP](https://www.apachefriends.org/download.html) atau [Laragon](https://laragon.org/download/index.html)).
5. Extenstion PHP: intl, mbstring.

### b. Instalasi
1. Clone repository dengan cara buka folder `htdocs` atau `www` (jika kamu menggunakan laragon). Lalu klik kanan, pilih git bash here habis itu, ketikkan atau copas `git clone https://github.com/fahrianggara/codehub.git`.
2. Jika sudah, ketikkan `cd codehub` untuk masuk ke folder yang baru di clone, lalu jalankan perintah `composer install` atau bisa juga `composer update`.
3. Sekarang buka phpmyadmin untuk membuat database baru dengan nama `ci_forum`.
4. Jika sudah, balik lagi ke terminal git bash lalu ketikkan `code .` Untuk membuka text editor (vscode).
5. Ganti file `.env.example` jadi `.env`.
6. Konfigurasikan file `.env` sebagai berikut:
```env
# --------------------------------------------------------------------
# ENVIRONMENT
# --------------------------------------------------------------------

CI_ENVIRONMENT = development

# --------------------------------------------------------------------
# APP
# --------------------------------------------------------------------

app.baseURL = 'http://localhost:8080'
# If you have trouble with `.`, you could also use `_`.
# app_baseURL = ''
# app.forceGlobalSecureRequests = false
# app.CSPEnabled = false

# --------------------------------------------------------------------
# DATABASE
# --------------------------------------------------------------------

database.default.hostname = localhost
database.default.database = ci_forum
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
# database.default.DBPrefix =
# database.default.port = 3306
```
7. Balik ke git bash terminal lalu ketikkan perintah `php spark migrate` jika sudah, ketikkan lagi `php spark db:seed Run`. Dan jangan lupa untuk mengaktifkan MySQL pada Local Server.
8. Selanjutnya jalankan/ketikkan perintah `php spark serve` Dan aplikasi Forum Diskusi akan berjalan pada url `http://localhost:8080`.

### c. Fitur

#### Guest / Pengunjung

- [X] Melihat Diskusi
- [X] Memfilter Diskusi
- [X] Membagikan Diskusi
- [X] Mencari Diskusi

#### User / Pengguna

- [X] Autentikasi (Register, Login & Logout)
- [X] Mengedit proϐile sendiri Seperti: Data sendiri, Avatar, Banner dan Password 
- [X] Kelola atau CRUD + Draft/Publish Diskusinya (diri sendiri)
- [X] Menyukai Diskusi 
- [X] Melaporkan Diskusi 
- [X] Membalas Diskusi dan Bisa di Kelola Balasannya (diri sendiri)
- [X] Sama seperti Guest (Melihat, Memfilter, Membagikan dan Mencari Diskusi)

#### Admin / Pengelola

- [X] Sama seperti User Requirement-nya
- [X] Masuk ke Halaman Dashboard
- [X] Kelola atau CRUD Pengguna 
- [X] Kelola atau CRUD Diskusi Pengguna
- [X] Kelola atau CRUD Kategori Diskusi
- [X] Kelola atau CRUD Tagar Diskusi
- [X] Memantau dan Hapus Laporan dari pengguna

## Entity Relationship Table (ERD)

![ERD](https://raw.githubusercontent.com/fahrianggara/codehub/main/public/images/erd.png)

## Kontributor

- [10220009 - Fahri Anggara](https://fahrianggara.my.id/)
- [10220014 - Dimas Yusuf Hidayat](https://www.instagram.com/dms.yusuf/)
- [10220046 - Fakhri Akmal Fadillah](https://www.instagram.com/fakhriakm/)
- [10220048 - Ilham Ramadhan](https://www.instagram.com/rmdhan_ilhmmm/)
- [10220078 - Sultan Jordy Priadi](https://discord.com/users/745459226482049057)
