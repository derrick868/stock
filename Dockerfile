FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Enable Apache mod_rewrite (optional but common for routing)
RUN a2enmod rewrite

# Copy everything from public/ to Apache's web root
COPY ./public/ /var/www/html/

# Set permissions (optional)
RUN chown -R www-data:www-data /var/www/html
