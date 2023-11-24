FROM php:8.1-fpm

RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update && apt-get install -y \
    supervisor

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN mkdir -p "/etc/supervisor/logs"

COPY docker/supervisor/supervisor.conf /etc/supervisor/supervisor.conf

CMD ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisor/supervisor.conf"]