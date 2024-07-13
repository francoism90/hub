# Podman Quadlet

The given instructions are tested on Fedora 40 Silverblue with Podman 5.1 (rootless).

We recommend running containers rootless:

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

Adjust environment files in `~/.config/containers/systemd/hub`. Values should reflect the settings used in the Hub-project `.env`.

### Configure Proxy (optional)

[Traefik](https://doc.traefik.io/traefik/) is used as proxy. However you are free to use something else, or not even proxy at all.

> **TIP:** See <https://doc.traefik.io/traefik/middlewares/http/basicauth> for generating a basic-auth password.

It is also possible to use [Let's Encrypt](https://doc.traefik.io/traefik/https/acme/), or use your [own certificates](https://doc.traefik.io/traefik/https/tls/) for local development.

Adjust the configuration files in `~/.config/containers/systemd/traefik`, and make sure `podman.socket` is enabled (`systemctl --user enable podman.socket --now`).

To import certificates, it is recommended to use [secrets](https://www.redhat.com/sysadmin/new-podman-secrets-command):

```bash
podman secret create tlscert ~/.config/containers/systemd/traefik/certs/cert.pem
podman secret create tlskey ~/.config/containers/systemd/traefik/certs/key.pem
```

> **TIP:** Checkout [mkcert](https://github.com/FiloSottile/mkcert) for using TLS locally.

## Usage

To apply container changes:

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

## Fish

The following [abbreviations](https://fishshell.com/docs/current/cmds/abbr.html) may be useful:

```bash
$ cat ~/.config/fish/config.fish
# system
abbr -a -- sc 'sudo systemctl'
abbr -a -- scu 'systemctl --user'

# pods
abbr -a -- hub 'podman exec -it systemd-hub-app'
```
