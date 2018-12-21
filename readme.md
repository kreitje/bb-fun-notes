## BB Fun Notes

This is a fun application built on the Laravel framework and uses Vue.js


## Install

After cloning the repository, 

1. Copy the .env.example file to .env  and update the database credentials.
2. Run `composer install`
3. Run `npm install`
4. Run `php artisan key:generate`
5. Seed a demo user `php artisan db:seed --class DemoUser`
 - The demo user seed will create a user `demo@demo.com` with a password of `password`. It will also create a 
 few example notes.
 
 
 You can run `php artsan serve` to start a local webserver.