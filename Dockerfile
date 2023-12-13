# Use the official PHP image with FPM
FROM php:8.1-fpm

# Install required extensions
RUN docker-php-ext-install mysqli \
    && pecl install xdebug \
    && docker-php-ext-enable mysqli xdebug

# Install Composer
RUN apt-get update \
    && apt-get install -y nano \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/html

# Copy the project files to the container
COPY . /var/www/html

RUN chown -R www-data:www-data .

# Expose port 9000 for PHP-FPM
# EXPOSE 9000
