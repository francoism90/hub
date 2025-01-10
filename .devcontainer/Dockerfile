FROM docker.io/php:8.3-cli-alpine

ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime \
    && echo ${TZ} > /etc/timezone

RUN apk update --no-cache \
    && apk upgrade --no-cache

RUN apk add --no-cache --virtual .build-deps ${PHPIZE_DEPS} \
    shadow \
    alpine-sdk \
    linux-headers \
    python3

RUN apk add --no-cache --virtual .run-deps \
    bash \
    gnupg \
    curl \
    wget \
    nano \
    openssh \
    git \
    tzdata \
    nss-tools \
    ca-certificates \
    sqlite \
    postgresql-client \
    minio-client \
    valkey-cli \
    npm \
    unzip \
    yarn \
    zip

RUN yarn global add npm-check-updates

RUN cp ${PHP_INI_DIR}/php.ini-development ${PHP_INI_DIR}/php.ini \
    && curl -sSLf \
    -o /usr/local/bin/install-php-extensions \
    https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions \
    && chmod +x /usr/local/bin/install-php-extensions

RUN install-php-extensions \
    @composer \
    apcu \
    bcmath \
    bz2 \
    event \
    exif \
    ffi \
    intl \
    mbstring \
    msgpack \
    opcache \
    pcntl \
    pcov \
    pdo_pgsql \
    pgsql \
    redis \
    sockets \
    uv \
    zip \
    igbinary \
    gd

RUN apk del .build-deps \
    && docker-php-source delete \
    && rm -rf /var/cache/apk/* /tmp/* /var/tmp/*
