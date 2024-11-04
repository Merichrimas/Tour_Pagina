<?php
session_start();
require 'conexion.php';

if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'usuario') {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$reserva_id = $_GET['id'];

// Verifica que la reserva pertenece al usuario actual
$stmt = $conn->prepare("DELETE FROM reservas WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ii", $reserva_id, $user_id);

if ($stmt->execute()) {
    echo "Reserva eliminada correctamente.";
    header("Location: reservas.php");
    exit;
} else {
    echo "Error al eliminar la reserva.";
}
?>
