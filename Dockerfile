# Base image
FROM php:8.1-apache

# Set Apache document root
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public

# Enable Apache modules
RUN a2enmod rewrite

# Install required PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install PHP intl extension
RUN apt-get update && apt-get install -y libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

# Copy application files
COPY . /var/www/html

# Set file permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/writable

# Set working directory
WORKDIR /var/www/html

# Expose port
EXPOSE 80

# Entry point
ENTRYPOINT ["apache2-foreground"]
