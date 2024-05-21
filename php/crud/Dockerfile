FROM debian:stable-slim

LABEL maintainer="Aspian"
LABEL version="1.3"

RUN apt update && apt install -y --no-install-recommends \
    php8.2 \
    php8.2-sqlite3 \
    apache2 \
    libapache2-mod-php8.2 \
    nano \
    && rm -rf /var/lib/apt/lists/*

COPY . /var/www/html/
RUN find /var/www/html/ -type f -name '*.sqlite' -delete
RUN chown -R www-data: /var/www/html/

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]