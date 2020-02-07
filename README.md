# Laravel Restaurant

Aplikasi restoran dibuat menggunakan Laravel dan VueJS (hasil pra LSP)

## Installation

Use the package manager (composer) for installing

```bash
git clone https://github.com/zuramai/laravel-restaurant-lsp.git
cd laravel-restaurant-lsp
composer install
npm install
copy .env.example .env
php artisan key:generate
php artisan storage:link

# Lakukan dibawah ini jika sudah setting database di .env
php artisan migrate
php artisan db:seed
```
## Account Demo
Username: admin
Password: admin

Username: waiter
Password: waiter

Username: kasir
Password: kasir

Username: owner
Password: owner

Username: pelanggan
Password: pelanggan

## License
[MIT](https://choosealicense.com/licenses/mit/)
