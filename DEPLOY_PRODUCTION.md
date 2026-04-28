# Despliegue a Produccion - NewSuperMotos

Esta guia deja el proyecto Laravel listo para desplegar en un servidor de produccion.

## 1. Requisitos del servidor

- PHP 8.2 o superior con extensiones comunes de Laravel (openssl, pdo, mbstring, tokenizer, xml, ctype, json, bcmath, fileinfo).
- Composer 2.x.
- Node.js 20+ y npm (solo para compilar assets en servidor).
- MySQL 8+.
- Servidor web Apache o Nginx apuntando a la carpeta public.

## 2. Variables de entorno

1. Copia la plantilla de produccion:
   - cp .env.production.example .env
2. Completa valores sensibles:
   - APP_KEY
   - APP_URL
   - credenciales de DB
   - credenciales de SMTP
3. Genera la clave si aun no existe:
   - php artisan key:generate --force

## 3. Permisos

Asegura permisos de escritura para:

- storage/
- bootstrap/cache/

En Linux:

- chown -R www-data:www-data storage bootstrap/cache
- chmod -R 775 storage bootstrap/cache

## 4. Despliegue automatizado

### Linux

- bash scripts/deploy-production.sh

### Windows

- powershell -ExecutionPolicy Bypass -File scripts/deploy-production.ps1

El script realiza:

- modo mantenimiento
- composer install sin dependencias de desarrollo
- build de assets (si npm esta disponible)
- migraciones forzadas
- enlace de storage
- caches de Laravel para produccion
- reinicio de workers de cola
- salida de modo mantenimiento

## 5. Cola de trabajos (obligatorio)

Configurar un proceso persistente para:

- php artisan queue:work --sleep=3 --tries=3 --max-time=3600

Ejemplo con Supervisor (Linux):

- crear configuracion supervisor para arrancar queue:work
- habilitar autorestart
- correr como usuario del servidor web

## 6. Scheduler (obligatorio)

Agregar cron para ejecutar scheduler cada minuto:

- * * * * * cd /ruta/a/NewSuperMotos && php artisan schedule:run >> /dev/null 2>&1

## 7. Verificaciones post despliegue

- php artisan about --only=environment
- php artisan route:list
- revisa endpoint de salud: /up
- prueba login administrativo y flujo de publicacion
- valida envio real de correo

## 8. Rollback rapido

Si el deploy falla:

1. Mantener app en modo mantenimiento.
2. Restaurar release anterior (codigo y assets).
3. Si aplica, rollback de migracion cuidadosamente:
   - php artisan migrate:rollback --step=1
4. Volver a levantar:
   - php artisan up
