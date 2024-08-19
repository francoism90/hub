# Hub

## Introduction

Hub is a video on demand (VOD) media distribution system that allows users to access to videos, television shows and films.

> **NOTE:** This is a personal project, please do not expect a production ready product. It is mainly intended for learning and testing the latest Laravel features. You can fork the project and make your own adjustments based on my changes.

See <https://github.com/francoism90/.github/tree/main/hub> for (WIP) screenshots.

## Prerequisites

-   Linux (Fedora, Debian, Arch, Ubuntu) - WSL is untested
-   [Podman 5.1](https://podman.io/) or higher (with SELinux support)

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

To access Hub on your local machine, add the following `/etc/hosts` entries:

```md
127.0.0.1 hub.lan ws.hub.lan
::1 hub.lan ws.hub.lan
```

You can use your own DNS-server (like Adguard), to expose Hub on your LAN.

### Podman Quadlet

Please read the dedicated [guide](https://github.com/francoism90/hub/tree/main/podman) for usage with Podman Quadlet.

## Usage

Start Hub:

```bash
systemctl --user start hub-app hub
```

On first run, enter the `systemd-hub-app` container, and execute the followings commands:

```bash
$ hub shell
composer install
php artisan key:generate
php artisan storage:link
yarn install && yarn run build
php artisan app:install
```

The Hub instance should be available at <https://hub.lan> when using the given examples.

The following Laravel services are available, and can be accessed when logged-in as super-admin:

-   <https://hub.lan/horizon> - Laravel Horizon
-   <https://hub.lan/pulse> - Laravel Pulse
-   <https://hub.lan/telescope> - Laravel Telescope (disabled by default)

### Manage application

> **NOTE:** Run `hub a` and `hub help` for all available commands.

To import videos:

```bash
cp -r /path/to/import/from/* ~/Code/hub/storage/app/import/
chcon -Rt container_file_t ~/Code/hub/storage/app/import/*
hub a videos:import
```

To create a tag:

```bash
hub a tags:create
```

To force removing of soft-deleted videos:

> **WARNING:** Only run command when you don't want to restore all deleted videos!

```bash
hub a videos:clean
```

## Updating

> **NOTE:** See [guide](https://github.com/francoism90/hub/tree/main/podman) on managing containers.

To retrieve the latest changes:

```bash
cd ~/Code/hub
git pull
```

It is recommended to rebuild the Docker containers at least weekly:

```bash
cd ~/Code/hub/podman
./update
systemctl --user restart hub-app hub
```

To update the application:

```bash
$ hub shell
composer install
yarn install && yarn run build
php artisan app:update
```
