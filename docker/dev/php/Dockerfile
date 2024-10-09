FROM composer:latest AS composer

FROM php:8.2-fpm-alpine

ENV CACHE=--no-cache

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /bot

RUN apk $CACHE update && apk $CACHE add \
    #postgresql-dev \
    bash \
    git \
    zip \
    unzip \
    wget 
# libzip-dev \
# build-base \
# libpng-dev \
# freetype-dev \
# libjpeg-turbo-dev \
# zlib-dev \
# libpq \
# libpq-dev \
# libffi-dev \
# openssl-dev \
# sqlite-dev \
# tk-dev \
# gdbm-dev \
# ncurses-dev \
# bzip2-dev \
# zlib-dev 

RUN docker-php-ext-install \
    bcmath\
    gd \ 
    zip 
#pdo \ 
#pdo_pgsql 

