FROM docker.io/nginxinc/nginx-unprivileged:mainline-alpine

ARG UID=1000
ARG GID=$UID

ENV TZ=UTC
ENV NGINX_ENTRYPOINT_LOCAL_RESOLVERS=1

USER root

RUN apk update --no-cache \
    && apk upgrade --no-cache

RUN apk add --no-cache --virtual .build-deps \
    shadow \
    alpine-sdk \
    linux-headers \
    python3

RUN apk add --no-cache --virtual .run-deps \
    ca-certificates \
    curl \
    brotli-dev \
    ffmpeg-dev \
    freetype \
    fribidi \
    git \
    gmp \
    gnu-libiconv \
    gsm \
    jpeg \
    lame \
    libass \
    libcrypto3 \
    libogg \
    libpng \
    librsvg \
    libtheora \
    libva \
    libvdpau \
    libvorbis \
    libvpx \
    libwebp \
    libxml2-dev \
    fdk-aac \
    musl \
    numactl \
    opencore-amr \
    openjpeg \
    openssl-dev \
    pcre2-dev \
    speex \
    tzdata \
    unzip \
    x264 \
    x265 \
    xvidcore \
    zlib

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN usermod --non-unique --uid $UID nginx \
    && groupmod --non-unique --gid $GID nginx

RUN mkdir -p /usr/local/src && rm -rf /usr/local/src/* \
    && cd /usr/local/src \
    && wget "https://nginx.org/download/nginx-${NGINX_VERSION}.tar.gz" -O nginx.tar.gz \
    && set -x \
    && tar xzvf nginx.tar.gz \
    && rm -rf nginx.tar.gz \
    && mv /usr/local/src/nginx-${NGINX_VERSION} /usr/local/src/nginx \
    && CONFARGS=$(nginx -V 2>&1 | sed -n -e 's/^.*arguments: //p')

RUN cd /usr/local/src \
    && git clone --recursive --depth 1 https://github.com/google/ngx_brotli.git \
    && MODULEDIR=$(pwd)/ngx_brotli \
    && cd /usr/local/src/nginx \
    && ./configure --with-compat $CONFARGS --add-dynamic-module=$MODULEDIR --with-cc-opt="-O3" \
    && make \
    && make install

RUN cd /usr/local/src \
    && git clone --depth 1 https://github.com/kaltura/nginx-vod-module.git \
    && MODULEDIR=$(pwd)/nginx-vod-module \
    && cd /usr/local/src/nginx \
    && ./configure --with-compat $CONFARGS --add-dynamic-module=$MODULEDIR --with-file-aio --with-threads --with-cc-opt="-O3 -mpopcnt" \
    && make \
    && make install

RUN apk del .build-deps && rm -rf /usr/local/src/*

COPY --chown=$UID:$GID runtimes/. /etc/nginx

STOPSIGNAL SIGQUIT

EXPOSE 4443
EXPOSE 8443

USER $UID

CMD ["nginx", "-g", "daemon off;"]
