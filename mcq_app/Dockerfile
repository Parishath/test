# Use official PHP + Apache image
FROM php:8.2-apache

# Install PostgreSQL extensions
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql pdo pdo_pgsql

# Copy your application files into Apache web directory
COPY . /var/www/html/

# Set correct permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configure Apache
RUN sed -i 's/80/4000/' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf && \
    a2enmod rewrite && \
    echo "ServerName localhost" >> /etc/apache2/apache2.conf && \
    echo "<Directory /var/www/html/>" >> /etc/apache2/apache2.conf && \
    echo "    AllowOverride All" >> /etc/apache2/apache2.conf && \
    echo "    Require all granted" >> /etc/apache2/apache2.conf && \
    echo "    DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf && \
    echo "</Directory>" >> /etc/apache2/apache2.conf

# Expose Render port
EXPOSE 4000

# Start Apache
CMD ["apache2-foreground"]
