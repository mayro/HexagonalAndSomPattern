FROM php:8.1.1-fpm
COPY . /var/www
RUN mkdir -p /var/www/var/cache  /var/www/var/logs /var/www/var/sessions && chmod -R 777 /var/www/var/cache && chmod -R 777 /var/www/var/logs /var/www/var/sessions
COPY --from=composer /usr/bin/composer /usr/bin/composer
RUN cd /var/www && composer install --no-dev --classmap-authoritative --optimize-autoloader --no-interaction --no-scripts
RUN cd /var/www && bin/console assets:install -n -e test --no-debug
RUN cd /var/www && composer dump-autoload -o
VOLUME /var/www
WORKDIR /var/www
CMD composer install ;  php-fpm
EXPOSE 9000