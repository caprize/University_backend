FROM php:7.3-apache
RUN apt-get update && apt-get install -y libmagickwand-dev --no-install-recommends && rm -rf /var/lib/apt/lists/*
RUN printf "\n" | pecl install imagick
RUN docker-php-ext-enable imagick
RUN apt-get update && docker-php-ext-install mysqli && docker-php-ext-enable mysqli 
