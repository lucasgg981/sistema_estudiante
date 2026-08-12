<?php
require_once 'conexion.php';

if (isset($_GET['id'])) {

    $id = (int) $_GET['id'];

    $conn = getConnection();

    $stmt = $conn->prepare("UPDATE estudiantes SET activo = 0 WHERE id = ?");

    if (!$stmt) {
        die("Error en la consulta: " . $conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    header('Location: primerpaso.php?mensaje=eliminado');
    exit;

} else {

    header('Location: primerpaso.php');
    exit;

}
?>
