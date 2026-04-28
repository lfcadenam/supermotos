$ErrorActionPreference = "Stop"

$RootDir = Resolve-Path (Join-Path $PSScriptRoot "..")
Set-Location $RootDir

if (-not (Test-Path ".env")) {
    throw "Falta el archivo .env. Crea y configura .env antes del despliegue."
}

if (-not (Get-Command php -ErrorAction SilentlyContinue)) {
    throw "No se encontro PHP en el PATH."
}

if (-not (Get-Command composer -ErrorAction SilentlyContinue)) {
    throw "No se encontro Composer en el PATH."
}

$maintenance = $false

try {
    php artisan down --render="errors::503" --retry=60
    $maintenance = $true

    composer install --no-dev --prefer-dist --optimize-autoloader --no-interaction

    if (Get-Command npm -ErrorAction SilentlyContinue) {
        npm ci
        npm run build
    }
    else {
        Write-Host "npm no disponible. Se omite compilacion de assets."
    }

    php artisan migrate --force
    php artisan storage:link --force
    php artisan optimize:clear
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    php artisan event:cache
    php artisan queue:restart

    php artisan up
    $maintenance = $false

    Write-Host "Despliegue finalizado correctamente."
}
finally {
    if ($maintenance) {
        php artisan up | Out-Null
    }
}
