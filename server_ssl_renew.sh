#!/bin/bash

# Para facer que este script se execute automáticamente, hai que engadilo a crontab
# sudo crontab -e
# 0 12 * * * /var/www/app.revolteira.gal/server_ssl_renew.sh >> /var/log/cron.log 2>&1

COMPOSE="/usr/bin/docker compose --ansi never"
DOCKER="/usr/bin/docker"

cd /var/www/app.revolteira.gal
$COMPOSE run certbot renew && $COMPOSE kill -s SIGHUP nginx
$DOCKER system prune -af
