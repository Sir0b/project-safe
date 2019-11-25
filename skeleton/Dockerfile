FROM php:apache

RUN apt update \
 && apt install -y libpq-dev \
 && docker-php-ext-install pdo_pgsql

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /app