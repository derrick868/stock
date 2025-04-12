# Use an official PHP image with Apache
FROM php:8.2-apache

# Copy your code to Apache’s web root
COPY ./public /var/www/html/

# Enable Apache rewrite module (important for Laravel or clean URLs)
RUN a2enmod rewrite

# Optional: expose port (Render expects 80)
EXPOSE 80

