############################################################
# Dockerfile to build LAMP stack container images
# Based on Ubuntu
# 
# for building image:
# docker build -t lamp .
#
# for building container:
# docker run --name lamp_container -p 8888:80 -v /var/www -d -i -t lamp
############################################################

# Set the base image to Ubuntu
FROM ubuntu:latest

# File Author / Maintainer
MAINTAINER John Arroyo, john@arroyolabs.com

ENV DEBIAN_FRONTEND noninteractive

################## BEGIN INSTALLATION ######################
# LAMP stack
RUN apt-get update && apt-get install -y \
    git \
    git-core \
    curl \
    apache2 \
    php \
    php-mysql \
    libapache2-mod-php\
    php-json \
    php-pear \
    php-curl \
    php-mcrypt \
    php-cli \
&& apt-get clean

# apache mods
# RUN apache2ctl restart
# RUN a2enmod rewrite
# RUN apachectl restart

# Bundle scripts in this folder on your instance and run setup
ARG folder
COPY $folder /src
RUN cd /src && chmod 770 setup.sh && ./setup.sh


##################### INSTALLATION END #####################

# Expose the default port(s)
EXPOSE 80 443

CMD /usr/sbin/apache2ctl -D FOREGROUND
