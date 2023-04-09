up:
	docker-compose up -d

stop:
	docker-compose stop

destroy:
	docker-compose down

build:
	docker-compose up --build -d

composer:
	docker-compose exec php_mvc composer install

test:
	docker-compose exec php_mvc ./vendor/bin/phpunit tests

bash_php: up
	docker-compose exec php_mvc bash

bash_nginx: up
	docker-compose exec nginx_mvc bash

restart: stop up
