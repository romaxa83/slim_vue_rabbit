docker-up:
	docker-compose up --build -d

docker-down:
	docker-compose down

frontend-build:
	docker-compose exec frontend-nodejs npm run build

api-permissions:
	sudo chmod 777 api/var
	sudo chmod 777 api/var/cache
	sudo chmod 777 api/var/log
	sudo chmod 777 storage/public/video
