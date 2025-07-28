FROM php:8.1-apache

RUN apt-get update && apt-get install -y \
    libxml2-dev \
    && docker-php-ext-install soap

COPY . /var/www/html/

EXPOSE 80