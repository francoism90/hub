# Hub

## Introduction

Hub is a video on demand (VOD) media distribution system that allows users to access to videos, television shows and films.

> **NOTE:** This is a personal project, and is still in development. Use at your own risk!

## Details

Hub uses the following stack:

- [nginx-vod-module (main)](https://github.com/kaltura/nginx-vod-module)
- [Laravel 11.x](https://laravel.com/)
- [Livewire 3.x](https://livewire.laravel.com/)
- [PostgreSQL 17.x](https://www.postgresql.org/)
- [Podman 5.x](https://podman.io/)
- [Meilisearch 1.x](https://www.meilisearch.com/)

This is the preferred stack, please submit a PR if you would like to support other solutions. :)

## Prerequisites

- Linux (Fedora, CentOS Stream, Debian, Ubuntu, Arch) - WSLv2 is untested.
- [Podman 5.2 or higher](https://podman.io/), with Quadlet (systemd) + SELinux support - Docker is untested, but should work without the SELinux mount flags (ro, rw, U, Z, etc.).

## Installation

### Clone repository

Clone the repository, for example to `~/projects`:

```bash
cd ~/projects
git https://github.com/francoism90/hub.git
```

Configure Hub with your favorite editor:

```bash
cd ~/projects/hub
cp .env.example .env
nano .env
```

To access Hub locally (in this case `dev.lan`  is the development machine), make sure to create the following `/etc/hosts` entries:

```md
127.0.0.1 hub.dev.lan hub-ws.dev.lan hub-s3.dev.lan hub-mc.dev.lan
::1 hub.dev.lan hub-ws.dev.lan hub-s3.dev.lan hub-mc.dev.lan
```

> **TIP:** You may want to use [AdGuard Home](https://adguard.com/en/adguard-home/overview.html) instead, and rewrite `hub.dev.lan` & `*.hub.dev.lan` to your homelab server.

### Podman Quadlet

Please read [following guide](docs/podman/README.md) to configure Podman Quadlet.

### MinIO

Please read [following guide](docs/minio/README.md) to configure MinIO.

## Usage

The Hub instance should be available at <https://hub.dev.lan>, after running:

```bash
systemctl --user start caddy hub
systemctl --user status hub
```

Enter the `systemd-hub-app` container, and execute the followings commands:

```bash
$ podman exec -it systemd-hub-app sh # or hub shell
composer install
php artisan key:generate
php artisan storage:link
yarn install && yarn run build
php artisan app:install
php artisan db:seed --class=UserSeeder:class
```

The following services are only accessible when being a super-admin (see `database/seeders/UserSeeder.php` for example):

- <https://hub.dev.lan/horizon> - Laravel Horizon
- <https://hub.dev.lan/pulse> - Laravel Pulse
- <https://hub.dev.lan/telescope> - Laravel Telescope (disabled by default)

### Manage application

> **TIP:** Run `hub a` and `hub help` for all available commands.

To import videos:

```bash
chcon -Rt container_file_t ~/projects/hub/storage/app/import/* # if running SELinux
hub a videos:import
```

To create a tag:

```bash
hub a tag:create
```

To create an user:

```bash
hub a user:create
```

To force the removal of soft-deleted videos:

> **WARNING:** This will remove any soft-deleted videos!

```bash
hub a videos:clean
```

To force (re-)indexing of models:

```bash
hub a scout:sync
```

## Upgrading

See [UPGRADING.md](UPGRADING.md)

## Deployment

See [Envoy.blade.php](Envoy.blade.php) for deployment details.
