# Hub

## Introduction

Hub is a video on demand (VOD) media distribution system that allows users to access to videos, television shows and films.

## Details

Hub uses the following stack:

- [Laravel 12.x](https://laravel.com/)
- [Inertia 2.x](https://inertiajs.com/)
- [PostgreSQL 17.x](https://www.postgresql.org/)
- [Podman 5.x](https://podman.io/)
- [Meilisearch 1.x](https://www.meilisearch.com/)

## Prerequisites

- Linux (Debian, Fedora, Arch, CentOS, Ubuntu, ..).
- [Podman 5.3 or higher](https://podman.io/) with Quadlet (systemd) support.

## Installation

### Clone repository

1. Clone the repository, for example to `~/projects`:

```bash
cd ~/projects
git https://github.com/francoism90/hub.git
```

1. Setup [Podman Quadlet](docs/podman.md).

1. Open the project with VSCode and run it as a dev-container.

1. Perform the following commands in a terminal:

```bash
composer install
php artisan storage:link
php artisan key:generate
php artisan google-fonts:fetch
php artisan migrate --seed
pnpm install && pnpm build
```

## Usage

The instance should be available at <https://hub.test>.

The following services are only accessible when being a *super-admin*:

- <https://hub.test/horizon> - Laravel Horizon
- <https://hub.test/telescope> - Laravel Telescope (disabled by default - only use on development)

To seed an example super-admin user:

```bash
php artisan db:seed --class=UserSeeder:class
```

## Upgrading

See [UPGRADING.md](UPGRADING.md)
