# PCMS

Multi language cms use laravel framework.

## Requirements

- Laravel 7.0.7
- elFinder 2.1.50
- ckeditor 4.13.0
- Bootstrap - SB Admin 2 v4.0.7 [Overview](https://startbootstrap.com/template-overviews/sb-admin-2)
- Bootstrap v4.3.1 [Overview](https://getbootstrap.com)
- jQuery 3.5.0 

## Command
หลังจาก clone project แล้วใช้คำสั่ง

- Install composer `composer install` 
- Install npm package `npm install`
- Copy and edit .env file from .env.example `cp .env.example .env`
- Generate project key `php artisan key:generate`

## Laravel Command

[Laravel](https://laravel.com)

    //สร้าง model พร้อม migrate
    php artisan make:model <modelname> -m
    
    //สร้าง seed ของ model
    php artisan make:seeder <modelname>TableSeeder
    
    //migrate database and use seed data
    php artisan migrate:refresh --seed -v
    
    ถ้าเพิ่ม seed ใหม่ ใช้คำสั่ง  
    composer dump-autoload
    
    สั่ง migrate เฉพาะ table 
    1. สร้าง folder ใน folder migrations
    2. Copyไฟล์ migration ไปไว้ใน folder ที่สร้างใหม่
    3. php artisan migrate --path=/database/migrations/<folder>

## Module

1. User (Admin)
2. Customer
3. Category (content,product) [TH,EN]
4. Content [TH,EN]
5. Product [TH,EN]
6. Order
7. Slip
8. Coupon
9. Asset Management
10. SEO
