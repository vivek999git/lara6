# Laravel Project

This is a Laravel-based web application.

## Requirements

- PHP 8.x
- Composer
- MySQL / PostgreSQL
- Node.js & NPM

## Setup

```bash
git clone https://github.com/your-username/your-repo-name.git
cd your-repo-name
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install && npm run dev
php artisan serve

##Steps & Approch
Create the Project
laravel new lara6

Create/Install API 
php artisan install:api

Create Controller,model,migration
php artisan make:controller UserController
php artisan make:model User
php artisan make:model User_location
php artisan make:model User_detail

php artisan make:migration Create_User_detail_table
php artisan migrate

Add Routes 
add command & schedule
php artisan make:command CheckTask 

Add app/console/command/kernal.php
$schedule->command(\App\Console\Commands\CheckTask::class)->everyMinute();

php artisan schedule:work
php artisan schedule:run

PostMan

To Fetch the Records
URL: /api/getData
Method:GET
 

To search the Records
URL: /api/searchData
Method:GET
Body->raw:JSON
{
 
    "gender":"male",
    "city":"Hartola",
    "country":""
 
}







