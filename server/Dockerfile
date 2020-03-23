FROM alpine:3.6

# Setup apache and php
RUN apk --no-cache add \
        apache2 \
        php5-apache2 \
        curl \
        php5-json \
        php5-phar \
        php5-openssl \ 
        php5-mysql \
        php5-curl \
        php5-mcrypt \
        php5-pdo_mysql \
        php5-ctype \
        php5-gd \
        php5-xml \
        php5-dom \
        php5-iconv \
    && mkdir /run/apache2

COPY httpd.conf /etc/apache2/httpd.conf
# COPY php.ini /etc/php5/php.ini
COPY ./pages /usr/local/apache2/htdocs
RUN chown -R apache:apache /usr/local/apache2/htdocs
    
CMD [ "/usr/sbin/httpd", "-D", "FOREGROUND" ]