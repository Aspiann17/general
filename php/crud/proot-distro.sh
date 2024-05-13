#!/bin/bash

set -eu

readonly VERSION=1.0
readonly REPOSITORY="https://github.com/Aspiann17/code.git"
readonly APACHE_PORT=8000

apt update && apt install -y php8.2 php8.2-sqlite3 apache2 libapache2-mod-php8.2 git

git clone $REPOSITORY /code
rm -rf /var/www/html/
ln -sf /code/php/crud/ /var/www/html

cat <<EOF > /etc/apache2/ports.conf
# If you just change the port or add more ports here, you will likely also
# have to change the VirtualHost statement in
# /etc/apache2/sites-enabled/000-default.conf

Listen $APACHE_PORT

<IfModule ssl_module>
	Listen 443
</IfModule>

<IfModule mod_gnutls.c>
	Listen 443
</IfModule>
EOF

cat <<EOF
You can run apache with command:
    /etc/init.d/apache2 start or service apache2 start

To stop a web server you can run:
    /etc/init.d/apache2 stop or service apache2 stop
EOF