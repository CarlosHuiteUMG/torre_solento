# Torre Solento

Plataforma web responsiva para la gestión de condominios con Laravel 11, Blade, Tailwind y MySQL. Incluye autenticación, roles (administrador y residente) y reservas de áreas comunes con calendario interactivo FullCalendar.

## Requisitos
- PHP 8.3+
- MySQL 8
- Composer
- Node/NPM (para compilar assets si se desea usar Tailwind localmente)

## Configuración rápida
1. Copiar `.env.example` a `.env` y ajustar credenciales de base de datos.
2. Ejecutar `composer install` y `php artisan key:generate`.
3. Ejecutar migraciones y seeders: `php artisan migrate --seed`.
4. Levantar el servidor: `php artisan serve`.

Los seeders crean roles iniciales y un usuario administrador `admin@torresolento.test` con contraseña `password`, además de las áreas comunes predeterminadas.

## Funcionalidades principales
- Registro e inicio de sesión de residentes con captura de datos (nombre, DPI, apartamento, piso, tipo de residente y teléfono).
- Panel de usuario con perfil editable y calendario de reservas.
- Reservas con validación de conflicto de horarios, capacidad máxima (gimnasio) y flujo de aprobación por administradores.
- Portal administrativo para gestionar usuarios, roles y áreas comunes, y revisar/aprobar reservas.
- Vistas responsivas en Tailwind y calendario interactivo con FullCalendar.
