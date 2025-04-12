FROM php:8.2-apache

# Install mysqli and other dependencies
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

# Copy your project files into the container
COPY . /var/www/html/

# Enable Apache mod_rewrite (if needed for routing)
RUN a2enmod rewrite
