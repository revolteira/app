#!/bin/sh
set -e

echo "Deploy da aplicación..."

# Comprobamos se existe a carpeta db que conterá a base de datos.
# Se non existe, creámola.
if [ ! -d "db" ]; then
    echo "Creando carpeta db..."
    mkdir db
fi

# Entramos en modo mantemento
(docker compose exec app php artisan down) || true
    # Actualizamos o código
    git fetch origin main
    git reset --hard origin/main

    # Copiamos o contido de server_docker-compose.yml a docker-compose.yml
    # para non tener que indicar todo o tempo que ficheiro usar
    cp -f server_docker-compose.yml docker-compose.yml

    # Instalamos dependencias baseadas no arquivo lock
    docker compose exec app composer install --no-interaction --prefer-dist

    docker compose exec app php artisan storage:link
    docker compose exec app php artisan route:cache
    docker compose exec app php artisan view:cache
    docker compose exec app php artisan event:cache

    # Migramos a base de datos
    docker compose exec app php artisan migrate --force

    # Forzamos o reinicio de php-fpm
    # https://stackoverflow.com/questions/37806188/how-to-restart-php-fpm-inside-a-docker-container
    docker compose exec app bash -c "kill -USR2 1"

    # Reiniciamos o supervisor
    docker compose exec supervisor service supervisor stop
    docker compose exec supervisor service supervisor start

    docker compose exec app php artisan queue:restart

    chmod +x server_ssl_renew.sh

# Saímos do modo mantemento
docker compose exec app php artisan up

# Limpamos a caché para que colla os valores de .env
docker compose exec app php artisan config:cache
docker compose exec app php artisan config:clear
docker compose exec app php artisan cache:clear

echo "Deploy rematado!"