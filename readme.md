# URL Shortener

A simple URL Shortener application with Laravel.

## Installation

It's a Laravel 5.6 application with a very little functionality. You can install it as any other laravel 5.6 application. Here are the commands you need to run one by one-

```
git clone git@github.com:milon/url-shortener.git url
cd url
composer install
npm install
npm run dev
cp .env.example .env
php artisan key:generate
```

Then you need to put your database credentials in the .env file. After that run these-

```
php artisan migrate
php artisan serve
```

Then you can visit the url shortener in this url- `http://127.0.0.1:8000`

## Uses

This application can be used both in logged in or logged out state. But for using the full potential, you should logged in.

## Admin User

There is no way to create an admin user from the UI. You need change the value of `is_admin` in the users table directly from database to gain admin access.

You can also run `php artisan db:seed` to create an admin user with the following credentials-

| Name | Value |
|------|-----------|
| Name | Admin User |
| Email | admin@url-shortener.com |
| Password | password |

## Developer

Nuruzzaman Milon<br>
contact@milon.im<br>
<https://milon.im>

