# Install Caddy
FROM docker.io/caddy:2.10.2-builder-alpine AS caddy-builder
RUN xcaddy build \
    --with github.com/mholt/caddy-ratelimit


# Install PHP
FROM docker.io/alpine:3.22.2

LABEL maintainer="wong.lae@live.com"

# Setup document root
WORKDIR /var/www/html

# Get caddy
COPY --from=caddy-builder /usr/bin/caddy /usr/bin/caddy

# Install packages and remove default server definition
RUN apk add --no-cache curl \
    imagemagick \
    php84 \
    php84-fpm \
    php84-apache2 \
    php84-ctype \
    php84-curl \
    php84-dom \
    php84-ftp \
    php84-gd \
    php84-iconv \
    php84-json \
    php84-mbstring \
    php84-mysqli \
    php84-opcache \
    php84-openssl \
    php84-pgsql \
    php84-sqlite3 \
    php84-tokenizer \
    php84-xml \
    php84-zlib \
    php84-zip \
    supervisor

# Configure Caddy
COPY config/Caddyfile /etc/caddy/Caddyfile

# Configure PHP-FPM
COPY config/fpm-pool.conf /etc/php84/php-fpm.d/www.conf
COPY config/php.ini /etc/php84/conf.d/custom.ini

# Configure supervisord
COPY config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN mkdir /.config /phpbb

# Add tests app installation
COPY src/ /var/www/html/

# Add phpBB installation
ENV PHPBB_VERSION=3.3.17
ENV PHPBB_SHA256=b52fd231e612a099c0af1d2dcb73a79f7d03926a482842c4ee2830d12f461b67

WORKDIR /tmp

RUN curl -SL https://download.phpbb.com/pub/release/3.3/${PHPBB_VERSION}/phpBB-${PHPBB_VERSION}.tar.bz2 -o phpbb.tar.bz2 \
    && echo "${PHPBB_SHA256}  phpbb.tar.bz2" | sha256sum -c - \
    && tar -xjf phpbb.tar.bz2 \
    && mkdir /phpbb/sqlite \
    && mv phpBB3 /phpbb/www \
    && rm -f phpbb.tar.bz2

COPY phpbb/config.php /phpbb/www

# Expose the ports Caddy is reachable on
EXPOSE 8080
EXPOSE 9080

WORKDIR /phpbb/www

ENV PHPBB_INSTALL= \
    PHPBB_DB_DRIVER=sqlite3 \
    PHPBB_DB_HOST=/phpbb/sqlite/sqlite.db \
    PHPBB_DB_PORT= \
    PHPBB_DB_NAME= \
    PHPBB_DB_USER= \
    PHPBB_DB_PASSWD= \
    PHPBB_DB_TABLE_PREFIX=phpbb_ \
    PHPBB_DB_AUTOMIGRATE= \
    PHPBB_DISPLAY_LOAD_TIME= \
    PHPBB_DEBUG= \
    PHPBB_DEBUG_CONTAINER=

# Add sane default volumes for phpBB
# VOLUME /phpbb/sqlite
# VOLUME /phpbb/www/files
# VOLUME /phpbb/www/store
# VOLUME /phpbb/www/images/avatars/upload

COPY start.sh /usr/local/bin/
RUN dos2unix /usr/local/bin/start.sh 2>/dev/null || sed -i 's/\r$//' /usr/local/bin/start.sh && \
    chmod +x /usr/local/bin/start.sh
CMD ["/usr/local/bin/start.sh"]

# Configure a healthcheck to validate that everything is up and running
HEALTHCHECK --timeout=10s CMD curl --silent --fail http://127.0.0.1:9080/fpm-ping
