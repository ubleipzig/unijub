FROM php:5.4-apache
RUN docker-php-ext-install mysql
COPY webdir/ /var/www/html/
COPY unijub.sql.gz /db-backup/
COPY .htpasswd /conf/