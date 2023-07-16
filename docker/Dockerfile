FROM php:8.1-apache

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions pdo_mysql intl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt update && apt install -yqq npm && apt install -y vim

# Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash && mv  /root/.symfony5/bin/symfony /usr/local/bin/symfony


#COPY . /var/www/

#COPY ./docker/apache.conf /etc/apache2/sites-available/000-default.conf

#RUN cd /var/www && composer install

WORKDIR /var/www/

EXPOSE 80