<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## E-signature app

This application is dedicated to demonstrate simple e-signature functionality.

## Installation

### Requirements
- Preferably Unix system
- Installed `Docker`
- Installed `Docker-Compose`
- Installed `GNU Make`

These requirements will help to install the project with the fastest way.

### Step 1

It is required to add virtual host into the `/etc/hosts` file (for Unix systems).
For Windows systems it is located in `C:\Windows\System32\drivers\etc\hosts`.
Please add these lines into it:
```text
127.0.0.1   e-signature.local
```

### Step 2

If the project has never been run before - please use this command:
```bash
make first-run
```
If the `GNU Make` utility is not installed run this:
```bash
cp .env.example .env
docker-compose build app
docker-compose up -d
docker exec -it e-sign-app bash -c "composer install && php artisan migrate"
docker exec -it e-sign-app bash -c "php artisan passport:install --no-interaction"
```
_To rebuild the already installed application this line could be in handy:_
```bash
make run
```

### Step 3

By default, the application use `8012` port for hosting and `3409` port for MySQL database.
So the proper url for using the project would be `http://e-signature.local:8012`.

If the app is not running - please change these ports in the `.env` file
or kill the processes that are using the ports.

## Documentation

- Swagger documentation has an access by the url `http://e-signature.local:8012/api/documentation`
- Postman documentation json collection is located in `./storate/postman`.
It is possible to import this file in the Postman Client (Web or Desktop)

### Test Flow

- Register user `/user/register` specifying unique username and password
- Login user `/user/login` specifying registered username and password. Save the token.
- Upload file `/file/upload` attaching PDF file as multipart/form-data.
Use auth token received from login. Save file id.
- Add document `/document/add` specifying title and file id. User auth token. Save document id.
- Register user #2 `/user/register` with another credentials
- Create signature request specifying document id and signatory user id (user #2). Use token.
- Login as user #2 `/user/login` and save user #2 token
- Sign the document `/document/sign` specifying document id received from 5th step
