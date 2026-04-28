# NewSuperMotos

Aplicacion web de SuperMotos migrada a Laravel 12.

## Requisitos

- PHP 8.2+
- Composer 2+
- Node.js 20+ y npm
- MySQL 8+

## Desarrollo local

1. Instalar dependencias y preparar entorno:

	composer run setup

2. Arrancar servicios de desarrollo:

	composer run dev

## Pruebas

Ejecutar:

composer run test

## Despliegue a produccion

La guia completa esta en [DEPLOY_PRODUCTION.md](DEPLOY_PRODUCTION.md).

Resumen rapido:

1. Crear y completar .env a partir de .env.production.example.
2. Configurar servidor web apuntando a la carpeta public.
3. Ejecutar script de despliegue:
	- Linux: bash scripts/deploy-production.sh
	- Windows: powershell -ExecutionPolicy Bypass -File scripts/deploy-production.ps1
4. Configurar cola (queue:work) y scheduler (cron).
