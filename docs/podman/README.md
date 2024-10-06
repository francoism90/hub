# Podman Quadlet

To learn more about Podman Quadlet, the following resources may be useful:

- <https://docs.podman.io/en/latest/markdown/podman-systemd.unit.5.html>
- <https://www.redhat.com/sysadmin/quadlet-podman>
- <https://mo8it.com/blog/quadlet/>

## Prerequisites

- Linux (Fedora, CentOS Stream, Debian, Ubuntu, Arch).
- [Podman 5.2 or higher](https://podman.io/), with Quadlet (systemd) + SELinux support.

It's recommend running a rootless setup:

- <https://github.com/containers/podman/blob/main/docs/tutorials/rootless_tutorial.md>
- <https://wiki.archlinux.org/title/Podman#Rootless_Podman>

## Installation

### Build containers

Build the Docker images (this may take some time):

```bash
cd ~/projects/hub
./docs/podman/make
```

### Systemd units

Copy the `systemd` directory to `~/.config/containers`, verify the path `~/.config/containers/systemd/hub` exists.

Adjust environment files in `~/.config/containers/systemd/hub/config`, update `~/projects/hub/.env` to reflect any systemd unit changes.

### Configure Proxy

[Traefik](https://doc.traefik.io/traefik/) is used as proxy. However you are free to use something else, or not even proxy at all.

It is possible to use [Let's Encrypt](https://doc.traefik.io/traefik/https/acme/), or use your [own certificate](https://doc.traefik.io/traefik/https/tls/).

The given configuration assumes you use a generated certifcate by [mkcert](https://github.com/FiloSottile/mkcert), and you run Hub in a homelab.

Adjust the environment files in `~/.config/containers/systemd/traefik/config`, and make sure `podman.socket` is enabled:

```bash
systemctl --user enable podman.socket --now`
```

To import the custom certificate, prefer the usage of [secrets](https://www.redhat.com/sysadmin/new-podman-secrets-command):

```bash
podman secret create tlscert ~/.config/containers/systemd/traefik/certs/cert.pem
podman secret create tlskey ~/.config/containers/systemd/traefik/certs/key.pem
```

To passport protect the Traefik dashboard, generate an [user:password pair](https://doc.traefik.io/traefik/middlewares/http/basicauth/#usersfile):

```bash
echo -n $(htpasswd -nB user) > ./usersfile
podman secret create usersfile ./usersfile
```

Finally restart Traefik:

```bash
systemctl --user restart traefik.service
```

You will now able to access <https://traefik.host.lan/> with the generated `user:password`, and the Hub-instance on <https://host.lan/>.

## Usage

Make sure to reload systemd on configuration changes:

```bash
systemctl --user daemon-reload
systemctl --user restart hub
```

To start Hub:

```bash
systemctl --user start hub
```

To stop Hub:

```bash
systemctl --user stop hub
```

To update/rebuild the Docker images:

```bash
cd ~/projects/hub/podman
./update
```

## Shell utility

Hub provides the shell utility named `hub`, and is based on [Laravel Sail](https://github.com/laravel/sail/blob/1.x/bin/sail) with adjustments made for Podman Quadlet.

To install, create a shell `alias`, e.g. using [fish-shell](https://fishshell.com/docs/current/cmds/alias.html):

```bash
alias --save hub '~/projects/hub/bin/quadlet'
```

This allows to interact with the `systemd-hub-app` container using the same syntax like Laravel Sail:

```fish
hub help
hub shell
hub a videos:import
```
