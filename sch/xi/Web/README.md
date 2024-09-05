# -
## Start

PHP & Web Server
```bash
podman run --name php_dev -p 8000:80 -v $(pwd)/:/var/www/html/ -d php:8.2-apache
```

Database
```bash
podman run -dp 3306:3306 --name sql -e MYSQL_ROOT_PASSWORD=ehe docker.io/percona:8
```

## Link
https://github.com/twbs/bootstrap/releases/download/v5.3.3/bootstrap-5.3.3-dist.zip

# Code
- [PHP RFC: Argument Unpacking](https://wiki.php.net/rfc/argument_unpacking)