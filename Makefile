SHELL := /bin/bash

install: export APP_ENV=dev
install:
	docker-compose up -d
	composer install
	symfony serve -d
	symfony console d:d:c
	symfony console d:m:m --no-interaction
.PHONY: install

start: export APP_ENV=dev
start:
	docker-compose up -d
	symfony serve -d
.PHONY: start

fixtures: export APP_ENV=dev
fixtures:
	symfony console d:f: --no-interaction
.PHONY: fixtures

stop: export APP_ENV=dev
stop:
	docker-compose stop
	symfony server:stop
.PHONY: stop

tests: export APP_ENV=test
tests: reset-test
	symfony php bin/phpunit --testdox
.PHONY: tests

coverage: export APP_ENV=test
coverage: reset-test
	XDEBUG_MODE=coverage symfony php bin/phpunit --coverage-html var/coverage/test-coverage
.PHONY: coverage

reset: export APP_ENV=dev
reset:
	symfony console d:d:d --force
	symfony console d:d:c
	symfony console d:m:m --no-interaction
.PHONY: reset

reset-test: export APP_ENV=test
reset-test:
	symfony console d:d:d --force
	symfony console d:d:c
	symfony console d:m:m --no-interaction
	symfony console d:f:l --no-interaction
.PHONY: reset-test