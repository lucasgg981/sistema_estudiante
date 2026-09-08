<!DOCTYPE html>
<html lang="es" data-theme="aqua">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agregar estudiante</title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body class="bg-base-200 min-h-screen">

    <div class="navbar bg-primary text-primary-content mb-6">
        <div class="navbar-start px-4">
            <a href="primerpaso.php" class="text-lg font-bold">Gestión de Estudiantes</a>
        </div>
        <div class="navbar-end gap-2 px-4">
            <input
                type="checkbox"
                value="light"
                aria-label="Cambiar tema claro u oscuro"
                class="toggle toggle-sm theme-controller"
            >
            <a href="primerpaso.php" class="btn btn-sm bg-base-100 text-primary hover:bg-base-200">Volver al listado</a>
        </div>
    </div>

    <div class="max-w-md mx-auto px-4">
        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <h2 class="card-title">Nuevo estudiante</h2>

                <form action="insertar.php" method="POST" class="flex flex-col gap-4">

                    <label class="floating-label">
                        <input type="text" name="nombre" placeholder="Nombre" required class="input w-full">
                        <span>Nombre</span>
                    </label>

                    <label class="floating-label">
                        <input type="text" name="apellido" placeholder="Apellido" required class="input w-full">
                        <span>Apellido</span>
                    </label>

                    <label class="floating-label">
                        <input type="email" name="email" placeholder="Email" required class="input w-full">
                        <span>Email</span>
                    </label>

                    <div class="flex flex-col gap-2">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <a href="primerpaso.php" class="btn btn-ghost">Cancelar</a>
                    </div>

                </form>

            </div>
        </div>
    </div>

</body>
</html>