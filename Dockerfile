# Use official PHP Apache image
FROM php:8.1-apache
FROM php:7.4-apache

# Install dependencies for PostgreSQL extension
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql

# Enable mod_rewrite
RUN a2enmod rewrite


# Enable Apache mod_rewrite (optional but often needed)
RUN a2enmod rewrite

# Copy your project files into the Apache web root
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Expose port 80
EXPOSE 5432

# Start Apache in the foregroun
