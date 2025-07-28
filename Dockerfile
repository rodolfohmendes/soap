FROM php:8.1-apache

RUN apt-get update && apt-get install -y libxml2-dev && docker-php-ext-install soap

COPY ./api_login.php /var/www/html/api/api_login.php
COPY ./soap_server.php /var/www/html/soap_server.php
COPY ./login-request.xml /var/www/html/login-request.xml

EXPOSE 80
