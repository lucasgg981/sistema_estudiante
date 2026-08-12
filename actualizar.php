<?php
require_once 'conexion.php';

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $id       = (int) ($_POST['id'] ?? 0);
    $nombre   = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $email    = trim($_POST['email'] ?? '');

    if (empty($nombre) || empty($apellido) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = 'Datos inválidos.';
        echo $error;

    } else {

        $conn = getConnection();

        $stmt = $conn->prepare(
            "UPDATE estudiantes SET nombre = ?, apellido = ?, email = ? WHERE id = ?"
        );

        if (!$stmt) {
            die("Error en la consulta: " . $conn->error);
        }

        $stmt->bind_param("sssi", $nombre, $apellido, $email, $id);

        if ($stmt->execute()) {

            header('Location: primerpaso.php?mensaje=actualizado');
            exit;

        } else {

            echo "Error al actualizar los datos: " . $stmt->error;

        }

        $stmt->close();
        $conn->close();
    }

} else {

    echo "No se recibió ningún formulario.";

}
?>
