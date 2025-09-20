#!/bin/bash

cd /mnt/calendar

if [ ! -f "composer.phar" ]; then
    wget https://getcomposer.org/download/2.8.6/composer.phar
fi

cp .env.example .env

service php8.4-fpm start
service nginx start
sleep 2
php composer.phar install

sleep 2

php artisan key:generate

chmod -R 777 /mnt/calendar/storage
chmod -R 777 /mnt/calendar/bootstrap/cache

sleep 2
# Update PHP configuration to increase upload_max_filesize and post_max_size
sed -i 's/upload_max_filesize = .*/upload_max_filesize = 20M/' /etc/php/8.4/fpm/php.ini
sed -i 's/post_max_size = .*/post_max_size = 20M/' /etc/php/8.4/fpm/php.ini
sed -i 's/memory_limit = .*/memory_limit = 512M/' /etc/php/8.4/fpm/php.ini
sed -i 's/max_execution_time = .*/max_execution_time = 300/' /etc/php/8.4/fpm/php.ini
echo "date.timezone = Europe/Sofia" >> /etc/php/8.4/fpm/php.ini

# Restart PHP-FPM to apply the changes
service php8.4-fpm restart

#To be sure that the database is up and running
sleep 10

php artisan migrate
php artisan cache:clear
php artisan view:clear
php artisan route:clear


echo "* * * * * cd /mnt/calendar && php artisan schedule:run >> /dev/null 2>&1" | crontab -
service cron start

sleep 5

php artisan queue:work --tries=3 --timeout=300 --memory=512

tail -f /dev/null


