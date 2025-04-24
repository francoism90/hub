FROM docker.io/library/ubuntu:latest

ARG UID=1000
ARG GID=$UID
ARG TZ=UTC
ARG NODE_VERSION=22
ARG POSTGRES_VERSION=17

WORKDIR /app

ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=${TZ}
ENV PIP_BREAK_SYSTEM_PACKAGES=1
ENV OCTANE_COMMAND="/usr/bin/php -d variables_order=EGPCS /app/artisan octane:start --server=swoole --host=0.0.0.0 --port=8080"
ENV OCTANE_USER="docker"

RUN ln -snf /usr/share/zoneinfo/${TZ} /etc/localtime && echo ${TZ} > /etc/timezone

RUN apt-get update && apt-get upgrade -y \
    && mkdir -p /etc/apt/keyrings \
    && apt-get install -y gnupg curl ca-certificates zip unzip git sqlite3 libcap2-bin libpng-dev python3 python3-pip dnsutils librsvg2-bin fswatch nano \
    && apt-get install -y gifsicle jpegoptim optipng pngquant \
    && apt-get install -y libva2 libva-drm2 va-driver-all \
    && curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg \
    && echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_${NODE_VERSION}.x nodistro main" > /etc/apt/sources.list.d/nodesource.list \
    && curl -sS https://www.postgresql.org/media/keys/ACCC4CF8.asc | gpg --dearmor | tee /etc/apt/keyrings/pgdg.gpg >/dev/null \
    && echo "deb [signed-by=/etc/apt/keyrings/pgdg.gpg] http://apt.postgresql.org/pub/repos/apt noble-pgdg main" > /etc/apt/sources.list.d/pgdg.list \
    && curl -sS 'https://keyserver.ubuntu.com/pks/lookup?op=get&search=0xb8dc7e53946656efbce4c1dd71daeaab4ad4cab6' | gpg --dearmor | tee /etc/apt/keyrings/ppa_ondrej_php.gpg > /dev/null \
    && echo "deb [signed-by=/etc/apt/keyrings/ppa_ondrej_php.gpg] https://ppa.launchpadcontent.net/ondrej/php/ubuntu noble main" > /etc/apt/sources.list.d/ppa_ondrej_php.list \
    && apt-get update \
    && apt-get install -y php8.4-cli php8.4-dev \
       php8.4-pgsql php8.4-sqlite3 php8.4-gd \
       php8.4-curl php8.4-mongodb \
       php8.4-imap php8.4-mysql php8.4-mbstring \
       php8.4-xml php8.4-zip php8.4-bcmath php8.4-soap \
       php8.4-intl php8.4-readline php8.4-ldap \
       php8.4-msgpack php8.4-igbinary php8.4-redis php8.4-swoole \
       php8.4-memcached php8.4-pcov php8.4-imagick php8.4-xdebug \
    && curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer \
    && curl -sLS https://dl.min.io/client/mc/release/linux-amd64/mc --create-dirs -o /usr/local/bin/mc \
    && chmod +x /usr/local/bin/mc \
    && apt-get install -y postgresql-client-${POSTGRES_VERSION} \
    && apt-get install -y nodejs \
    && npm install -g npm \
    && npm install -g pnpm \
    && npm install -g svgo

RUN pip install --upgrade boto3 shaka-streamer shaka-streamer-binaries
RUN ln -sf /usr/local/lib/python3.12/dist-packages/streamer_binaries/ffmpeg-linux-x64-ubuntu-24.04 /usr/local/bin/ffmpeg \
    && ln -sf /usr/local/lib/python3.12/dist-packages/streamer_binaries/ffprobe-linux-x64 /usr/local/bin/ffprobe

COPY runtimes/container-entrypoint.sh /usr/local/bin/container-entrypoint.sh
COPY runtimes/php-development.ini /usr/local/etc/php/conf.d/99-user.ini

RUN setcap "cap_net_bind_service=+ep" /usr/bin/php8.4
RUN chmod +x /usr/local/bin/container-entrypoint.sh

RUN userdel -r ubuntu
RUN groupadd --force -g ${GID} docker \
    && useradd -ms /bin/bash --no-user-group -g ${GID} -u ${UID} docker

RUN apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

EXPOSE 5173
EXPOSE 6001
EXPOSE 8000

ENTRYPOINT ["container-entrypoint.sh"]
