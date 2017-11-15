PHP := php
COMPOSER := composer

all: install test
.PHONY: all

install:
	$(COMPOSER) install
.PHONY: install

test:
	$(PHP) ./vendor/bin/phpunit
.PHONY: test