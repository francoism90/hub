FROM docker.io/php:8.3.8-fpm-alpine

ARG UID=1000
ARG GID=$UID

ENV TZ=UTC

RUN apk update --no-cache \
    && apk upgrade --no-cache

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    shadow \
    alpine-sdk

RUN apk add --no-cache --virtual .run-deps \
    git \
    brotli \
    ffmpeg \
    tzdata \
    libcap \
    curl \
    unzip \
    opencore-amr \
    jpegoptim \
    mariadb-client \
    npm \
    yarn \
    optipng \
    pngquant \
    supervisor \
    libass \
    gsm \
    lame \
    speex \
    libtheora \
    libogg \
    libwebp \
    libva \
    libvpx \
    xvidcore \
    numactl \
    libvdpau \
    fdk-aac \
    libvorbis \
    openjpeg \
    x264 \
    x265

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN usermod --non-unique --uid $UID www-data \
    && groupmod --non-unique --gid $GID www-data

RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && sed -i "s/error_reporting = .*/error_reporting = E_ALL/" "$PHP_INI_DIR/php.ini" \
    && sed -i "s/display_errors = .*/display_errors = On/" "$PHP_INI_DIR/php.ini" \
    && sed -i "s/memory_limit = .*/memory_limit = 512M/" "$PHP_INI_DIR/php.ini" \
    && sed -i "s/upload_max_filesize = .*/upload_max_filesize = 100M/" "$PHP_INI_DIR/php.ini" \
    && sed -i "s/post_max_size = .*/post_max_size = 100M/" "$PHP_INI_DIR/php.ini" \
    && sed -i "s/;date.timezone.*/date.timezone = UTC/" "$PHP_INI_DIR/php.ini" \
    && curl -sSLf \
    -o /usr/local/bin/install-php-extensions \
    https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions \
    && chmod +x /usr/local/bin/install-php-extensions

RUN install-php-extensions \
    @composer \
    bcmath \
    event \
    exif \
    gd \
    gettext \
    igbinary \
    intl \
    msgpack \
    mysqli \
    opcache \
    pcntl \
    pdo_mysql \
    redis \
    soap \
    zip

RUN npm install -g svgo

RUN setcap "cap_net_bind_service=+ep" $(which php) \
    && setcap "cap_net_bind_service=+ep" $(which php-fpm)

RUN apk del .build-deps

COPY --chown=$UID:$GID runtimes/supervisord.conf /etc/supervisord.conf
COPY --chown=$UID:$GID runtimes/www.conf /usr/local/etc/php-fpm.d/www.conf

WORKDIR /app

STOPSIGNAL SIGQUIT

EXPOSE 5173
EXPOSE 6001
EXPOSE 9000

USER $UID

CMD ["supervisord"]
