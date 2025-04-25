# Upgrading

1. Sync with the latest changes:

```fish
cd ~/projects/hub
git pull
```

1. Rebuild containers (you may want to do this on weekly):

```fish
./bin/make-containers --no-cache
systemctl --user restart hub
```

1. Update the application:

```fish
hub composer install
hub pnpm install && hub pnpm build
hub a app:update --assets
```
