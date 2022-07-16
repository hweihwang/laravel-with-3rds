FROM php:fpm-alpine

WORKDIR /project

#RUN apk add --no-cache \
#    php8-pear php8-dev gcc musl-dev make git bash nano libzip-dev \
#    && pecl install xdebug \
#    && rm -rf /tmp/*

RUN apk add \
    php8-pear php8-dev gcc musl-dev make git bash nano libzip-dev \
    && pecl install xdebug

RUN docker-php-ext-install pdo pdo_mysql zip bcmath \
    && docker-php-ext-enable pdo pdo_mysql zip bcmath xdebug

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer \
    && alias composer='php composer.phar'

#ARG NEW_RELIC_AGENT_VERSION
#
#RUN curl -L "https://download.newrelic.com/php_agent/archive/${NEW_RELIC_AGENT_VERSION}/newrelic-php5-${NEW_RELIC_AGENT_VERSION}-linux-musl.tar.gz" | tar -C /tmp -zx \
# && export NR_INSTALL_USE_CP_NOT_LN=1 \
# && export NR_INSTALL_SILENT=1 \
# && /tmp/newrelic-php5-*/newrelic-install install \
# && rm -rf /tmp/newrelic-php5-* /tmp/nrinstall*

EXPOSE 9001

