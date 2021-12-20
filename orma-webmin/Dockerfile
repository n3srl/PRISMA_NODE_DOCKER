FROM php:7.4.26-apache

#For Orma standard:
# - add htaccess rewrite support
# - add gettext support
RUN a2enmod rewrite \
    && apt-get update && apt-get install --no-install-recommends -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-configure gettext \
    && docker-php-ext-install -j$(nproc) gettext

#For Orma Inaf:
# - add ssh2 library
RUN apt-get install --no-install-recommends -y libssh2-1-dev \
    && pecl install ssh2-1.3.1 \
    && docker-php-ext-enable ssh2

COPY ["passwd.txt","/orma/"]

