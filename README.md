<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Serve
1. Choose a software stack (these instructions are for WAMP using MySQL)
2. Either place the project in the www folder of WAMP; or create a [VirtualHost](http://codedecode.co.in/blog/wordpress/set-up-virtual-host-with-wamp/) for it.
3. In project folder:
    1. Rename `.env.example` to `.env`
    2. Open it with a text editor en change the value of `DB_DATABASE` to `afspraken_database`
    (3. You might also have to change the DB_PORT variable, this is the port that your active Database listens to, either MySQL or MariaDB. You can find the active port by right-clicking the WAMP-icon in taskbar and going to Tools. There you'll find e.g 'Port used by MySQL: 3306')
    
4. Create the database `afspraken_database` via phpMyAdmin
    1. Navigate to http://localhost/phpmyadmin/
        - Username: root
        - Password: \<empty\>
        - Server Choice: MySQL
    2. Click New, enter `afspraken_database` and click Create  
    
5. `composer install && php artisan key:generate && php artisan migrate && php artisan db:seed`

In case of problems with migrations: `php artisan migrate:reset && php artisan migrate`

Also, I added these as scripts to package.json:
- `php artisan migrate:reset`
- `php artisan migrate`
- `php artisan db:seed`
- `composer dump-autoload`
