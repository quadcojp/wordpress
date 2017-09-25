FROM kunitaya/apache24_php71:latest
MAINTAINER kunitaya

ENV LANG ja_JP.UTF-8
ENV LANGUAGE ja_JP:ja
ENV LC_COLLATE C
ENV LC_CTYPE ja_JP.UTF-8

RUN set -x \
    && yum makecache fast \
    && yum -y install less sendmail sudo \
    && yum -y update \
    && yum clean all

# initialize services
COPY httpd.service /etc/systemd/system/httpd.service
COPY httpd.conf /etc/httpd/conf/httpd.conf
COPY httpd_conf.d /etc/httpd/conf.d/
COPY php.ini /etc/php.ini
COPY install-wordpress.sh /usr/local/bin/
COPY wordpress.ini /var/local/

# install wp-cli
ADD https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar /usr/local/bin/
RUN chmod 755 /usr/local/bin/wp-cli.phar
RUN ln -s /usr/local/bin/wp-cli.phar /usr/local/bin/wp

# download wordpress
RUN chown -R apache. /var/www/html
RUN sudo -u apache -- /usr/local/bin/wp core download --path=/var/www/html
RUN chmod -R g+w /var/www/html/wp-content
RUN find /var/www/html/wp-content -type d -print0 | xargs -0 chmod g+s

VOLUME ["/var/www/html"]

# enable services
RUN systemctl enable sendmail
RUN systemctl enable httpd

# exec.
CMD ["/sbin/init"]
