# Variables
DOCKER = docker
DOCKER_COMPOSE = docker compose
EXEC = $(DOCKER) exec -it hexo-docker-demo
PHP = $(EXEC) php
COMPOSER = $(EXEC) composer
NPM = $(EXEC) npm
SYMFONY_CONSOLE = $(PHP) bin/console

# Colors
GREEN = /bin/echo -e "\x1b[32m\#\# $1\x1b[0m"
RED = /bin/echo -e "\x1b[31m\#\# $1\x1b[0m"

## —— 🔥 App ——
init: ## Init the project
	$(MAKE) start
	$(MAKE) composer-install
	@$(call GREEN,"The application is available at: http://127.0.0.1:8000/.")

cache-clear: ## Clear cache
	$(SYMFONY_CONSOLE) cache:clear

## —— ✅ Test ——
.PHONY: tests
tests: ## Run all tests
	$(MAKE) database-init-test
	$(PHP) bin/phpunit

## —— 🐳 Docker ——
start: ## Start app
	$(MAKE) docker-start
docker-start:
	$(DOCKER_COMPOSE) up -d

stop: ## Stop app
	$(MAKE) docker-stop
docker-stop:
	$(DOCKER_COMPOSE) stop

## —— 🎻 Composer ——
composer-install: ## Install dependencies
	$(COMPOSER) install

composer-update: ## Update dependencies
	$(COMPOSER) update

## —— 📊 Database ——
database-init: ## Init database
	$(MAKE) database-drop
	$(MAKE) database-create
	$(MAKE) database-migrate
	$(MAKE) database-fixtures-load

database-drop: ## Create database
	$(SYMFONY_CONSOLE) d:d:d --force --if-exists

database-create: ## Create database
	$(SYMFONY_CONSOLE) d:d:c --if-not-exists

database-remove: ## Drop database
	$(SYMFONY_CONSOLE) d:d:d --force --if-exists

database-migration: ## Make migration
	$(SYMFONY_CONSOLE) make:migration

migration: ## Alias : database-migration
	$(MAKE) database-migration

database-migrate: ## Migrate migrations
	$(SYMFONY_CONSOLE) d:m:m --no-interaction

migrate: ## Alias : database-migrate
	$(MAKE) database-migrate

database-fixtures-load: ## Load fixtures
	$(SYMFONY_CONSOLE) d:f:l --no-interaction

fixtures: ## Alias : database-fixtures-load
	$(MAKE) database-fixtures-load

## —— 🛠️  Others ——
help: ## List of commands
	@grep -E '(^[a-zA-Z0-9_-]+:.*?##.*$$)|(^##)' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}{printf "\033[32m%-30s\033[0m %s\n", $$1, $$2}' | sed -e 's/\[32m##/[33m/'


