-include .env

run:
	docker-compose down
	docker-compose build app
	docker-compose up -d
	docker exec -it e-sign-app bash -c "composer install && php artisan migrate"

first-run:
	cp .env.example .env
	make run
	docker exec -it e-sign-app bash -c "php artisan passport:install --no-interaction"
