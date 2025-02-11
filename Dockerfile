# Use the official PHP image with necessary extensions
FROM php:8.2-fpm AS php-app

# Install php extensions and related packages
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions && sync \
  && install-php-extensions \
    @composer \
    exif \
    gd \ 
    memcached \
    mysqli \
    pcntl \
    pdo_mysql \
    zip \
  && apt-get update \
  && apt-get install -y \
    git \
    nano \
    curl \
  && apt-get purge -y --auto-remove -o APT::AutoRemove::RecommendsImportant=false \
  && rm -rf /var/lib/apt/lists/* \
  && apt-get clean

RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
RUN echo php wp-cli.phar --info

RUN chmod +x wp-cli.phar
RUN mv wp-cli.phar /usr/local/bin/wp

RUN wp package install aaemnnosttv/wp-cli-dotenv-command:^2.0 --allow-root

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

ENV COMPOSER_AUTH=$COMPOSER_AUTH
ENV DB_HOST=$DB_HOST
ENV DB_NAME=$DB_NAME
ENV DB_USER=$DB_USER
ENV DB_PASSWORD=$DB_PASSWORD
ENV WP_ENV=$WP_ENV
ENV WP_HOME=$WP_HOME
ENV WP_SITEURL=$WP_SITEURL
ENV AUTH_KEY=$AUTH_KEY
ENV SECURE_AUTH_KEY=$SECURE_AUTH_KEY
ENV LOGGED_IN_KEY=$LOGGED_IN_KEY
ENV NONCE_KEY=$NONCE_KEY
ENV AUTH_SALT=$AUTH_SALT
ENV SECURE_AUTH_SALT=$SECURE_AUTH_SALT
ENV LOGGED_IN_SALT=$LOGGED_IN_SALT
ENV NONCE_SALT=$NONCE_SALT

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --optimize-autoloader

ENV COMPOSER_AUTH=

# Copy source files
COPY ./.env /var/www/html/.env
COPY ./ /var/www/html

RUN wp dotenv delete COMPOSER_AUTH --allow-root

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html

# log all php errors
RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini

FROM caddy:latest AS webserver
COPY --from=php-app /var/www/html /var/www/html

# Copy Caddyfile for configuration (if you have one)
COPY Caddyfile /etc/caddy/Caddyfile

# Expose port 80
EXPOSE 80