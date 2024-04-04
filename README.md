# Hub

## Introduction

Hub is a video on demand (VOD) media distribution system that allows users to access to videos, television shows and films.

See <https://github.com/francoism90/.github/tree/main/hub> for (WIP) screenshots.

## Prerequisites

> **NOTE:**: Docker/WSLv2 should work, but has been untested.

- Linux (Ubuntu, Fedora, Arch)
- [Podman](https://podman.io/) with SELinux support
- [Podman Compose](https://github.com/containers/podman-compose)
- Running in rootless mode:
  - <https://github.com/containers/podman/blob/main/docs/tutorials/rootless_tutorial.md>
  - <https://wiki.archlinux.org/title/Podman#Rootless_Podman>
- [mkcert](https://github.com/FiloSottile/mkcert)
- DNS-server (recommended) or edit your `hosts` file.

## Installation

### Clone repository

Clone the repository, for example to `/home/<user>/Code/hub`:

```bash
cd ~/Code
git https://github.com/francoism90/hub.git
```

Configure the Hub services:

```bash
cp .env.example .env
vi .env
```

If you only want to access Hub on your local machine, add the following `hosts` entry:

```md
127.0.0.1 hub.lan ws.hub.lan
```

The following DNS-records should be added of the machine running the instance if you want to expose it on your LAN, e.g.:

```md
192.168.1.100 hub.lan ws.hub.lan
```

### Create certificate

To protect and use the hub instance, it is required to create a certificate.

> **NOTE:** This is not required when using your own domain and issuer.

Create a script to manage your local certificate, e.g. `cert.sh`:

```bash
#!/bin/sh
mkcert -install \
&& mkcert -key-file key.pem -cert-file cert.pem \
  hub.lan *.hub.lan \
  localhost \
  127.0.0.1 ::1
```

Execute the script:

```bash
chmod +x cert.sh
./cert.sh
```

Generate an one-time `dhparam.pem` file:

```bash
openssl dhparam -out dhparam.pem 2048
```

Copy the generated files or place your own certificate, into the `~/Code/hub/docker/ssl` folder.

> **TIP:** You may want to setup [mobile devices](https://github.com/FiloSottile/mkcert#mobile-devices).

### Usage

Hub comes with it's own Laravel Sail utility clone: `pco` (`bin/pco`).

It is designed to work exclusively with Podman Compose.

> **TIP:** You may want to add the following alias `alias pco='[ -f pco ] && sh pco || sh bin/pco'` to your `~/.zshrc`

Build Hub using:

```bash
pco pull
pco build --no-cache
```

You may need to alter permissions when using SELinux:

```bash
chcon -Rt container_file_t ~/Code/hub/storage
```

To start Hub:

```bash
pco up -d
pco composer i
pco npm i
pco a key:generate
pco a storage:link
pco a npm run build
pco a app:install
```

The Hub instance should be available at <https://hub.lan>.

The following administrator links are available:

- <https://hub.lan/admin> - Filament Panel
- <https://hub.lan/horizon> - Laravel Horizon (super-admin only)
- <https://hub.lan/telescope> - Laravel Telescope (super-admin only)

### Cheat sheet

To build Hub:

```bash
pco build --no-cache
```

To start Hub:

```bash
pco up -d
```

To stop Hub:

```bash
pco down
```

One may use the same Laravel Sail syntax, to enter and perform Laravel operations:

```bash
pco artisan make:controller TestController
pco a make:controller TestController
pco a migrate
pco npm run dev
pco npm run build
pco shell
pco help
```

You may want to use a different mount-point for media storage, without adjusting `docker-compose.yml`:

```bash
sudo mount --bind /mnt/data/videos/media ~/Code/hub/storage/app/media -o x-gvfs-hide
podman system migrate
pco up -d
```
