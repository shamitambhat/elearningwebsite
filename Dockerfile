# Use official PHP Apache image
FROM php:8.1-apache

# Install the mysqli PHP extension
# Add the PostgreSQL PDO extension
RUN apt-get update && apt-get install -y php-pgsql


# Enable Apache mod_rewrite (optional but often needed)
RUN a2enmod rewrite

# Copy your project files into the Apache web root
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html/

# Expose port 80
EXPOSE 80

# Start Apache in the foreground
CMD ["apache2-foreground"]
