FROM docker.io/library/nginx:mainline

ARG UID=1000
ARG GID=$UID
ARG TZ=UTC

WORKDIR /app

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=${TZ}
ENV NGINX_ENTRYPOINT_LOCAL_RESOLVERS=1

RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime && echo ${TZ} > /etc/timezone

RUN sed -i 's/^Components: main$/& contrib non-free/' /etc/apt/sources.list.d/debian.sources

RUN apt-get update && apt-get upgrade -y \
    && mkdir -p /etc/apt/keyrings \
    && apt-get install -y build-essential gnupg curl ca-certificates zip unzip git dnsutils python3-dev ffmpeg \
    && apt-get install -y libssl-dev libpcre2-dev libxml2-dev libpng-dev \
    && apt-get install -y libavcodec-dev libswscale-dev libavfilter-dev libfdk-aac-dev zlib1g-dev \
    && apt-get install -y libavutil-dev libavformat-dev libavdevice-dev libpostproc-dev libswresample-dev \
    && apt-get install -y libopencore-amrwb0 libopencore-amrnb0 libjpeg62 libass9 libgsm1 libmp3lame0 \
    && apt-get install -y libtheora0 libopus0 libogg0 libvorbis0a libvpx7 libxvidcore4 libspeex1 \
    && apt-get install -y libnuma1 libvorbisfile3 libopenjp2-7 libzvbi0 libx264-164 libx265-199 libvorbisenc2

RUN mkdir -p /usr/local/src && rm -rf /usr/local/src/* \
    && cd /usr/local/src \
    && curl -sSL "https://nginx.org/download/nginx-${NGINX_VERSION}.tar.gz" -o nginx.tar.gz \
    && set -x \
    && tar xzvf nginx.tar.gz \
    && rm -rf nginx.tar.gz \
    && mv /usr/local/src/nginx-${NGINX_VERSION} /usr/local/src/nginx \
    && CONFARGS=$(nginx -V 2>&1 | sed -n -e 's/^.*arguments: //p')

RUN cd /usr/local/src \
    && git clone --depth 1 https://github.com/diogoazevedos/nginx-vod-module.git \
    && MODULEDIR=$(pwd)/nginx-vod-module \
    && cd /usr/local/src/nginx \
    && ./configure --with-compat ${CONFARGS} --add-dynamic-module=${MODULEDIR} --with-file-aio --with-threads --with-cc-opt="-O3 -mpopcnt" \
    && make \
    && make install

RUN usermod --non-unique --uid ${UID} nginx \
    && groupmod --non-unique --gid ${GID} nginx

COPY --chown=${UID}:${GID} runtimes/ /etc/nginx

RUN apt-get autoremove -y \
    && apt-get clean -y \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/local/src/*

EXPOSE 1935
EXPOSE 1936

STOPSIGNAL SIGQUIT

CMD ["nginx", "-g", "daemon off;"]
