#!/bin/bash
echo "Creating Databases"

docker-compose exec dwapi php artisan config:clear
docker-compose exec dwapi php artisan cache:clear
docker-compose exec dwapi php artisan migrate;
docker-compose exec dwapi php artisan migrate --env=testing;