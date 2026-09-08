<?php
require_once 'conexion.php';

$conn = getConnection();

$buscar = $_GET['nombre'] ?? '';

if ($buscar != '') {

    $stmt = $conn->prepare(
        "SELECT * FROM estudiantes 
         WHERE activo=1 AND nombre LIKE ?
         ORDER BY apellido"
    );

    $busqueda = "%" . $buscar . "%";
    $stmt->bind_param("s", $busqueda);
    $stmt->execute();

    $res = $stmt->get_result();

} else {

    $res = $conn->query(
        "SELECT * FROM estudiantes 
         WHERE activo=1 
         ORDER BY apellido"
    );

}

$mensaje = $_GET['mensaje'] ?? '';
?>

<!DOCTYPE html>
<html lang="es" data-theme="aqua">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lista de estudiantes</title>
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
            <a href="formulario.php" class="btn btn-sm bg-base-100 text-primary hover:bg-base-200">Nuevo estudiante</a>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4">

        <?php if ($mensaje === 'actualizado'): ?>
            <div role="alert" class="alert alert-success alert-soft mb-4">
                <span>Estudiante actualizado correctamente.</span>
            </div>
        <?php elseif ($mensaje === 'eliminado'): ?>
            <div role="alert" class="alert alert-error alert-soft mb-4">
                <span>Estudiante eliminado correctamente.</span>
            </div>
        <?php endif; ?>

        <div class="card bg-base-100 shadow mb-6">
            <div class="card-body p-4">
                <h2 class="card-title text-lg">Buscar estudiante</h2>
                <form method="GET" action="primerpaso.php" class="flex flex-col sm:flex-row gap-2 mt-2">
                    <input
                        type="text"
                        name="nombre"
                        placeholder="Ingrese nombre"
                        value="<?= htmlspecialchars($buscar) ?>"
                        class="input flex-1"
                    >
                    <div class="flex gap-2">
                        <button type="submit" class="btn btn-primary">Buscar</button>
                        <a href="primerpaso.php" class="btn btn-ghost">Mostrar todos</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="card bg-base-100 shadow">
            <div class="overflow-x-auto">
                <table class="table table-zebra">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th class="text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php while ($f = $res->fetch_assoc()): ?>

                        <tr>
                            <td>
                                <?= htmlspecialchars($f['nombre'].' '.$f['apellido']) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars($f['email']) ?>
                            </td>

                            <td class="text-right whitespace-nowrap">
                                <a href="editar.php?id=<?= $f['id'] ?>" class="btn btn-xs btn-outline btn-primary">Editar</a>

                                <a href="eliminar.php?id=<?= $f['id'] ?>"
                                   class="btn btn-xs btn-outline btn-error"
                                   onclick="return confirm('¿Eliminar a <?= htmlspecialchars($f['nombre']) ?>?')">
                                   Eliminar
                                </a>
                            </td>
                        </tr>

                    <?php endwhile; ?>

                    </tbody>
                </table>
            </div>
            <div class="p-4 text-sm text-base-content/70">
                Total encontrados: <?= $res->num_rows ?>
            </div>
        </div>

    </div>

</body>
</html>