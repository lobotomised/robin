FROM php:7.3-fpm-stretch

ENV COMPOSER_HOME /var/composer
ENV COMPOSER_ALLOW_SUPERUSER 1

ARG DEBIAN_FRONTEND=noninteractive
ARG WEB_USER=www-data
ARG WEB_USER_HOME=/var/www

ARG SYSTEM_TOOLS="\
    apt-transport-https \
    build-essential \
    git  \
    htop \
    msmtp \
    mariadb-client \
    sudo \
    unzip \
    vim \
    zip \
"

ARG BUILD_DEPENDENCIES="\
    default-libmysqlclient-dev \
    gnupg2 \
    libbz2-dev \
    libsasl2-dev \
    lsb-release \
"

ARG RUNTIME_DEPENDENCIES="\
    imagemagick \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libpq-dev \
    libmagickwand-dev \
    libpng-dev \
    libxml2-dev \
    libzip-dev \
    mcrypt \
"

ARG PHP_EXTENSIONS="\
    bcmath \
    bz2 \
    calendar \
    exif \
    intl \
    mysqli \
    opcache \
    pcntl \
    pdo_mysql \
    soap \
    xmlrpc \
    zip \
"

ARG NODE_PACKAGES="\
    npm \
    nodejs \
    yarn \
"

WORKDIR /tmp

RUN set -xe; \
    sed 's|deb.debian.org|ftp.fr.debian.org|g' -i /etc/apt/sources.list \
 && sed 's|security.debian.org|ftp.fr.debian.org|g' -i /etc/apt/sources.list \
 && sed 's|deb.debian.org|ftp.fr.debian.org|g' -i /etc/apt/sources.list.d/buster.list \
 && echo "Acquire::http {No-Cache=True;};" > /etc/apt/apt.conf.d/no-cache \
 && echo 'APT::Install-Recommends "false";' > /etc/apt/apt.conf

# SET TIMEZONE
RUN ln -snf /usr/share/zoneinfo/Europe/Paris /etc/localtime && echo 'Europe/Paris' > /etc/timezone

RUN set -xe; \
    apt-get update  \
&& apt-get install -yqq $SYSTEM_TOOLS $BUILD_DEPENDENCIES $RUNTIME_DEPENDENCIES

RUN set -xe; \
    usermod -u 1000 $WEB_USER \
 && chown -R $WEB_USER:$WEB_USER $WEB_USER_HOME \
 && echo "$WEB_USER ALL = ( ALL ) NOPASSWD: ALL" >> /etc/sudoers

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN mkdir $COMPOSER_HOME \
 && composer global require "hirak/prestissimo:^0.3" \
 && rm -rf $COMPOSER_HOME/.composer/cache/* \
 && chown -R $WEB_USER:$WEB_USER $COMPOSER_HOME

# composer nous a déplacer dans son home
WORKDIR /tmp

# nodejs npm yarn
RUN set -xe; \
    curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
 && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
 && curl -sL https://deb.nodesource.com/setup_12.x | bash - \
 && apt-get install -yqq $NODE_PACKAGES \
 && npm install --global npm \
 && npm cache clean --force

# php-extention
RUN set -xe; \
    docker-php-ext-install -j$(nproc) $PHP_EXTENSIONS \
 && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
 && docker-php-ext-install -j$(nproc) gd \
 && docker-php-source delete

RUN pecl channel-update pecl.php.net \
 && pecl upgrade \
 && pecl install redis && pecl install apcu && pecl install imagick && pecl install xdebug-beta \
 && docker-php-ext-enable redis apcu imagick xdebug \
 && echo 'memory_limit=1024M\n\
sendmail_path = "/usr/bin/msmtp --host=mailhog --port=1025 -f root@localhost.local -t"\n\
' > /usr/local/etc/php/conf.d/zz-conf.ini

COPY conf.d/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

# cleanup
RUN set -xe; \
    rm -rf /usr/lib/node_modules/ \
 && apt-get purge -yqq --auto-remove -o APT::AutoRemove::RecommendsImportant=false -o APT::AutoRemove::SuggestsImportant=false \
      $BUILD_DEPENDENCIES \
# nettoyage de l'index
 && apt-get autoclean -yqq \
 && apt-get clean \
# supprime tout ce qui est inutile
 && rm -rf /var/cache/apt/ \
      /tmp/* \
      /var/lib/apt/lists/* \
      /var/log/* \
      /var/tmp/* \
      /usr/share/doc \
      /usr/share/doc-base \
      /usr/share/gnome/help/*/* \
      /usr/share/groff/* \
      /usr/share/info/* \
      /usr/share/linda/* \
      /usr/share/lintian/overrides/* \
      /usr/share/locale/* \
      /usr/share/man/* \
      /usr/share/omf/*/*-*.emf

# Copy existing application directory permissions
COPY --chown=www-data:www-data . $WEB_USER_HOME/html

COPY .bashrc $WEB_USER_HOME/.bashrc

WORKDIR $WEB_USER_HOME/html

USER $WEB_USER

EXPOSE 9000

CMD ["php-fpm"]
