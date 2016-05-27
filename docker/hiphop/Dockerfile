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
FROM ubuntu:trusty

# File Author / Maintainer
MAINTAINER John Arroyo, john@arroyolabs.com

ENV DEBIAN_FRONTEND noninteractive

################## BEGIN INSTALLATION ######################
# LAMP stack
RUN apt-get -y update && apt-get -y install software-properties-common
RUN apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449 \
	&& add-apt-repository "deb http://dl.hhvm.com/ubuntu $(lsb_release -sc) main"
RUN apt-get -y update && apt-get install -y \
    hhvm \
    git \
    git-core \
    curl \
    apache2 \
&& apt-get clean

# Bundle scripts in this folder on your instance and run setup
ARG folder
COPY $folder /src
RUN cd /src && chmod 770 setup.sh && ./setup.sh


##################### INSTALLATION END #####################

# Expose the default port(s)
EXPOSE 80 443

CMD /usr/sbin/apache2ctl -D FOREGROUND