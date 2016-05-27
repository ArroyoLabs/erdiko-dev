#!/bin/sh

# configure apache to talk to hhvm
/user/share/hhvm/install_fastcgi.sh

# after install run this in your instance
a2enmod rewrite
a2enmod proxy_http # ?

# a2enmod ssl

# point apache to the correct webroot
rm -rf /var/www
ln -s /var/code/public /var/www

# copy apache config(s)
cp apache2.conf /etc/apache2/apache2.conf
cp 000-default.conf /etc/apache2/sites-available/000-default.conf
# alternative # a2ensite example.com.conf

# add symlink to hhvm mod
ln -s /etc/apache2/mods-available/hhvm_proxy_fcgi.conf /etc/apache2/mods-enabled/hhvm_proxy_fcgi.conf

# restart hack
update-rc.d hhvm defaults # on start up
service hhvm restart # right now

# restart apache
service apache2 restart

# install composer
# curl -sS https://getcomposer.org/installer | hhvm
# hhvm composer.phar install

# what about proxygen https://docs.hhvm.com/hhvm/basic-usage/proxygen
# hhvm --mode server -d hhvm.server.type=fastcgi -d hhvm.server.port=9000 