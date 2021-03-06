FROM php:7.2

RUN apt-get update

RUN apt-get install -qq git curl libmcrypt-dev libjpeg-dev libpng-dev libfreetype6-dev libbz2-dev

RUN apt-get install -y zlib1g-dev libicu-dev g++

RUN apt-get clean

RUN docker-php-ext-configure intl

RUN docker-php-ext-install pdo_mysql zip intl

RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer global require "laravel/envoy=~1.0"
