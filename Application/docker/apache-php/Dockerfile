FROM lavoweb/php-8.0

RUN docker-php-ext-install mysqli pdo pdo_mysql

ADD ./apache-php/php.ini /usr/local/etc/php/conf.d/php.ini
