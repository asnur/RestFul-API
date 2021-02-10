# RESTful API CodeIgniter 4

# Instalasi
1. Rename File env menjadi .env lalu ubah Environment Dari Production ke Development
2. Buat Table Database Melalui Migration dengan mengetikan perintah 
```bash
php spark migrate
```
3. Selanjut Seed data member & user ke database dengan mengetikan perintah
```bash
php spark db:seed user member
```
4. Maka data siap untuk di testing

# Plugin Yang Tersedia
1. [faker](https://github.com/fzaninotto/Faker)
2. [JWT-Json_web_token](https://github.com/firebase/php-jwt)

## Persyaratan Server

PHP versi 7.3 atau lebih tinggi diperlukan, dengan ekstensi berikut diinstal:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) jika Anda berencana untuk menggunakan perpustakaan HTTP \ CURLRequest

Selain itu, pastikan ekstensi berikut diaktifkan di PHP Anda:

- json (diaktifkan secara default - jangan matikan)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (diaktifkan secara default - jangan matikan)
