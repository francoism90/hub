# Upgrading

> **TIP:** You may want to enable `podman-auto-update.timer` to automatically update containers.

1. Sync with the latest changes:

```fish
cd ~/projects/hub
git pull
```

1. Rebuild containers (you may want to do this on weekly):

```fish
./bin/make-containers --no-cache
```

1. Restart the affected containers:

```fish
systemctl --user restart hub hub-queue hub-reverb hub-schedule
```

1. To update the application:

```fish
hub composer install
hub pnpm install && hub pnpm build
hub a app:update --assets
```
