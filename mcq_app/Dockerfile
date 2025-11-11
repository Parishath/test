# =========================================================
# 🐳 Dockerfile for PHP + Apache + PostgreSQL (Supabase)
# App: MCQ Test System
# Maintainer: Pavan Kumar
# =========================================================

# Base image: PHP 8.2 with Apache preinstalled
FROM php:8.2-apache

# ---------------------------------------------------------
# Install PostgreSQL extensions for PHP
# ---------------------------------------------------------
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql pdo pdo_pgsql

# ---------------------------------------------------------
# Copy application files from mcq_app/ to Apache web root
# ---------------------------------------------------------
COPY . /var/www/html/

# ---------------------------------------------------------
# Set proper file permissions for Apache
# ---------------------------------------------------------
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# ---------------------------------------------------------
# Configure Apache for Render (port 4000, rewrite, etc.)
# ---------------------------------------------------------
RUN sed -i 's/80/4000/' /etc/apache2/ports.conf /etc/apache2/sites-available/000-default.conf && \
    a2enmod rewrite && \
    echo "ServerName localhost" >> /etc/apache2/apache2.conf && \
    echo "DirectoryIndex index.php index.html" >> /etc/apache2/apache2.conf && \
    echo "<Directory /var/www/html/>" >> /etc/apache2/apache2.conf && \
    echo "    AllowOverride All" >> /etc/apache2/apache2.conf && \
    echo "    Require all granted" >> /etc/apache2/apache2.conf && \
    echo "</Directory>" >> /etc/apache2/apache2.conf

# ---------------------------------------------------------
# Expose Render-assigned port
# ---------------------------------------------------------
EXPOSE 4000

# ---------------------------------------------------------
# Start Apache in foreground mode
# ---------------------------------------------------------
CMD ["apache2-foreground"]
