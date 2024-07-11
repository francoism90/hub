# Hub

## Introduction

Hub is a video on demand (VOD) media distribution system that allows users to access to videos, television shows and films.

> **NOTE:** This is a personal project, do not expect a production ready product.
It is mainly intended for learning and testing the latest Laravel features.

You can fork the project and make your own adjustments based on my changes.

See <https://github.com/francoism90/.github/tree/main/hub> for (WIP) screenshots.

## Prerequisites

- Linux (Fedora, Debian, Arch, Ubuntu)
- [Podman 5.1](https://podman.io/) or higher (with SELinux support)

## Installation

### Clone repository

Clone the repository, for example to `/home/<user>/Code/hub`:

```bash
cd ~/Code
git https://github.com/francoism90/hub.git
```

Configure Hub:

```bash
cd ~/Code/hub
cp .env.example .env
vi .env
```

To access Hub on your local machine, add the following `\etc\hosts` entries:

```md
127.0.0.1 hub.lan ws.hub.lan
::1 hub.lan ws.hub.lan
```

You can use your own DNS-server (like Adguard), to expose Hub on your LAN.

### Podman Quadlet

Please read the dedicated [guide](https://github.com/francoism90/hub/tree/main/podman) for usage with Podman Quadlet (recommended).

### Usage

You may need to alter permissions when using SELinux:

```bash
chcon -Rt container_file_t ~/Code/hub/storage
chcon -Rt container_file_t ~/Code/hub/storage/app/import/*
```

To start Hub:

```bash
systemctl --user start hub
```

Enter the `systemd-hub-app` container, and execute the followings commands:

```bash
$ podman exec -it systemd-hub-app sh
composer install
php artisan key:generate
php artisan storage:link
yarn install && yarn run build
php artisan app:install
```

The Hub instance should be available at <https://hub.lan> when using Traefik.

The following Laravel services are available:

- <https://hub.lan/horizon> - Laravel Horizon
- <https://hub.lan/pulse> - Laravel Pulse
- <https://hub.lan/telescope> - Laravel Telescope (disabled by default)

#### Managing media

To import videos:

```bash
php artisan videos:import
```

To clean (force-delete) videos:

```bash
php artisan videos:clean
```
