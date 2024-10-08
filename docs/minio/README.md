# MinIO

To learn more about MinIO, consider reading the following resources:

- <https://min.io/>
- <https://min.io/docs/minio/linux/reference/minio-mc.html>

## Prerequisites

- Hub up-and-running
- MinIO Client (`mc`)

## Usage

> **NOTE:** Append `--insecure` to each `mc` command when using a self signed certificate.

1. Create an (temporary) access key (<https://mc.hub.lan/access-keys>).

2. Setup connection:

```bash
mc alias set myminio https://s3.hub.lan AWS_ACCESS_KEY_ID AWS_SECRET_ACCESS_KEY
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

## Migrate data

To copy any local stored generated conversions to a backup:

```bash
cd ~/projects/hub/storage/app
mc cp --recursive conversions/ myminio/conversions/
```

## Disable bucket listing

To disable listing of buckets:

```bash
mc anonymous get-json myminio/assets > assets.json
mc anonymous get-json myminio/conversions > conversions.json
```

Remove the `"s3:ListBucket"` from the `Action` array.

Update the bucket policy:

```bash
mc anonymous set-json assets.json myminio/assets
mc anonymous set-json conversions.json myminio/conversions
```
