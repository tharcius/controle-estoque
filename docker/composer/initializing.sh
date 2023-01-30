#!/bin/sh
cd /var/www
composer install
touch ./database/database.sqlite
php artisan migrate --env=testing

