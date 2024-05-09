FROM debian:latest

RUN apt update && apt install -y --no-install-recommends \
    php \
    php-sqlite3 \
    apache2 \
    libapache2-mod-php

COPY . /var/www/html/
RUN find /var/www/html/ -type f -name '*.sqlite' -delete
RUN chown -R www-data: /var/www/html/

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]