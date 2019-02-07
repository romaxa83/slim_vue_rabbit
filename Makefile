docker-up:
	docker-compose up --build -d

docker-down:
	docker-compose down

api-permissions:
	sudo chmod 777 api/var
	sudo chmod 777 api/var/cache
	sudo chmod 777 api/var/log
	sudo chmod 777 storage/public/video

frontend-install:
	docker-compose exec frontend-nodejs npm install

frontend-build:
	docker-compose exec frontend-nodejs npm run build

websocket-install:
	docker-compose exec websocket-nodejs npm install

websocket-start:
	docker-compose exec websocket-nodejs npm run start