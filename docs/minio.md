---
title: MinIO
order: 2
tags:
  - minio
  - s3
  - storage
  - assets
---

To learn more about MinIO, consider reading the following resources:

- <https://min.io/>
- <https://min.io/docs/minio/linux/reference/minio-mc.html>

## Prerequisites

- MinIO up-and-running
- MinIO Client `mc`

## Usage

1. Make sure minio is up and running:

```bash
systemctl --user start hub-minio
```

1. Setup connection using the generated access keys:

```bash
mc alias set myminio http://systemd-hub-minio:9000 <username> <password>
mc admin info myminio
```

1. Generate an access key + secret key:

```bash
mc admin user svcacct add myminio hub
```

1. Update `AWS_ACCESS_KEY_ID` `AWS_SECRET_ACCESS_KEY` in `.env`.

1. Create required buckets (add your own if required):

```bash
mc mb myminio/local
mc mb myminio/assets
mc mb myminio/conversions
```

1. Set anonymous `download` permissions:

```bash
mc anonymous set download myminio/assets
mc anonymous set download myminio/conversions
```

## Disable bucket listing

Disabling bucket listing is optional, but highly recommended on production.

1. Export current bucket permissions:

```bash
cd /tmp
mc anonymous get-json myminio/assets > assets.json
mc anonymous get-json myminio/conversions > conversions.json
```

1. Remove the `"s3:ListBucket"` from the `Action` array in each `<bucket>.json` file:

```bash
vi assets.json
vi conversions.json
```

1. Update the bucket policy:

```bash
mc anonymous set-json assets.json myminio/assets
mc anonymous set-json conversions.json myminio/conversions
rm -rf assets.json conversions.json
```

## Migrate data

To copy any local stored generated conversions to a backup:

```bash
mc cp --recursive conversions/ myminio/conversions/
```
