# FROM ubuntu:latest

# Use an official PHP runtime as a parent image
FROM php:apache

# Set the working directory in the container
WORKDIR /var/www/html

# Install system dependencies
RUN apt-get update && \
    apt-get install -y \
    tzdata \
    git \
    zip \
    unzip \
    libzip-dev \
    libpq-dev && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install zip pdo_pgsql pgsql

# Copy entrypoint script
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

# Give execute permissions to the script
RUN chmod +x /usr/local/bin/entrypoint.sh

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy composer.json and install dependencies
COPY composer.json .
COPY composer.lock .
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy the rest of the application code
COPY . .

ENV COMPOSER_ALLOW_SUPERUSER 1

RUN composer update && composer install -n --no-scripts --no-autoloader

# Generate the optimized autoloader and configuration
RUN composer dump-autoload --optimize

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port 80
EXPOSE 80

# Run Apache
CMD ["apache2-foreground"]

