# Use official PHP image with required extensions
FROM php:8.2-fpm

# Install PHP extensions and system packages
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions \
    @composer \
    exif \
    gd \
    memcached \
    mysqli \
    pcntl \
    pdo_mysql \
    zip && \
    apt-get update && \
    apt-get install -y git nano curl && \
    apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false && \
    rm -rf /var/lib/apt/lists/* && \
    apt-get clean

# Install WP-CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
    chmod +x wp-cli.phar && \
    mv wp-cli.phar /usr/local/bin/wp

# Install WP CLI dotenv package
RUN wp package install aaemnnosttv/wp-cli-dotenv-command:^2.0 --allow-root || echo "WP-CLI package install skipped"

# Set working directory
WORKDIR /var/www/html

# Define build arguments
ARG COMPOSER_AUTH
ARG DB_HOST
ARG DB_NAME
ARG DB_USER
ARG DB_PASSWORD
ARG WP_ENV
ARG WP_HOME
ARG WP_SITEURL
ARG AUTH_KEY
ARG SECURE_AUTH_KEY
ARG LOGGED_IN_KEY
ARG NONCE_KEY
ARG AUTH_SALT
ARG SECURE_AUTH_SALT
ARG LOGGED_IN_SALT
ARG NONCE_SALT

# Set environment variables
ENV COMPOSER_AUTH=$COMPOSER_AUTH \
    DB_HOST=$DB_HOST \
    DB_NAME=$DB_NAME \
    DB_USER=$DB_USER \
    DB_PASSWORD=$DB_PASSWORD \
    WP_ENV=$WP_ENV \
    WP_HOME=$WP_HOME \
    WP_SITEURL=$WP_SITEURL \
    AUTH_KEY=$AUTH_KEY \
    SECURE_AUTH_KEY=$SECURE_AUTH_KEY \
    LOGGED_IN_KEY=$LOGGED_IN_KEY \
    NONCE_KEY=$NONCE_KEY \
    AUTH_SALT=$AUTH_SALT \
    SECURE_AUTH_SALT=$SECURE_AUTH_SALT \
    LOGGED_IN_SALT=$LOGGED_IN_SALT \
    NONCE_SALT=$NONCE_SALT

# Copy project files
COPY ./ /var/www/html

# Remove old .env file if it exists
RUN rm -f .env && touch .env && chmod 644 .env && \
    echo "DB_HOST=$DB_HOST" >> .env && \
    echo "DB_NAME=$DB_NAME" >> .env && \
    echo "DB_USER=$DB_USER" >> .env && \
    echo "DB_PASSWORD=$DB_PASSWORD" >> .env && \
    echo "WP_ENV=$WP_ENV" >> .env && \
    echo "WP_HOME=$WP_HOME" >> .env && \
    echo "WP_SITEURL=$WP_SITEURL" >> .env && \
    echo "AUTH_KEY=$AUTH_KEY" >> .env && \
    echo "SECURE_AUTH_KEY=$SECURE_AUTH_KEY" >> .env && \
    echo "LOGGED_IN_KEY=$LOGGED_IN_KEY" >> .env && \
    echo "NONCE_KEY=$NONCE_KEY" >> .env && \
    echo "AUTH_SALT=$AUTH_SALT" >> .env && \
    echo "SECURE_AUTH_SALT=$SECURE_AUTH_SALT" >> .env && \
    echo "LOGGED_IN_SALT=$LOGGED_IN_SALT" >> .env && \
    echo "NONCE_SALT=$NONCE_SALT" >> .env

# Ensure correct permissions
RUN chown -R www-data:www-data /var/www/html

# Use development PHP settings and enable error logging
RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini && \
    echo "log_errors = On" >> /usr/local/etc/php/php.ini && \
    echo "error_log = /var/log/php_errors.log" >> /usr/local/etc/php/php.ini

# Expose PHP-FPM port
EXPOSE 9000

# Switch to non-root user
USER www-data
