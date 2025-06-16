# Use official PHP with Apache
FROM php:8.2-apache

# Install MongoDB extension
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libonig-dev libxml2-dev zip unzip git \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb

# Copy project files into container
COPY . /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html/

# Expose port 80
EXPOSE 80
