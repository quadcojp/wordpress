#!/bin/bash -u

. /var/local/wordpress.ini
export PATH=$PATH:/usr/local/bin

# function: install wp-cli
function install-cli () {
    cd /usr/local/bin
    curl -sO https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
    chmod +x wp-cli.phar
    ln -s wp-cli.phar wp
}

# download wordpress
if [ ! -e ${DOCROOT}/index.php ]; then
    [ `which wp` ]|| install-cli
    sudo -u apache -- /usr/local/bin/wp core download --path=${DOCROOT} --locale=${WP_LOCALE} --version=${WP_VERSION}
    if [ $? -eq 0 ]; then
        chown -R apache. /var/www/html
        chmod -R g+w /var/www/html/wp-content
        find /var/www/html/wp-content -type d -print0 | xargs -0 chmod g+s
    else
        exit 1
    fi
fi

# create config file
if [ ! -e ${DOCROOT}/wp-config.php ]; then
    [ `which wp` ]|| install-cli
    [ `which mysql` ]|| yum -y install mariadb

    NEXT_WAIT_TIME=0
    echo "Waiting for mysql"
    until mysql -h"$MYSQL_HOST" -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" &> /dev/null || [ $NEXT_WAIT_TIME -eq 4 ]; do
        >&2 echo -n "."
        sleep $(( NEXT_WAIT_TIME++ ))
    done

    if mysql -h"$MYSQL_HOST" -u"$MYSQL_USER" -p"$MYSQL_PASSWORD" &> /dev/null; then
        >&2 echo "MySQL is started."
        sudo -u apache -- /usr/local/bin/wp core config --dbname=${MYSQL_DATABASE} --dbuser=${MYSQL_USER} --dbpass=${MYSQL_PASSWORD} --dbhost=${MYSQL_HOST} --path=${DOCROOT}
    else
        >&2 echo "MySQL not started."
        exit 0
    fi
fi
