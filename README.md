# Hub

## Introduction

Hub is a video on demand (VOD) media distribution system that allows users to access to videos, television shows and films.

> **NOTE:** This is a personal project, please do not expect a production ready product. It is mainly intended for learning and testing the latest Laravel features. You can fork the project and make your own adjustments based on my changes.

## Demo

A basic demo is available at <https://hub.foxws.nl/>.

Use the following login credentials (editing is disabled):

- Email: `demo@example.com`
- Password: `password`

Please note it's a low-tier VPS, expect slowness. :)

## Details

Hub has been build using the following stack:

- [nginx-vod-module (main)](https://github.com/kaltura/nginx-vod-module)
- [Laravel 11.x](https://laravel.com/)
- [Livewire 3.x](https://livewire.laravel.com/)
- [Podman 5.2.x](https://podman.io/)
- [Meilisearch 1.10.x](https://www.meilisearch.com/)

This is the preferred stack, please submit a PR if you want to provide other solutions. :)

## Prerequisites

- Linux (Fedora, CentOS Stream, Debian, Ubuntu, Arch) - WSLv2 is untested
- [Podman 5.2](https://podman.io/) or higher (with Quadlet/systemd + SELinux support) - Docker is untested

## Installation

### Clone repository

Clone the repository, for example to `/home/myuser/projects`:

```bash
cd ~/projects
git https://github.com/francoism90/hub.git
```

Configure Hub with your favorite editor:

```bash
cd ~/projects/hub
cp .env.example .env
vi .env
```

To access Hub locally, make sure to create the following `/etc/hosts` entries:

```md
127.0.0.1 hub.lan ws.hub.lan s3.hub.lan mc.hub.lan
::1 hub.lan ws.hub.lan s3.hub.lan mc.hub.lan
```

> **TIP:** You may want to use [AdGuard Home](https://adguard.com/en/adguard-home/overview.html) instead, and rewrite `hub.lan` & `*.hub.lan` to your homelab server.

### Podman Quadlet

Please read the [dedicated guide](https://github.com/francoism90/hub/tree/main/podman) for usage with Podman Quadlet.

## Usage

Start Hub:

```bash
systemctl --user start hub
```

On first installation, enter the `systemd-hub-app` container, and execute the followings commands:

```bash
$ podman exec -it systemd-hub-app sh
composer install
php artisan key:generate
php artisan storage:link
yarn install && yarn run build
php artisan app:install
php artisan user:create
```

The Hub instance should now be available at <https://hub.lan>.

The following services are accessible when being a super-admin:

- <https://hub.lan/horizon> - Laravel Horizon
- <https://hub.lan/pulse> - Laravel Pulse
- <https://hub.lan/telescope> - Laravel Telescope (disabled by default)

### Manage application

> **TIP:** Run `hub a` and `hub help` for all available commands.

Make sure to set permissions:

```bash
chcon -Rt container_file_t ~/Code/hub/storage/app/import/*
```

To import videos:

```bash
hub a videos:import
```

To create a tag:

```bash
hub a tag:create
```

To force removal of soft-deleted videos:

> **WARNING:** Only run this command when you don't want to restore deleted videos!

```bash
hub a videos:clean
```

## Updating

> **NOTE:** Please read the [following guide](https://github.com/francoism90/hub/tree/main/podman) for more details.

To retrieve the latest changes:

```bash
cd ~/projects/hub
git pull
```

To rebuild the Docker containers:

```bash
cd ~/projects/hub/podman
./update
systemctl --user restart hub
```

To update the application:

```bash
$ hub shell
composer install
yarn install && yarn run build
php artisan app:update
```

> **TIP:** See `Envoy.blade.php` for deploy details.
