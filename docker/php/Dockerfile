FROM php:8.1-cli

LABEL maintainer="Daniel Resnitzky"

ARG WWWGROUP

WORKDIR /var/www/html

ENV DEBIAN_FRONTEND noninteractive
ENV TZ='America/Sao_Paulo'

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update \
    && apt-get install -y build-essential autoconf nano vim  \
       libcurl4-openssl-dev gnupg gosu curl ca-certificates python2 \
       zip unzip git supervisor sqlite3 libcap2-bin libpng-dev libz-dev libzip-dev\
    && mkdir -p ~/.gnupg \
    && chmod 600 ~/.gnupg \
    && echo "disable-ipv6" >> ~/.gnupg/dirmngr.conf

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN docker-php-ext-install mysqli bcmath gd pcntl curl pdo_mysql zip

RUN chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions xdebug redis imagick sockets

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer;

RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

RUN groupadd --force -g $WWWGROUP sail
RUN useradd -ms /bin/bash --no-user-group -g $WWWGROUP -u 1337 sail

RUN mkdir -p /home/sail/.npm && chown -R sail:sail /home/sail/.npm

RUN apt-get npm i --global yarn

COPY start-container /usr/local/bin/start-container
COPY php.ini /usr/local/etc/php/conf.d/99-sail.ini
RUN chmod +x /usr/local/bin/start-container

ENTRYPOINT ["start-container"]
