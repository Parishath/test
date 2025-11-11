# Use an official PHP image
FROM php:8.2-apache

# Install PostgreSQL extension for PHP
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql pdo pdo_pgsql

# Copy source code into container
COPY . /var/www/html/

# Expose port 4000 for Render
EXPOSE 4000

# Set Apache to listen on port 4000 instead of 80
RUN sed -i 's/80/4000/' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf

# Enable Apache rewrite module
RUN a2enmod rewrite

# Start Apache in foreground
CMD ["apache2-foreground"]
