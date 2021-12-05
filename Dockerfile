# Docker image to use
# FROM [--platform=<platform>] <image>[:<tag>] [AS <name>]
FROM php:7-apache AS apache-server

# COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
# COPY start-apache /usr/local/bin
RUN a2enmod rewrite

# Copy application source
# COPY src /var/www/
RUN chown -R www-data:www-data /var/www

CMD ["start-apache"]