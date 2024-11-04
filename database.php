<?php
$host = "localhost"; // o el nombre de host de tu servidor de base de datos
$user = "tu_usuario"; // tu usuario de MySQL
$password = "tu_contraseña"; // tu contraseña de MySQL
$dbname = "yucaventuratour"; // el nombre de tu base de datos

// Crear conexión
$mysqli = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}
?>