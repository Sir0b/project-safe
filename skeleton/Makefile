.PHONY: check
check: cs md stan

.PHONY: cs
cs: vendor
	./vendor/bin/php-cs-fixer fix --allow-risky=yes --dry-run --using-cache=no -vvv src/

.PHONY: security
security: vendor
	./bin/console security:check

.PHONY: md
md: vendor
	./vendor/bin/phpmd src/ text cleancode, codesize, controversial, design, naming, unusedcode

.PHONY: stan
stan: vendor
	./vendor/bin/phpstan  analyse -l 2 src/

vendor:
	composer install