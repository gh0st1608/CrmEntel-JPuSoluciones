FROM php:7.2-apache
#FROM php:7.4-fpm-alpine
#RUN mv "./configphp/php.ini-production" "$PHP_INI_DIR/php.ini"
RUN docker-php-ext-install pdo pdo_mysql mysqli && docker-php-ext-enable pdo pdo_mysql mysqli
#RUN apt-get update && apt-get upgrade -y
