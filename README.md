# Router

## How to run

The `Makefile` has been preset with the following commands to spin up a php environment to use.

- `make build-docker` - builds the docker image
- `make run-docker` - runs the docker image and mounts the current directory as a volume to `/app`
- `make install-dependencies` - runs composer to install dependencies
- `make run-tests` - runs the test suite