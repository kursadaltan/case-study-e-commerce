install:
	cp .env.example .env
	$(MAKE) build
	sleep 30

bash:
	docker exec -it case_study_ecommerce_backend sh

build:
	$(MAKE) create_network
	$(MAKE) down
	docker-compose up -d --build

up:
	docker-compose up -d

down:
	docker-compose down --remove-orphans

restart:
	docker-compose restart

sh:
	docker exec -it case_study_ecommerce_backend $(filter-out $@,$(MAKECMDGOALS))

artisan:
	docker exec -it case_study_ecommerce_backend php artisan $(filter-out $@,$(MAKECMDGOALS))

create_network:
	docker network create case_study_ecommerce || true