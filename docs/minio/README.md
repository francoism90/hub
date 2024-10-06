# MinIO

To learn more about MinIO, consider reading the following resources:

- <https://min.io/>
- <https://min.io/docs/minio/linux/reference/minio-mc.html>

## Prerequisites

- Hub up-and-running
- MinIO Client (`mc`)

## Usage

1. Create an (temporary) access key (<https://mc.hub.lan/access-keys>).

2. Setup connection:

```bash
mc alias set myminio http://localhost:9000 ACCESS_KEY SECRET_KEY
mc admin info myminio
```

3. Create buckets:

```bash
mc mb myminio/assets
mc mb myminio/conversions
mc mb myminio/local
```

4. Set anonymous permissions:

```bash
mc anonymous set download myminio/assets
mc anonymous set download myminio/conversions
```

## Migrate to MinIO

To copy any local generated conversions:

```bash
cd ~/projects/hub/storage/app
mc cp --recursive conversions/ myminio/conversions/ --insecure
```
