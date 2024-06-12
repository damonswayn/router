build-docker:
	docker build . -t php-router

run-docker: build-docker
	docker run -it -v $(PWD):/app php-router /bin/bash

install-dependencies:
	composer install

run-tests: install-dependencies
	composer run test