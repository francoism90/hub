---
title: Podman Quadlet
order: 1
tags:
  - podman
  - quadlet
  - systemd
  - caddy
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
cd ~/projects/hub
bin/build-containers
```

### Systemd units

Copy the `systemd` directory to `~/.config/containers`, verify the path `~/.config/containers/systemd/hub` exists:

```bash
mkdir -p ~/.config/containers/
cp -r ~/hub/containers/systemd ~/.config/containers/
```

Adjust all environment files in `~/.config/containers/systemd/hub/config`, update `~/projects/hub/.env` to reflect any changes:

```bash
cd ~/.config/containers/systemd/hub/config
vi app.env postgres.env ..
```

#### Hardware acceleration

> **NOTE:** Hardware acceleration profiles are not provided yet.

To use hardware acceleration, you need to allow the container to access the render device. If you are using container-selinux-2.226 or later, you have to set the container_use_dri_devices flag in selinux or the container will not be able to use it:

```bash
# setsebool -P container_use_dri_devices 1
```

In the systemd containers uncommend or append the following line:

```systemd
[Container]
Image=localhost/hub-app:latest
AddDevice=/dev/dri/:/dev/dri/
```

### Configure Proxy

[Caddy](https://caddyserver.com/) is used as proxy. However you are free to use something else.

The given configuration assumes you want to use self-signed certificates:

```bash
cd ~/.config/containers/systemd/proxy/config
vi Caddyfile sites/hub.caddy
systemctl --user enable podman.socket --now`
systemctl --user start proxy`
```

To access Hub, make sure to append the following entries to your hosts (`/etc/hosts`) file:

```text
# hub
127.0.0.1 hub.test ws.hub.test play.hub.test live.hub.test s3.hub.test mc.hub.test
::1 hub.test ws.hub.test play.hub.test live.hub.test s3.hub.test mc.hub.test
```

> **TIP:** You may want to use [AdGuard Home](https://adguard.com/en/adguard-home/overview.html) instead, and rewrite `hub.test` & `*.hub.test` requests to your homelab server.

To copy the generated Caddy CA that can be imported into your browsers certificate keychain:

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
alias --save hub '~/projects/hub/bin/quadlet'
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
