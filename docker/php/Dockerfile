# Image and version
FROM php:8.1-fpm

# Install dependencies
RUN apt update && apt install -y zlib1g-dev libpng-dev libzip-dev libpq-dev unzip git

# Call PHP images script `docker-php-ext-install` and install language extensions
RUN docker-php-ext-install zip pgsql pdo pdo_pgsql

# copy the Composer PHAR from the Composer image into the PHP image
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Install xdebug
RUN pecl install xdebug && docker-php-ext-enable xdebug
COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
