FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpq-dev \
    unzip \
    libzip-dev \
    zip \
    && docker-php-ext-install pdo pdo_pgsql zip
    
RUN docker-php-ext-install sockets

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www