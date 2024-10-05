FROM docker.io/php:8.3-fpm-alpine

ARG UID=1000
ARG GID=$UID

ENV TZ=UTC
ENV SUPERVISOR_PHP_COMMAND="php -d variables_order=EGPCS /app/artisan octane:start --server=swoole --host=0.0.0.0 --port=8000"
ENV SUPERVISOR_PHP_USER="www-data"

RUN apk update --no-cache \
    && apk upgrade --no-cache

RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    shadow \
    alpine-sdk \
    linux-headers \
    python3

RUN apk add --no-cache --virtual .run-deps \
    brotli \
    ca-certificates \
    curl \
    fdk-aac \
    ffmpeg \
    gifsicle \
    git \
    gnupg \
    gsm \
    jpegoptim \
    lame \
    libass \
    libavif \
    libcap \
    libogg \
    libpng \
    librsvg \
    libtheora \
    libva \
    libvdpau \
    libvorbis \
    libvpx \
    libwebp \
    mariadb-client \
    minio-client \
    npm \
    numactl \
    opencore-amr \
    openjpeg \
    optipng \
    pngquant \
    speex \
    sqlite \
    supervisor \
    tzdata \
    unzip \
    x264 \
    x265 \
    xvidcore \
    yarn \
    zip

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN usermod --non-unique --uid $UID www-data \
    && groupmod --non-unique --gid $GID www-data

RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    && curl -sSLf \
    -o /usr/local/bin/install-php-extensions \
    https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions \
    && chmod +x /usr/local/bin/install-php-extensions

RUN install-php-extensions \
    @composer \
    apcu \
    bcmath \
    bz2 \
    calendar \
    event \
    exif \
    ffi \
    gd \
    gettext \
    igbinary \
    imap \
    intl \
    msgpack \
    mysqli \
    opcache \
    openswoole \
    pcntl \
    pcov \
    pdo_mysql \
    redis \
    uv \
    zip

RUN yarn global add svgo

RUN setcap "cap_net_bind_service=+ep" $(which php) \
    && setcap "cap_net_bind_service=+ep" $(which php-fpm)

RUN apk del .build-deps

COPY --chown=$UID:$GID runtimes/php.ini "$PHP_INI_DIR/conf.d/xx-php-user.ini"
COPY --chown=$UID:$GID runtimes/supervisord.conf /etc/supervisord.conf
COPY --chown=$UID:$GID runtimes/www.conf /usr/local/etc/php-fpm.d/www.conf

WORKDIR /app

STOPSIGNAL SIGQUIT

EXPOSE 5173
EXPOSE 6001
EXPOSE 8000
EXPOSE 9000

USER $UID

CMD ["supervisord"]
