FROM php:8.1-fpm

# For composer
SHELL ["/bin/bash", "-o", "pipefail", "-c"]
RUN apt-get update \
    && apt-get install -y --no-install-recommends libzip-dev git vim libpng-dev gnupg libnss3 libx11-dev wget openssh-client \
    && docker-php-ext-install zip pdo_mysql gd \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set composer environment
ENV COMPOSER_ALLOW_SUPERUSER 1
ENV COMPOSER_HOME /composer
ENV PATH $PATH:/composer/vendor/bin

COPY my.ini /usr/local/etc/php/conf.d/my.ini

# Install laravel installer
RUN composer global require "laravel/installer"

WORKDIR /var/www

