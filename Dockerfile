FROM node:22-alpine AS frontend

WORKDIR /app

COPY package.json ./
RUN npm install

COPY postcss.config.js tailwind.config.js vite.config.js ./
COPY resources ./resources
RUN npm run build

FROM php:8.3-apache

RUN apt-get update \
    && apt-get install -y --no-install-recommends libpq-dev unzip \
    && docker-php-ext-install pdo_pgsql \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts

COPY . .
COPY --from=frontend /app/public/build ./public/build
COPY docker/apache-vhost.conf /etc/apache2/sites-available/000-default.conf
COPY docker/start.sh /usr/local/bin/start-app

RUN composer dump-autoload --no-dev --optimize \
    && chmod +x /usr/local/bin/start-app \
    && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 80

CMD ["/usr/local/bin/start-app"]
