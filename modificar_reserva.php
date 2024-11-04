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
$stmt = $conn->prepare("SELECT * FROM reservas WHERE id = ? AND usuario_id = ?");
$stmt->bind_param("ii", $reserva_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $reserva = $result->fetch_assoc();
} else {
    echo "No tienes permiso para modificar esta reserva.";
    exit;
}
?>

<form action="modificar_reserva.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $reserva['id']; ?>">
    <label>Destino:</label>
    <input type="text" name="destino" value="<?php echo htmlspecialchars($reserva['destino']); ?>" required><br>
    <label>Fecha:</label>
    <input type="date" name="fecha" value="<?php echo htmlspecialchars($reserva['fecha']); ?>" required><br>
    <label>Detalles:</label>
    <textarea name="otros_detalles"><?php echo htmlspecialchars($reserva['otros_detalles']); ?></textarea><br>
    <button type="submit">Guardar Cambios</button>
</form>
