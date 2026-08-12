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
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de estudiantes</title>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
>
</head>
<body>

<h2>Buscar estudiante</h2>

<form method="GET" action="primerpaso.php">

    <input 
        type="text" 
        name="nombre" 
        placeholder="Ingrese nombre"
        value="<?= htmlspecialchars($buscar) ?>"
    >

    <button type="submit">Buscar</button>

    <a href="primerpaso.php">Mostrar todos</a>

</form>

<br>

<table border="1">

    <thead>
        <tr>
            <th>Nombre</th>
            <th>Email</th>
            <th>Acciones</th>
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

            <td>
                <a href="editar.php?id=<?= $f['id'] ?>">Editar</a>

                &nbsp;|&nbsp;

                <a href="eliminar.php?id=<?= $f['id'] ?>"
                   onclick="return confirm('¿Eliminar a <?= htmlspecialchars($f['nombre']) ?>?')">
                   Eliminar
                </a>
            </td>
        </tr>

    <?php endwhile; ?>

    </tbody>

</table>

<p>Total encontrados: <?= $res->num_rows ?></p>

</body>
</html>