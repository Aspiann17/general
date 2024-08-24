# Developer Setup

## Build Image

```bash
podman build -t php:crud-dev -f Dockerfile.dev
```

## Run Image

```bash
podman run --name crud-dev -dp 8000:80 -v $(pwd):/var/www/html/ php:crud-dev
