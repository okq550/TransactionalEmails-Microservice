FROM php:7.3-fpm-alpine

RUN docker-php-ext-install pdo_mysql

# # # # Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR '/var/www/html/'
# COPY ./src/composer.* ./
# RUN composer install