<?php
session_start();
require 'conexion.php'; // Conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta al usuario
    $stmt = $conn->prepare("SELECT id, password, rol FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $rol);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Almacena el rol y el ID de usuario en la sesión
            $_SESSION['user_id'] = $id;
            $_SESSION['rol'] = $rol;
            header("Location: destinos.php"); // Redirige a la página de destinos
            exit;
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
}
?>
