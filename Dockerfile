FROM php:8.1-fpm

WORKDIR /app

COPY composer.json composer.lock .

RUN composer install

COPY . .

RUN chmod -R 775 storage

RUN chown -R www-data:www-data storage

EXPOSE 80

CMD ["php", "artisan", "serve"]
