#!/bin/bash

# function: install wp-cli
function install-cli () {
  cd /usr/local/bin
  curl -sO https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
  chmod +x wp-cli.phar
  ln -s wp-cli.phar wp-cli
}

# download wordpress
if [ ! -e ${DOCROOT}/index.php ]; then
  [ `which wp-cli` ]|| install-cli
  wp-cli --allow-root core download --locale=${WP_LOCALE} --path=${DOCROOT}
fi

# create config file
if [[ -e ${DOCROOT}/wp-config.php && ${CREATE_CONF} -eq 1 ]]; then
  rm -f ${DOCROOT}/wp-config.php
fi
if [[ ! -e ${DOCROOT}/wp-config.php ]]; then
  [ `which wp-cli` ]|| install-cli
  [ `which mysql` ]|| yum -y install mariadb
  wp-cli --allow-root core config --dbname=${MYSQL_DATABASE} --dbuser=${MYSQL_USER} --dbpass=${MYSQL_PASSWORD} --dbhost=${MYSQL_HOST} --path=${DOCROOT}
fi

# change owner
chown -R apache. ${DOCROOT}

# start httpd
/usr/sbin/httpd -DFOREGROUND
