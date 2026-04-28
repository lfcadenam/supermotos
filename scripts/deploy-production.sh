#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$ROOT_DIR"

if [[ ! -f ".env" ]]; then
  echo "Falta el archivo .env. Crea y configura .env antes del despliegue."
  exit 1
fi

if ! command -v php >/dev/null 2>&1; then
  echo "No se encontro PHP en el PATH."
  exit 1
fi

if ! command -v composer >/dev/null 2>&1; then
  echo "No se encontro Composer en el PATH."
  exit 1
fi

in_maintenance=false
cleanup() {
  if [[ "$in_maintenance" == true ]]; then
    php artisan up || true
  fi
}
trap cleanup EXIT

php artisan down --render="errors::503" --retry=60 || true
in_maintenance=true

composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction

if command -v npm >/dev/null 2>&1; then
  npm ci
  npm run build
else
  echo "npm no disponible. Se omite compilacion de assets."
fi

php artisan migrate --force
php artisan storage:link --force
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan queue:restart || true

php artisan up
in_maintenance=false

echo "Despliegue finalizado correctamente."
