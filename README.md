# Hub

## Introduction

Hub is a video on demand (VOD) media distribution system that allows users to access to videos, television shows and films.

See <https://github.com/francoism90/.github/tree/main/hub> for (WIP) screenshots.

## Prerequisites

- Linux (Fedora, Debian, Arch, Ubuntu)
- [Podman 5.0](https://podman.io/) or higher (with SELinux support)

## Installation

### Clone repository

Clone the repository, for example to `/home/<user>/Code/hub`:

```bash
cd ~/Code
git https://github.com/francoism90/hub.git
```

Configure Hub:

```bash
cp .env.example .env
vi .env
```

The following DNS-records should be added of the machine running the instance if you want to expose it on your LAN, e.g.:

```md
192.168.1.100 hub.lan ws.hub.lan
```

If you only want to access Hub on your local machine, add the following `hosts` entry:

```md
127.0.0.1 hub.lan ws.hub.lan
```

### Podman Quadlet

Please read the dedicated [guide](https://github.com/francoism90/hub/tree/main/podman) for usage with Podman Quadlet.

### Usage

You may need to alter permissions when using SELinux:

```bash
chcon -Rt container_file_t ~/Code/hub/storage
```

To start Hub:

```bash
systemctl --user start hub.service
```

Enter the `systemd-hub-app` container, and execute the followings commands:

```bash
$ podman exec -it systemd-hub-app sh
php artisan key:generate
php artisan storage:link
yarn install && yarn run build
php artisan app:install
```

The Hub instance should be available at <https://hub.lan> when using Traefik.

The following Laravel services are available on:

- <https://hub.lan/horizon> - Laravel Horizon (super-admin only)
- <https://hub.lan/telescope> - Laravel Telescope (super-admin only)

## Media storage

You may want to use a different mount-point for media storage:

```bash
sudo mount --bind /mnt/data/videos/media ~/Code/hub/storage/app/media -o x-gvfs-hide
podman system migrate
systemctl --user restart hub-app hub
```

> **NOTE:** Make sure `/mnt/data/videos/media` also contains a `.gitigore` file.
