# Use the official PHP image as the base image
FROM php:8.1-apache

# Install necessary PHP extensions
RUN apt-get update && apt-get install -y libmysqli-dev && docker-php-ext-install mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy your project files into the container
COPY . /var/www/html/

# Expose the port the app will run on
EXPOSE 80
