#!/bin/bash

set -eu

readonly VERSION=1.1
readonly APACHE_PORT=8000
readonly CODE_DIR="/root/code"
readonly CONFIG_DIR="/etc/apache2"
readonly TARGET_DIR="/var/www/html"
readonly REPOSITORY="https://github.com/Aspiann17/code.git"

apt update && apt install -y php8.2 php8.2-sqlite3 apache2 libapache2-mod-php8.2 git nano

git clone $REPOSITORY $CODE_DIR

if [ -d "$TARGET_DIR" ]; then
    rm -rf $TARGET_DIR
fi

ln -sf $CODE_DIR/php/crud/ $TARGET_DIR

sed -i.bak "s/^Listen 80$/Listen $APACHE_PORT/" $CONFIG_DIR/ports.conf

sed -i.bak '/<Directory \/var\/www\/>/,/<\/Directory>/ {
s/AllowOverride None/AllowOverride All/
}' "$CONFIG_DIR/apache2.conf"

cat <<EOF
You can run apache with command:
    /etc/init.d/apache2 start or service apache2 start

To stop a web server you can run:
    /etc/init.d/apache2 stop or service apache2 stop
EOF