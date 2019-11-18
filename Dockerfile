FROM  php:7.3-fpm

RUN apt-get update --fix-missing && apt-get install -y \
    git \
    zlib1g-dev \
    libzip-dev \
    libicu-dev \
    libcurl4-openssl-dev

RUN docker-php-ext-install -j$(nproc) zip bcmath intl exif

RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer && apt-get purge

WORKDIR /var/www

COPY . .

RUN php -d memory_limit=-1 /usr/local/bin/composer install --optimize-autoloader
RUN php /usr/local/bin/composer dump-autoload --optimize --classmap-authoritative
RUN php  bin/console cache:warmup
