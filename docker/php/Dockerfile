FROM php:7.3-fpm-stretch
COPY uploads.ini /usr/local/etc/php/conf.d/uploads.ini
RUN apt-get update && apt-get install -y \
	    libzip-dev \
        libmcrypt-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libxml2-dev \
        libx11-dev \
        libxrender1 \
        libxext6 \
        libfontconfig1 \
        libcurl4-gnutls-dev \
	    libmcrypt-dev \
	    libsodium-dev \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-configure curl --with-curl=/usr/include/ \
    && docker-php-ext-install -j$(nproc) pdo pdo_mysql mysqli calendar gettext mbstring xml zip curl gd \
    && pecl install xdebug mcrypt-1.0.2 apcu opcache \
    && docker-php-ext-enable xdebug mcrypt apcu opcache \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

