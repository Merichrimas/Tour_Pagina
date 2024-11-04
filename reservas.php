<?php
session_start();
require 'conexion.php'; // Conexión a la base de datos

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$rol = $_SESSION['rol'];

// Consultar las reservas del usuario (si es usuario normal) o todas las reservas (si es administrador)
if ($rol === 'administrador') {
    $stmt = $conn->prepare("SELECT * FROM reservas");
} else {
    $stmt = $conn->prepare("SELECT * FROM reservas WHERE usuario_id = ?");
    $stmt->bind_param("i", $user_id);
}
$stmt->execute();
$result = $stmt->get_result();

// Mostrar las reservas
while ($row = $result->fetch_assoc()) {
    echo "<div>";
    echo "Destino: " . htmlspecialchars($row['destino']) . "<br>";
    echo "Fecha: " . htmlspecialchars($row['fecha']) . "<br>";
    echo "Detalles: " . htmlspecialchars($row['otros_detalles']) . "<br>";
    
    // Opciones para el usuario normal
    if ($rol === 'usuario' && $row['usuario_id'] == $user_id) {
        echo "<a href='modificar_reserva.php?id=" . $row['id'] . "'>Modificar</a> ";
        echo "<a href='eliminar_reserva.php?id=" . $row['id'] . "'>Eliminar</a>";
    }
    echo "</div><hr>";
}
?>
