CoolAir Web Application
Description

CoolAir is a web application for managing air conditioners. Built with Laravel.

Requirements

PHP >= 8.0

Composer

MySQL

Node.js & NPM (for front-end assets)

Web server (XAMPP)

Installation

Clone the repository

git clone https://github.com/ayaelbadry/cool-air-web-site.git
cd coolair

Install PHP dependencies

composer install

Install Node dependencies

npm install

Copy .env file

cp .env.example .env

Generate application key

php artisan key:generate

Set up database

Create a MySQL database (e.g., coolair_2502)

Update .env with database name, username, password

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=coolair_2502
DB_USERNAME=root
DB_PASSWORD=

Run migrations 

php artisan migrate 

Compile front-end assets

npm run dev
Running the Application
php artisan serve

Open your browser at http://127.0.0.1:8000

Project Structure

app/Models - Eloquent models

app/Http/Controllers - Controllers

resources/views - Blade templates

routes/web.php - Web routes

public/ - Assets

Notes

Admin panel is under http://127.0.0.1:8000/admin

Make sure database credentials match .env

Run php artisan migrate:fresh       to reset database