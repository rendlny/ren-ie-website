FROM php:7.4-apache

# Update the repository sources list
RUN apt-get update
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo pdo_mysql

# enable apache rewrite mod for htaccess
RUN a2enmod rewrite
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# use local php.ini
COPY ./docker-files/php.ini /usr/local/etc/php/php.ini-production
COPY ./docker-files/php.ini /usr/local/etc/php/php.ini-development


