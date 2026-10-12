#!/bin/sh
set -eu

export APP_URL="${APP_URL:-${RENDER_EXTERNAL_URL:-http://localhost}}"

php artisan config:cache
php artisan migrate --force
php artisan db:seed --force

chown -R www-data:www-data storage bootstrap/cache

exec apache2-foreground
