# Podman Quadlet

The given instructions are tested on Fedora 40 Silverblue with Podman 5.1 (rootless).

It's recommend running containers rootless:

- <https://github.com/containers/podman/blob/main/docs/tutorials/rootless_tutorial.md>
- <https://wiki.archlinux.org/title/Podman#Rootless_Podman>

To learn more about Podman Quadlet, the following resources may be useful:

- <https://docs.podman.io/en/latest/markdown/podman-systemd.unit.5.html>
- <https://www.redhat.com/sysadmin/quadlet-podman>
- <https://mo8it.com/blog/quadlet/>

## Installation

Build the Docker images:

```bash
cd hub/podman
./make
```

Copy the `systemd` directory to `~/.config/containers`, verify `~/.config/containers/systemd/hub.container` exists.

Adjust environment files in `~/.config/containers/systemd/hub`. Values should reflect the settings used in the Hub-project `~/Code/hub/.env`.

### Configure Proxy

[Traefik](https://doc.traefik.io/traefik/) is used as proxy. However you are free to use something else, or not even proxy at all.

> **NOTE:** See <https://doc.traefik.io/traefik/middlewares/http/basicauth> for generating a basic-auth password.

> **TIP:** Checkout [mkcert](https://github.com/FiloSottile/mkcert) for using TLS/HTTPS locally.

It is also possible to use [Let's Encrypt](https://doc.traefik.io/traefik/https/acme/), or use your [own certificates](https://doc.traefik.io/traefik/https/tls/) for local instances. The given configuration assumes you use an own generated certifcate by `mkcert` and run Hub locally.

Adjust the configuration files in `~/.config/containers/systemd/traefik`, and make sure `podman.socket` is enabled (`systemctl --user enable podman.socket --now`).

To import your certificates, use [secrets](https://www.redhat.com/sysadmin/new-podman-secrets-command):

```bash
podman secret create tlscert ~/.config/containers/systemd/traefik/certs/cert.pem
podman secret create tlskey ~/.config/containers/systemd/traefik/certs/key.pem
```

## Usage

To apply any container changes:

```bash
systemctl --user daemon-reload
systemctl --user restart hub-app hub
```

To start containers:

```bash
systemctl --user start hub
```

## Update

To update/rebuild the Docker images:

```bash
cd hub/podman
./update
```

Restart services:

```bash
systemctl --user restart hub-app hub
```

## Bash

Hub comes with a shell utility called `hub`, and is based on [Laravel Sail](https://github.com/laravel/sail/blob/1.x/bin/sail) with adjustments for Podman Quadlet.

To install, create a `alias`, e.g. using [fish-shell](https://fishshell.com/docs/current/cmds/alias.html):

```bash
alias --save hub '~/path/of/hub/bin/quadlet'
```

This allows to interact with the `systemd-hub-app` container using the same syntax like Laravel Sail. Run `hub help` for details.
