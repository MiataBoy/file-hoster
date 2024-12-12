# Use the official PHP-FPM image as the base image
FROM php:8.3-fpm

RUN apt-get update && apt-get install libgpm2 libncursesw6 nano

# Install system dependencies required for PHP extensions and other utilities
RUN apt-get update && docker-php-ext-install pdo_mysql \
    && rm -rf /var/lib/apt/lists/*

# Optionally install other PHP extensions (e.g., GD)
# RUN docker-php-ext-install gd

# Set the working directory inside the container
WORKDIR /var/www/cdn

# Expose the PHP-FPM port
EXPOSE 9000
