<?php
require_once 'conexion.php';

$conn = getConnection();

$id = (int) ($_GET['id'] ?? 0);

$stmt = $conn->prepare("SELECT * FROM estudiantes WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$res = $stmt->get_result();
$estudiante = $res->fetch_assoc();

$stmt->close();
$conn->close();

if (!$estudiante) {
    die("Estudiante no encontrado.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar estudiante</title>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
>
</head>
<body>

<h2>Editar estudiante</h2>

<form action="actualizar.php" method="POST">

    <input type="hidden" name="id" value="<?= $estudiante['id'] ?>">

    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= htmlspecialchars($estudiante['nombre']) ?>" required>
    <br><br>

    <label>Apellido:</label>
    <input type="text" name="apellido" value="<?= htmlspecialchars($estudiante['apellido']) ?>" required>
    <br><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($estudiante['email']) ?>" required>
    <br><br>

    <button type="submit">Guardar cambios</button>

</form>

</body>
</html>
