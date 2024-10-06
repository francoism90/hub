# Upgrading

Sync with the latest changes:

```bash
cd ~/projects/hub
git pull
```

To rebuild containers (try to do this weekly):

```bash
cd ~/projects/hub
./docs/podman/make --no-cache
systemctl --user restart hub
```

Update the application:

```bash
$ hub shell
composer install
yarn install && yarn run build
php artisan app:update --assets
```
