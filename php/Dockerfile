from debian:latest

RUN apt update && apt install -y \
    apache2 \
    php \
    libapache2-mod-php

WORKDIR /var/www/html/

COPY . /var/www/html/