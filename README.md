# Sistema de Gestión Veterinaria

Sistema web desarrollado en Laravel para la administración de una clínica veterinaria, con gestión de usuarios, roles, mascotas y citas.

## Características

- **Autenticación**: Sistema de login/registro con Laravel Breeze
- **Gestión de Roles**: 3 roles (Admin, Veterinario, Cliente)
- **Gestión de Usuarios**: CRUD completo con asignación de roles
- **Gestión de Mascotas**: Registro de mascotas con información médica
- **Gestión de Citas**: Agendamiento y seguimiento de citas veterinarias

## Tecnologías Utilizadas

- Laravel 12
- PHP 8.4
- MySQL
- Tailwind CSS
- Blade Templates

## Instalación

### Requisitos Previos
- PHP >= 8.2
- Composer
- MySQL
- Node.js y NPM

### Pasos de Instalación

1. Clonar el repositorio:
```bash
git clone <url-del-repositorio>
cd vet-system
```

2. Instalar dependencias de PHP:
```bash
composer install
```

3. Instalar dependencias de Node:
```bash
npm install
```

4. Copiar el archivo de configuración:
```bash
cp .env.example .env
```

5. Generar la clave de aplicación:
```bash
php artisan key:generate
```

6. Configurar la base de datos en el archivo `.env`:
```env
DB_DATABASE=vet_system
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_contraseña
```

7. Crear la base de datos y ejecutar migraciones con seeders:
```bash
php artisan migrate:fresh --seed
```

8. Compilar assets:
```bash
npm run dev
```

9. Iniciar el servidor:
```bash
php artisan serve
```

## Usuarios de Prueba

### Administrador
- **Email**: admin@vet.com
- **Password**: password123

### Veterinarios
- **Email**: carlos@vet.com / **Password**: password123
- **Email**: maria@vet.com / **Password**: password123

### Clientes
- **Email**: juan@cliente.com / **Password**: password123
- **Email**: franciscojair@cliente.com / **Password**: password123
- **Email**: luis@cliente.com / **Password**: password123

## Estructura de Base de Datos

### Tablas Principales
- **users**: Usuarios del sistema
- **roles**: Roles disponibles (admin, veterinario, cliente)
- **role_user**: Tabla pivote para la relación usuarios-roles
- **pets**: Mascotas registradas
- **appointments**: Citas veterinarias

## Funcionalidades por Rol

### Admin
- Gestión completa de usuarios
- Gestión de mascotas
- Gestión de citas
- Acceso a todos los módulos

### Veterinario
- Gestión de mascotas
- Gestión de citas
- Registro de diagnósticos y tratamientos

### Cliente
- Ver dashboard
- Acceso limitado (futuras expansiones)

## Autor

Desarrollado como proyecto final de Laravel
