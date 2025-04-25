---
title: Podman Quadlet
order: 1
tags:
  - podman
  - quadlet
  - systemd
---

To learn more about Podman Quadlet, please consider reading the following resources first:

- <https://docs.podman.io/en/latest/markdown/podman-systemd.unit.5.html>
- <https://www.redhat.com/sysadmin/quadlet-podman>
- <https://mo8it.com/blog/quadlet/>

## Prerequisites

- Linux (Debian, Ubuntu, SUSE, CentOS, Arch, ..).
- [Podman 5.2 or higher](https://podman.io/), with Quadlet (systemd) and SELinux support.

It's recommend running a rootless setup:

- <https://github.com/containers/podman/blob/main/docs/tutorials/rootless_tutorial.md>
- <https://wiki.archlinux.org/title/Podman#Rootless_Podman>

## Installation

### Build containers

Build the Docker images (this may take some time):

```bash
cd ~/hub
bin/build-containers
```

To rebuild with no-cache (append other args if needed):

```bash
cd ~/hub
bin/build-containers --no-cache
```

### Systemd units

Copy the `systemd` directory to `~/.config/containers`, verify the path `~/.config/containers/systemd/hub` exists:

```bash
mkdir -p ~/.config/containers/
cp -r ~/hub/containers/systemd ~/.config/containers/
```

Adjust environment files in `~/.config/containers/systemd/hub/config`, update `~/hub/.env` to reflect any systemd unit changes:

```bash
cd ~/.config/containers/systemd/hub/config
vi app.env postgres.env ..
```

### Configure Proxy

[Caddy](https://caddyserver.com/) is used as proxy. However you are free to use something else, or not even proxy at all.

It is possible to use [Let's Encrypt](https://doc.traefik.io/traefik/https/acme/), or use your [own certificate](https://doc.traefik.io/traefik/https/tls/).

The given configuration assumes you use a TLS with Let's Encrypt.

Adjust the environment files in `~/.config/containers/systemd/traefik/config`, and make sure `podman.socket` is enabled:

```bash
systemctl --user enable podman.socket --now`
systemctl --user start proxy`
```

To copy the generated Caddy CA:

```bash
podman cp systemd-proxy:/data/caddy/pki/authorities/local/root.crt ~/Downloads/proxy.crt
```

## Usage

Make sure to reload systemd on configuration changes:

```bash
systemctl --user daemon-reload
systemctl --user restart hub
```

To start Hub:

```bash
systemctl --user start proxy
systemctl --user start hub
```

To stop Hub:

```bash
systemctl --user stop hub
```

## Shell utility

Hub provides a shell utility, which is a copy of [Laravel Sail](https://github.com/laravel/sail/blob/1.x/bin/sail) with adjustments made for the usage with Podman Quadlet.

To install, create a shell `alias`, e.g. when using [fish-shell](https://fishshell.com/docs/current/cmds/alias.html):

```fish
alias --save hub '~/hub/bin/quadlet'
```

This allows interacting with the `systemd-hub` container using the same logic like Laravel Sail:

```fish
hub help
hub shell
hub a app:update
hub a app:optimize
hub a videos:import
hub a migrate
```

To interact with the container without the utility:

```bash
podman exec -it systemd-hub php artisan app:optimize
```
