FROM php:8.0-apache

RUN docker-php-ext-install mysqli

WORKDIR /var/www/html

COPY mysqlconnect.php index.php

EXPOSE 80