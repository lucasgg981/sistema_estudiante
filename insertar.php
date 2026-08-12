<?php
require_once 'conexion.php';

if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre   = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $email    = trim($_POST['email'] ?? '');

    if (empty($nombre) || empty($apellido) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = 'Datos inválidos.';
        echo $error;

    } else {

        $conn = getConnection();

        $stmt = $conn->prepare(
            "INSERT INTO estudiantes (nombre, apellido, email) VALUES (?, ?, ?)"
        );

        if (!$stmt) {
            die("Error en la consulta: " . $conn->error);
        }

        $stmt->bind_param("sss", $nombre, $apellido, $email);

        if ($stmt->execute()) {

            header('Location: primerpaso.php');
            exit;

        } else {

            echo "Error al guardar los datos: " . $stmt->error;

        }

        $stmt->close();
        $conn->close();
    }

} else {

    echo "No se recibió ningún formulario.";

}
?>