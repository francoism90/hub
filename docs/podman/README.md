# Podman Quadlet

To learn more about Podman Quadlet, consider reading the following resources:

- <https://docs.podman.io/en/latest/markdown/podman-systemd.unit.5.html>
- <https://www.redhat.com/sysadmin/quadlet-podman>
- <https://mo8it.com/blog/quadlet/>

## Prerequisites

- Linux (Fedora, CentOS Stream, Debian, Ubuntu, Arch).
- [Podman 5.3 or higher](https://podman.io/) with Quadlet (systemd) and SELinux support.

This guide assumes you have a rootless setup:

- <https://github.com/containers/podman/blob/main/docs/tutorials/rootless_tutorial.md>
- <https://wiki.archlinux.org/title/Podman#Rootless_Podman>

## Installation

### Build containers

Build the Docker images (this may take some time):

```bash
cd ~/projects/hub
./containers/make
```

To rebuild or update the current images:

```bash
cd ~/projects/hub
./containers/make --no-cache
```

### Systemd units

Copy the `systemd` directory to `~/.config/containers`, verify the path `~/.config/containers/systemd/hub` exists:

```bash
cd ~/projects/hub
cp -r docs/podman/containers/systemd ~/.config/containers/
```

Adjust environment files in `~/.config/containers/systemd/hub/config`, update `~/projects/hub/.env` to reflect any systemd unit changes.

Make sure to always reload the systemd container on changes:

```bash
systemctl --user daemon-reload
```

### Proxy

[Caddy](https://caddyserver.com/) is used as proxy. However you are free to use something else (like Traefik or nginx).

In this guide it uses Caddy's `tls internal` to provide a self-signed certificate.

Start the proxy server:

```bash
systemctl --user start caddy
```

To export generated CA of the Caddy proxy:

```bash
podman cp systemd-caddy:/data/caddy/pki/authorities/local/root.crt ~/Documents/caddy.crt
```

You can import this CA to your devices and browser(s), and make it look trusted.

## Usage

> Follow the main README.md for installing Hub when running it first time.

To start Hub:

```bash
systemctl --user start caddy # or your proxy solution
systemctl --user start hub
```

To stop Hub:

```bash
systemctl --user stop hub
```

## Shell utility

Hub provides the shell utility named `hub`, and is based on [Laravel Sail](https://github.com/laravel/sail/blob/1.x/bin/sail) with adjustments made for Podman Quadlet.

To install, create a shell `alias`, e.g. using [fish-shell](https://fishshell.com/docs/current/cmds/alias.html):

```fish
alias --save hub '~/projects/hub/bin/quadlet'
```

This allows to interact with the `systemd-hub-app` container using the same syntax like Laravel Sail:

```fish
hub help
hub shell
hub a app:update
hub a app:optimize
hub a videos:import
```

To interact with the container without the `hub` utility:

```bash
podman exec -it systemd-hub-app php artisan app:optimize
```
