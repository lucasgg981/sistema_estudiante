# Sistema de Gestión de Estudiantes

Sistema web para la gestión de estudiantes desarrollado en PHP con Tailwind CSS y daisyUI.

## Funcionalidades

- **Listar estudiantes**: Muestra todos los estudiantes activos en una tabla con búsqueda por nombre.
- **Agregar estudiante**: Formulario para crear nuevos estudiantes con nombre, apellido y email.
- **Editar estudiante**: Modifica los datos de un estudiante existente.
- **Eliminar estudiante**: Desactiva un estudiante (soft delete) confirmando antes la acción.
- **Búsqueda**: Filtra estudiantes por nombre en tiempo real.
- **Cambiar tema**: Toggle para alternar entre tema claro y oscuro.

## Archivos

| Archivo | Descripción |
|---|---|
| `primerpaso.php` | Página principal con listado de estudiantes y buscador |
| `formulario.php` | Formulario para agregar nuevo estudiante |
| `insertar.php` | Procesa la inserción de un nuevo estudiante |
| `editar.php` | Formulario para editar un estudiante existente |
| `actualizar.php` | Procesa la actualización de datos |
| `eliminar.php` | Desactiva un estudiante (soft delete) |
| `conexion.php` | Configuración y conexión a la base de datos MySQL |

## Tecnologías

- **Backend**: PHP 8+ con MySQLi (prepared statements)
- **Frontend**: Tailwind CSS v4 + daisyUI v5
- **Base de datos**: MySQL (base `sistema_alumno`, tabla `estudiantes`)
- **Temas**: Aqua (por defecto) y Light

## Base de datos

Tabla `estudiantes`:
- `id` (INT, PK, AUTO_INCREMENT)
- `nombre` (VARCHAR)
- `apellido` (VARCHAR)
- `email` (VARCHAR)
- `activo` (TINYINT, por defecto 1)

## Configuración

1. Clonar el repositorio
2. Ejecutar `npm install` para instalar dependencias
3. Configurar la conexión en `conexion.php` (host, usuario, contraseña, base de datos)
4. Crear la base de datos y tabla en MySQL
5. Ejecutar `npm run build:css` para compilar estilos
6. Acceder a `primerpaso.php` desde el navegador

## Comandos npm

```bash
npm run build:css    # Compilar CSS una vez
npm run watch:css    # Observar cambios en CSS
```
