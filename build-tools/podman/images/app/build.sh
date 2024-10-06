#!/bin/sh

podman build -t hub-app:latest "$@" .
