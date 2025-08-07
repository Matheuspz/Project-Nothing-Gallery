FROM php:8.2-apache

RUN apt-get update && apt-get install -y default-mysql-client

RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite

COPY ./NothingGallery /var/www/html
COPY entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh

RUN chown -R www-data:www-data /var/www/html

ENTRYPOINT ["/entrypoint.sh"]
