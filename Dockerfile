# Dockerfile
FROM php:7.4-apache

# Install required packages and PHP extensions
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mysqli

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install Composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Set the working directory
WORKDIR /var/www/html

# Copy the entire project folder to the container

COPY composer.json .

RUN composer install

COPY . .


