FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
COPY . .

RUN rm -rf vendor && composer install --no-dev 2>&1

CMD bash -c "php artisan migrate --force 2>&1 && echo 'Migrations done' && php -S 0.0.0.0:8080 -t public"