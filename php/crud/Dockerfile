FROM debian:bookworm-slim

LABEL maintainer="Aspian"
LABEL version="1.7"

RUN apt update && apt install -y --no-install-recommends \
    php8.2 \
    php8.2-sqlite3 \
    apache2 \
    libapache2-mod-php8.2 \
    rm -rf /var/lib/apt/lists/* && \
    rm -rf /var/www/html/*

COPY . /var/www/html/
RUN chown -R www-data:www-data /var/www/html/ && \
    sed -i.bak '/<Directory \/var\/www\/>/,/<\/Directory>/s/AllowOverride None/AllowOverride All/' "/etc/apache2/apache2.conf"

EXPOSE 80

CMD ["apachectl", "-DFOREGROUND"]