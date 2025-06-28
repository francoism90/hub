# Hub

## Introduction

Hub is a video on demand (VOD) media distribution system that allows users to access to videos, television shows and films.

> **NOTE:** This is a personal project, and is still in development. Use at your own risk!

## Details

Hub uses the following stack:

- [nginx-vod-module (main branch)](https://github.com/diogoazevedos/nginx-vod-module)
- [Laravel 12.x](https://laravel.com/)
- [Livewire 3.x](https://livewire.laravel.com/)
- [PostgreSQL 17.x](https://www.postgresql.org/)
- [Podman 5.x](https://podman.io/)
- [Meilisearch 1.x](https://www.meilisearch.com/)

This is the preferred stack, please submit a PR if you would like to support other solutions.

## Prerequisites

- Any modern hardware (AArch64 is untested).
- Linux (Debian, Ubuntu, SUSE, CentOS, Arch, ..). - WSLv2 is untested.
- [Podman 5.3 or higher](https://podman.io/) with Quadlet (systemd) and SELinux support.

> **NOTE:** Docker is unsupported, but should work with a `docker-compose.yml` file. PRs are welcome.

## Installation

### Clone repository

1. Clone the repository, for example to `~/projects`:

```bash
cd ~/projects
git https://github.com/francoism90/hub.git
```

1. Configure Hub with your favorite editor:

```bash
cd ~/projects/hub
cp .env.example .env
vi .env
```

1. See [Podman guide](docs/podman.md) to configure Podman Quadlet.

1. See [MinIO guide](docs/minio.md) to configure MinIO.

## Usage

The Hub instance should be available at <https://hub.test>, after running:

```bash
systemctl --user start proxy hub
systemctl --user status hub
```

> **NOTE:** Make sure MinIO is configured first.

Enter the `systemd-hub` container, and execute the followings commands:

```bash
$ podman exec -it systemd-hub /bin/bash # or hub shell
composer install
php artisan key:generate
php artisan storage:link
pnpm install && pnpm build
php artisan app:install
```

The following services are only accessible when being a super-admin (see `database/seeders/UserSeeder.php` for example):

- <https://hub.test/horizon> - Laravel Horizon
- <https://hub.test/telescope> - Laravel Telescope (disabled by default)

To seed an example super-admin user:

```bash
php artisan db:seed --class=UserSeeder:class
```

### Manage application

> **TIP:** Run `hub a` and `hub help` for all available commands.

To import videos:

```bash
chcon -Rv system_u:object_r:container_file_t:s0 /path/to/import/* # if running SELinux
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

To force the removal of deleted videos:

> **WARNING:** This will remove any soft-deleted videos!

```bash
hub a videos:clean
```

To force (re-)indexing of all models:

```bash
hub a scout:sync
```

## Upgrading

See [UPGRADING.md](UPGRADING.md)
