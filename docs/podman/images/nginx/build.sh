#!/bin/sh

podman build -t hub-nginx:latest "$@" .
