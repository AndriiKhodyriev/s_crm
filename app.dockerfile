FROM php:7-fpm
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN apt-get update && apt-get install -y libmcrypt-dev mysql-client git zip unzip\
&& docker-php-ext-install pdo_mysql \
&& pecl install mcrypt-1.0.1 docker-php-ext-enable mcrypt
WORKDIR /var/www/html/s_crm
COPY . /var/www/html/s_crm
RUN cd /var/www/html/s_crm
RUN chmod 777 -R /var/www/html/s_crm
RUN chmod 777 -R /var/www/html/s_crm/storage
RUN composer install -d /var/www/html/s_crm
COPY /home/env_file/.env /var/www/html/s_crm
RUN php artisan key:generate
RUN php artisan optimize
RUN php artisan migrate
RUN php artisan db:seed