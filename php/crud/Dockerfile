FROM debian:latest

RUN apt update && apt install -y \
    php \
    php-sqlite3 \
    apache2 \
    libapache2-mod-php

COPY . /var/www/html/

RUN chown -R www-data: /var/www/html/

EXPOSE 80