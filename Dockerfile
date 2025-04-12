FROM php:8.2-apache

# Install MySQL extensions and other dependencies
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql

# Enable Apache mod_rewrite (optional but common for routing)
RUN a2enmod rewrite

# Copy everything from public/ to Apache's web root
COPY ./public/ /var/www/html/

# Set permissions (optional)
RUN chown -R www-data:www-data /var/www/html
