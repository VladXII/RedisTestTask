FROM mykiwi/symfony-base

RUN git clone -b php7 https://github.com/phpredis/phpredis.git /usr/src/php/ext/redis \
 && docker-php-ext-install redis \
# && apt-get autoremove && apt-get autoclean \
# && rm -rf /var/lib/apt/lists/*
