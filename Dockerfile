FROM php:7.4-apache

ARG uid=1000
ARG user=ren

# Update the repository sources list
# RUN docker-php-ext-install mysqli
# RUN docker-php-ext-enable mysqli
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip

# install zip packages required for composer laravel installation
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev
RUN docker-php-ext-install zip

# RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd 
RUN docker-php-ext-install pdo pdo_mysql exif pcntl

# enable apache rewrite mod for htaccess
RUN a2enmod rewrite
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# use local php.ini
COPY ./docker-files/php.ini /usr/local/etc/php/php.ini-production
COPY ./docker-files/php.ini /usr/local/etc/php/php.ini-development

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.compser && \
    chown -R $user:$user /home/$user

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

USER $user

# COPY ./vendor /var/www/html/vendor
# COPY ./docker-files/phinx.yml /var/www/html/phinx.yml
# RUN /var/www/html/vendor/bin/phinx migrate
# RUN echo mysql://db:3306

# RUN cd /var/www/html/vendor/bin && phinx migrate
# RUN cd /var/www/html && vendor/bin/phinx migrate
# RUN cd /var/www/html/vendor
# vendor folder is not mounted yet