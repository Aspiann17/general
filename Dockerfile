FROM debian:stable-slim

LABEL maintainer="Aspian"
LABEL version="1.3"

RUN apt update && apt install -y \
    php8.2 \
    php8.2-sqlite3 \
    apache2 \
    libapache2-mod-php8.2 \
    nano \
    && rm -rf /var/lib/apt/lists/*

EXPOSE 80

CMD ["apachectl", "-D", "FOREGROUND"]
