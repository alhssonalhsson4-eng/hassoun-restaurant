FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    git unzip zip curl \
    libpq-dev \
    libzip-dev \
    && docker-php-ext-install \
    pdo_pgsql \
    pdo_mysql \
    zip

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --optimize-autoloader \
    --no-interaction \
    --ignore-platform-reqs \
    --no-scripts

COPY . .

RUN rm -f .env

RUN php artisan config:clear || true
RUN php artisan cache:clear || true
RUN php artisan route:clear || true
RUN php artisan view:clear || true
RUN php artisan migrate --force || true
EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000