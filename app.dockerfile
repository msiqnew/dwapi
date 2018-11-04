FROM wyveo/nginx-php-fpm:latest

RUN apt-get update && apt-get install -y php-sqlite3

WORKDIR /var/www
ADD ./vhost.conf /etc/nginx/conf.d/default.conf
RUN chown -R www-data:www-data /var/www