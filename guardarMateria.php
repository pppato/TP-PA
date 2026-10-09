<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si alguien intenta entrar por URL sin estar logueado o sin enviar el formulario, lo rebotamos
if (!isset($_SESSION['usuario']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: formLogin.php');
    exit;
}

require_once __DIR__.'/conexion.php';

$nombre = trim($_POST['nombre']);

if (!empty($nombre)) {
    $sql = "INSERT INTO materias (nombre) VALUES (?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $nombre);
    
    if ($stmt->execute()) {
        $stmt->close();
    } else {
        die("Error al guardar: " . $conexion->error);
    }
}

header('Location: Inicio.php');
exit;
?>