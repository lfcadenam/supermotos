# Plan de Migración: SuperMotos a Laravel

Este documento detalla el plan de trabajo para migrar la plataforma actual ubicada en `D:\xampp\htdocs\SuperMotos` al framework Laravel en la nueva ubicación `D:\xampp\htdocs\NewSuperMotos`.

## 1. Fase de Preparación e Infraestructura
- [x] **Inicialización del Proyecto**: Crear un nuevo proyecto Laravel 11/12 en `D:\xampp\htdocs\NewSuperMotos`.
- [x] **Configuración de Envorno**: Configurar el archivo `.env` con las credenciales de la base de datos `lsuperml3_supermotosrt`.
- [ ] **Instalación de Dependencias**: Configurar Vite para el manejo de assets y cualquier paquete necesario.

## 2. Migración de la Base de Datos
- [x] **Ingeniería Inversa**: Analizar las tablas actuales en MySQL.
- [x] **Creación de Migraciones**: Generar archivos de migración en Laravel que repliquen la estructura actual.
- [x] **Modelos Eloquent**: Crear los modelos correspondientes en `app/Models` definiendo tablas y claves.

## 3. Migración de la Lógica de Negocio
- [x] **Refactorización de Clases**: Migrar la lógica de `clases/motos_colombia.php` y otros a Servicios o Repositorios en Laravel.
- [x] **Funciones Globales**: Convertir `funciones/funciones.php` en Helpers de Laravel o métodos dentro de controladores/servicios.
- [x] **Controladores**: Crear controladores para manejar las peticiones que actualmente procesan archivos como `motos_colombia_ajax.php` y `motos_dispo_ajax.php`.

## 4. Rutas y Controladores
- [x] **Definición de Rutas**: Mapear los archivos `.php` de la raíz a rutas amigables en `routes/web.php`.
    - `index.php` -> `/`
    - `about-company.php` -> `/nosotros`
    - `publica_tu_moto.php` -> `/publicar`
    - etc.

## 5. Capa de Presentación (Frontend)
- [x] **Layout Principal**: Crear un layout base en Blade (`resources/views/layouts/app.blade.php`) usando el contenido de `menu.php` y `footer.php`.
- [x] **Conversión a Blade**: Transformar los archivos HTML/PHP actuales en vistas `.blade.php`.
- [x] **Assets**: Mover CSS, JS e imágenes a la carpeta `public` o procesarlos mediante Vite.

## 6. Funcionalidades Especiales
- [x] **Carga de Archivos**: Migrar la lógica de `recibeFile.php` al sistema de almacenamiento de Laravel (`Storage`).
- [x] **Pagos**: Adaptar `respuesta_pago.php` para manejar webhooks o callbacks de la pasarela de pagos.
- [x] **Panel de Administración**: Migrar el contenido de la carpeta `admin/` a un espacio de nombres dedicado.
- [x] **Seguridad**: Implementar autenticación para proteger el panel administrativo.

## 7. Pruebas y Despliegue
- [ ] **Pruebas Unitarias/Integración**: Verificar que los filtros de búsqueda y procesos de publicación funcionen correctamente.
- [ ] **Optimización**: Configurar caché de rutas y vistas.
- [ ] **Puesta en Marcha**: Configurar el servidor Apache de XAMPP para apuntar a la carpeta `public` del nuevo proyecto.
