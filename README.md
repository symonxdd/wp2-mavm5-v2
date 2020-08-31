<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

##### 1. Framework
- Laravel

##### 2. Routes
- ###### routes\web.php
    - Route::get('/', 'AfspraakController@getIndex')->name('afspraak.index');
    - Route::get('/afspraken', 'AfspraakController@getAfspraken')->name('afspraak.afspraken');
    - Route::post('/wijzig-afspraak', 'AfspraakController@postWijzigAfspraak')->name('afspraak.wijzig');
    - Route::post('/add-afspraak', 'AfspraakController@postAddAfspraak')->name('afspraak.add');

##### 3. Server-sided validatie
- ###### app\Http\Controllers\AfspraakController.php **Ln 58 -> 68**
- ###### app\Http\Controllers\AfspraakController.php **Ln 110 -> 115**

##### 4. MySQL tabel-relatie
One-to-many tussen respectievelijk `patienten` en `afspraken`.
In Laravel kan er op twee manieren een Foreign key constraint gelegd worden:
1. Enerzijds op de Eloquent ORM modellen. Hiermee kunnen queries gemaakt worden via de modellen zelf;
2. Anderzijds op de werkelijke MySQL-tabellen.
In mijn geval heb ik de tweede manier gehanteerd met volgende code:

```php
$table->unsignedBigInteger('patient_id');
$table->foreign('patient_id')->references('id')->on('patienten');
```
We leggen een FK constraint op de `patient_id` kolom van tabel `afspraken`; die verwijst naar de kolom `id` in tabel `patienten`. De kolom waarop een FK word gezet moet in MySQL van type `unsignedBigInteger` zijn.

Dit zit in de `afspraken`-**migration** in `database\migrations\2020_08_02_130731_create_afspraken_table.php`

#### MySQL-code

###### Tabel `patienten` creëren:
```sql
DROP TABLE IF EXISTS `patienten`;
CREATE TABLE IF NOT EXISTS `patienten` (
      `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
      `voornaam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `naam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      `contact_met_coronavirus` tinyint(1) NOT NULL,
      `created_at` timestamp NULL DEFAULT NULL,
      `updated_at` timestamp NULL DEFAULT NULL,
      PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

###### Tabel `patienten` vullen:
```sql
INSERT INTO `patienten` (`id`, `voornaam`, `naam`, `contact_met_coronavirus`, `created_at`, `updated_at`) VALUES
(1, 'Ellemieke', 'Dingemans', 1, '2020-08-14 19:53:54', '2020-08-14 19:53:54'),
(2, 'Lisanne', 'Boonstra', 1, '2020-08-14 19:53:54', '2020-08-14 19:53:54'),
(3, 'Mirre', 'Keijzers', 0, '2020-08-14 19:53:54', '2020-08-14 19:53:54'),
(4, 'Dineke Jansen', 'van Martens', 1, '2020-08-14 19:53:54', '2020-08-14 19:53:54'),
(5, 'Noud', 'van Dongen', 0, '2020-08-14 19:53:54', '2020-08-14 19:53:54'),
(6, 'Maaike', 'Schansert', 1, '2020-08-14 19:53:54', '2020-08-14 19:53:54'),
(7, 'Gerrit-Jan', 'Belderman', 1, '2020-08-14 19:53:54', '2020-08-14 19:53:54');
```

---

###### Tabel `afspraken` creëren:
```sql
DROP TABLE IF EXISTS `afspraken`;
CREATE TABLE IF NOT EXISTS `afspraken` (
      `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
      `datum` date NOT NULL,
      `tijdstip` time NOT NULL,
      `patient_id` bigint(20) UNSIGNED NOT NULL,
      `created_at` timestamp NULL DEFAULT NULL,
      `updated_at` timestamp NULL DEFAULT NULL,
      PRIMARY KEY (`id`),
      KEY `afspraken_patient_id_foreign` (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

###### Tabel `afspraken` vullen:
```sql
INSERT INTO `afspraken` (`id`, `datum`, `tijdstip`, `patient_id`, `created_at`, `updated_at`) VALUES
(1, '2020-08-18', '19:59:00', 6, '2020-08-14 19:53:54', '2020-08-14 19:53:54'),
(2, '2020-10-02', '13:25:00', 2, '2020-08-14 19:53:54', '2020-08-14 19:53:54'),
(3, '2020-10-28', '14:35:00', 7, '2020-08-14 19:53:54', '2020-08-14 19:53:54'),
(4, '2020-11-17', '14:50:00', 3, '2020-08-14 19:53:54', '2020-08-14 19:53:54'),
(5, '2020-11-27', '16:55:00', 1, '2020-08-14 19:53:54', '2020-08-14 19:53:54'),
(6, '2020-10-20', '10:45:00', 5, '2020-08-14 19:53:54', '2020-08-14 19:53:54'),
(7, '2020-10-26', '11:15:00', 3, '2020-08-14 19:53:54', '2020-08-14 19:53:54'),
(8, '2020-10-27', '12:25:00', 4, '2020-08-14 19:53:54', '2020-08-14 19:53:54'),
(9, '2020-11-19', '14:55:00', 6, '2020-08-14 19:53:54', '2020-08-14 19:53:54'),
(10, '2020-12-08', '16:00:00', 6, '2020-08-14 19:53:54', '2020-08-14 19:53:54');
```

###### FK zetten op tabel `afspraken`:
```sql
ALTER TABLE `afspraken`
ADD CONSTRAINT `afspraken_patient_id_foreign` FOREIGN KEY (`patient_id`) REFERENCES `patienten` (`id`);
```

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
