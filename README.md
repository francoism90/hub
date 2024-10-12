# Hub

## Introduction

Hub is a video on demand (VOD) media distribution system that allows users to access to videos, television shows and films.

> **NOTE:** This is a personal project, and is still in development. Use at your own risk!

## Demo

A basic demo is available at <https://hub.foxws.nl/>.

Use the following login credentials (managing videos has been disabled):

- Email: `demo@example.com`
- Password: `password`

Please note it's a low-tier VPS, expect slowness. :)

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
- [Podman 5.2 or higher](https://podman.io/), with Quadlet (systemd) + SELinux support - Docker is untested, but should work without the SELinux mount flags.

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
vi .env
```

To access Hub locally, make sure to create the following `/etc/hosts` entries:

```md
127.0.0.1 hub.lan ws.hub.lan s3.hub.lan mc.hub.lan
::1 hub.lan ws.hub.lan s3.hub.lan mc.hub.lan
```

> **TIP:** You may want to use [AdGuard Home](https://adguard.com/en/adguard-home/overview.html) instead, and rewrite `hub.lan` & `*.hub.lan` to your homelab server.

### Podman Quadlet

Please read the [following guide](docs/podman/README.md) for usage with Podman Quadlet.

### MinIO

Please read the [following guide](docs/minio/README.md) for usage with MinIO.

### First run

Make sure Hub is up-and-running:

```bash
systemctl --user restart hub
systemctl --user status hub
```

Enter the `systemd-hub-app` container (`hub shell`), and execute the followings commands:

```bash
$ podman exec -it systemd-hub-app sh
composer install
php artisan key:generate
php artisan storage:link
yarn install && yarn run build
php artisan app:install
php artisan user:create
```

## Usage

The Hub instance should be available at <https://hub.lan>.

The following services are only accessible when being a super-admin:

- <https://hub.lan/horizon> - Laravel Horizon
- <https://hub.lan/pulse> - Laravel Pulse
- <https://hub.lan/telescope> - Laravel Telescope (disabled by default)

### Manage application

> **TIP:** Run `hub a` and `hub help` for all available commands.

Make sure to set correct permissions:

```bash
chcon -Rt container_file_t ~/projects/hub/storage/app/import/*
```

To import videos:

```bash
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

> **WARNING:** Only run this command when you don't want to restore any deleted videos!

```bash
hub a videos:clean
```

## Upgrading

See [UPGRADING.md](UPGRADING.md)

## Deployment

See [Envoy.blade.php](Envoy.blade.php) for deployment details.
