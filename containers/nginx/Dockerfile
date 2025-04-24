FROM docker.io/nginxinc/nginx-unprivileged:mainline

ARG UID=1000
ARG GID=$UID
ARG TZ=UTC

WORKDIR /app

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=${TZ}
ENV NGINX_ENTRYPOINT_LOCAL_RESOLVERS=1
ENV NGINX_USER="docker"

RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime && echo ${TZ} > /etc/timezone

RUN apt-get update && apt-get upgrade -y \
    && apt-get install -y \
        build-essential \
        clang-12 \
        gcc-10 \
        gnupg \
        curl \
        ca-certificates \
        zip \
        unzip \
        git \
        libssl-dev \
        dnsutils \
        python3 \
        libssl-dev \
        libpcre3-dev \
        libxml2-dev \
        unzip \
        libopencore-amrwb0 \
        libopencore-amrnb0 \
        libass9 \
        libgsm1 \
        libmp3lame0 \
        libjpeg9 \
        libspeex1 \
        libtheora0 \
        libva2 \
        libvpx6 \
        libxvidcore4 \
        libnuma1 \
        libvdpau1 \
        libfdk-aac1 \
        libva-drm2 \
        libva-x11-2 \
        libvorbisfile3 \
        libopenjp2-7 \
        libzvbi0 \
        libx264-155 \
        libx265-179 \
        libxcb1-dev \
        libxcb-shm0-dev \
        libvorbisenc2 \
        ffmpeg

COPY runtimes/. /etc/nginx

RUN usermod --non-unique --uid ${UID} nginx \
    && groupmod --non-unique --gid ${GID} nginx

RUN mkdir -p /usr/local/src && rm -rf /usr/local/src/* \
    && cd /usr/local/src \
    && wget "https://nginx.org/download/nginx-${NGINX_VERSION}.tar.gz" -O nginx.tar.gz \
    && set -x \
    && tar xzvf nginx.tar.gz \
    && rm -rf nginx.tar.gz \
    && mv /usr/local/src/nginx-${NGINX_VERSION} /usr/local/src/nginx \
    && CONFARGS=$(nginx -V 2>&1 | sed -n -e 's/^.*arguments: //p')

RUN cd /usr/local/src \
    && git clone --depth 1 https://github.com/kaltura/nginx-vod-module.git \
    && MODULEDIR=$(pwd)/nginx-vod-module \
    && cd /usr/local/src/nginx \
    && ./configure --with-compat ${CONFARGS} --add-dynamic-module=${MODULEDIR} --with-file-aio --with-threads --with-cc-opt="-O3 -mpopcnt" \
    && make \
    && make install

RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

EXPOSE 8080
EXPOSE 8081
EXPOSE 8082
EXPOSE 8085

STOPSIGNAL SIGQUIT

CMD ["nginx", "-g", "daemon off;"]
