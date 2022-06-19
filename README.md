<p align="center"><a href="https://optimasolution.co.id" target="_blank"><img src="https://optimasolution.co.id/oms/wp-content/uploads/sites/47/2018/06/s-soft-lg.png" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

Optima Templete v-2.2

## Setup Di Local

- Clone project :
```bash
git clone https://github.com/optima-team/optima-template-v2.git
```
- jalankan perintah (Install Core Laravel):
```bash
composer install
```
- buat file  <b>.env</b>  duplicat file  <b>.env.example</b>  jangan lupa rename jadi  <b>.env</b>
- buka file  <b>.env</b>  Rubah di bagian (Connection ke database kita):

```bash
DB_DATABASE=nama-database
DB_USERNAME=username-db
DB_PASSWORD=password-db
```
- jalankan perintah (Generate Key):

```bash
php artisan key:generate
```

- jalankan perintah (Fresh Migrasi dan Seeding tabel):

```bash
php artisan migrate:fresh --seed
```
- Done

## Menjalankan Aplikasi

```bash
php artisan serve
```

## Account Administrator Default

```bash
email : admin@siapsehat.com
password : 1234
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
