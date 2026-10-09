<?php 
$hostname = "localhost";
$username = "root";
$password = "";
$database = "calendario_academico";

$conexion = new mysqli($hostname, $username, $password, $database);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");
?>