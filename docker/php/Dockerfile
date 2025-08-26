FROM php:8.2-fpm-alpine

LABEL maintainer="Dieisson <dieisson.martins.santos@gmail.com>"

RUN apk add --no-cache \
    nginx \
    openjdk8 \
    npm \
    yarn \
    libpng-dev \
    libzip-dev \
    libxml2-dev \
    libaio-dev \
    libpq-dev \
    libsodium-dev \
    libwebp-dev \
    icu-dev \
    ttf-dejavu \
    jq

RUN apk add --no-cache --virtual .phpize_deps \
    $PHPIZE_DEPS \
    wget \
    git \
    zip \
    unzip \
    curl \
    procps \
    net-tools \
    linux-headers

RUN pecl install xdebug-3.4.2 && \
    docker-php-ext-enable xdebug && \
    echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN echo "upload_max_filesize = 10M" >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo "post_max_size = 10M" >> /usr/local/etc/php/conf.d/uploads.ini && \
    echo "extension=gd.so" > /usr/local/etc/php/conf.d/gd.ini && \
    echo "max_execution_time = 300" >> /usr/local/etc/php/conf.d/timeouts.ini

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli \
    zip \
    exif \
    bcmath \
    pcntl \
    intl

RUN docker-php-ext-configure gd --with-webp && \
    docker-php-ext-install gd

RUN apk del .phpize_deps

RUN ln -s /var/www/meucuidador/artisan /usr/local/bin/artisan

RUN apk add --no-cache composer

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer && \
    composer self-update

RUN addgroup -g 1000 -S www && \
    adduser -u 1000 -S www -G www && \
    mkdir -p /home/www/.composer && \
    chown -R www:www /home/www
