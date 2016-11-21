############################################################
# PHP FPM Container
#
# Contains common and useful...
# php extensions: mcrypt, gd, mysql
# linux packages: mysql-client, git, curl, wget, pwgen
#
# This is a good container for php development and includes 
# common tools needed in a PHP app.  Use with or without 
# Erdiko.  It can be used in prod but is intended for dev
############################################################

FROM php:fpm

# File Author / Maintainer
MAINTAINER John Arroyo, john@arroyolabs.com

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update \
    && apt-get install -y wget \
        git \
        mysql-client \
        curl \
        pwgen \
        libmcrypt-dev \
        libpng-dev \
    && docker-php-ext-install mysqli \
        pdo_mysql \
        mcrypt \
        gd \
    && apt-get clean

COPY scripts /src
RUN cd /src && chmod 770 composer.sh && ./composer.sh
RUN cd /src && chmod 770 phpunit.sh && ./phpunit.sh

EXPOSE 9000

CMD ["php-fpm"]
