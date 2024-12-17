# Upgrading

Sync with the latest changes:

```fish
cd ~/projects/hub
git pull
```

To rebuild containers (you may want to do this on a weekly basis):

```fish
cd ~/projects/hub
./docs/podman/make --no-cache
systemctl --user restart hub
```

Finally, update the application:

```fish
hub composer install
hub yarn install && hub yarn run build
hub a app:update --assets
```

It should automatically restart any container services.

In case of errors, try to restart the container first:

```fish
systemctl --user restart hub
systemctl --user restart caddy
```
