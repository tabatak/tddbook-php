PHP := php
COMPOSER := composer

all: install test
.PHONY: all

install:
	$(COMPOSER) install
.PHONY: install

test: test_part1 test_part2
	$(PHP) ./vendor/bin/phpunit
.PHONY: test

test_part1:
	$(PHP) ./vendor/bin/phpunit
.PHONY: test_part1

test_part2:
	$(PHP) ./part2/xunit.php
.PHONY: test_part2