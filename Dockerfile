# Use the official PHP image
FROM php:8.2-apache

# Copy your application code to the container
COPY . /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

# Expose port 80 for the web server
EXPOSE 80
