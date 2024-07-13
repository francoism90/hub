# Hub

## Introduction

Hub is a video on demand (VOD) media distribution system that allows users to access to videos, television shows and films.

> **NOTE:** This is a personal project, please do not expect a production ready product. It is mainly intended for learning and testing the latest Laravel features.

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

To access Hub on your local machine, add the following `/etc/hosts` entries:

```md
127.0.0.1 hub.lan ws.hub.lan
::1 hub.lan ws.hub.lan
```

You can use your own DNS-server (like Adguard), to expose Hub on your LAN.

### Podman Quadlet

Please read the dedicated [guide](https://github.com/francoism90/hub/tree/main/podman) for usage with Podman Quadlet (recommended).

### Usage

#### First run

Start Hub:

```bash
systemctl --user start hub-app hub
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

#### Updating

See [guide](https://github.com/francoism90/hub/tree/main/podman) on managing on the Docker images.

It is advisable to rebuild the images:

```bash
cd ~/Code/hub/podman
./update
```

To get latest changes:

```bash
cd ~/Code/hub
git pull
```

To update the application:

```bash
$ podman exec -it systemd-hub-app sh
composer install
yarn install && yarn run build
php artisan app:update
```

#### Manage application

The following [abbreviations](https://fishshell.com/docs/current/cmds/abbr.html) may be useful:

```bash
$ cat ~/.config/fish/config.fish
# system
abbr -a -- sc 'sudo systemctl'
abbr -a -- scu 'systemctl --user'

# containers
abbr -a -- hub 'podman exec -it systemd-hub-app'
```

To import videos:

```bash
cp -r /path/to/import/from/* ~/Code/hub/storage/app/import/
chcon -Rt container_file_t ~/Code/hub/storage/app/import/*
hub php artisan videos:import
```

To clean soft-deleted videos (force-delete):

```bash
hub php artisan videos:clean
```
