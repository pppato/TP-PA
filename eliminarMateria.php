<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || !isset($_GET['id'])) {
    header('Location: Inicio.php');
    exit;
}

require_once __DIR__.'/conexion.php';

$id_materia = (int)$_GET['id'];

if ($id_materia > 0) {
    $sql = "DELETE FROM materias WHERE id_materia = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_materia);
    $stmt->execute();
    $stmt->close();
}

header('Location: Inicio.php');
exit;
?>