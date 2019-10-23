FROM php:5-apache-stretch

ENV TZ=Asia/Chongqing

RUN mv /etc/apt/sources.list /etc/apt/sources.list.bak && \
    ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone && \
    echo "deb http://mirrors.163.com/debian/ stretch main non-free contrib" > /etc/apt/sources.list && \
    echo "deb http://mirrors.163.com/debian/ stretch-updates main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb http://mirrors.163.com/debian/ stretch-backports main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb-src http://mirrors.163.com/debian/ stretch main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb-src http://mirrors.163.com/debian/ stretch-updates main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb-src http://mirrors.163.com/debian/ stretch-backports main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb http://mirrors.163.com/debian-security/ stretch/updates main non-free contrib" >> /etc/apt/sources.list && \
    echo "deb-src http://mirrors.163.com/debian-security/ stretch/updates main non-free contrib" >> /etc/apt/sources.list

RUN apt-get update && apt-get install -y \
  libfreetype6-dev \
  libjpeg62-turbo-dev \
  libpng-dev \
  libpq-dev \
  iputils-ping \
  libnet-ifconfig-wrapper-perl \
&& docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
&& docker-php-ext-install -j$(nproc) gd pgsql pdo_pgsql

RUN apt-get update && pecl install apcu-4.0.11 \
    && docker-php-ext-enable apcu

RUN apt-get update && apt-get install -y \
  cron

COPY config/000-default.conf /etc/apache2/sites-enabled/000-default.conf
COPY config/php.ini-production /usr/local/etc/php/php.ini
COPY ./opensips-cp /var/www/html/opensips-cp
# COPY ./opensips-cp.tar.gz /tmp/
COPY ./entrypoint.sh /usr/local/bin/

# WORKDIR /tmp
RUN set -ex && \
  # tar xzf opensips-cp.tar.gz && \
  # mv opensips-cp /var/www/html/ && \
  ls -l && \
  mkdir /var/www/html/opensips-cp/web/tools/system/smonitor/generated && \
  chmod 777 /var/www/html/opensips-cp/web/tools/system/smonitor/generated && \
  chown -R www-data:www-data /var/www/html/opensips-cp/ && \
  chmod 775 /usr/local/bin/entrypoint.sh

ENTRYPOINT [ "/usr/local/bin/entrypoint.sh" ]

WORKDIR /var/www/html

RUN cp opensips-cp/config/tools/system/smonitor/opensips_stats_cron \
  /etc/cron.d/opensips_stats_cron

CMD ["apache2-foreground"]
