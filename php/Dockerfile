from debian:latest

RUN apt update && apt install -y \
    apache2 \
    libapache2-mod-php \
    php \
    php-sqlite3

WORKDIR /var/www/html/

COPY . /var/www/html/

CMD APACHE-FOREGROUND
