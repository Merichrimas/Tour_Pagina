<?php
require 'database.php';

// Crear destino
function createDestino($nombre, $descripcion, $ubicacion, $precio_estimado) {
    global $mysqli;
    $stmt = $mysqli->prepare("INSERT INTO destinos (nombre, descripcion, ubicacion, precio_estimado) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $nombre, $descripcion, $ubicacion, $precio_estimado);
    $stmt->execute();
    $stmt->close();
}

// Leer todos los destinos
function getDestinos() {
    global $mysqli;
    $result = $mysqli->query("SELECT id, nombre, descripcion, ubicacion, precio_estimado FROM destinos");
    return $result->fetch_all(MYSQLI_ASSOC);
}

// Actualizar un destino
function updateDestino($id, $nombre, $descripcion, $ubicacion, $precio_estimado) {
    global $mysqli;
    $stmt = $mysqli->prepare("UPDATE destinos SET nombre = ?, descripcion = ?, ubicacion = ?, precio_estimado = ? WHERE id = ?");
    $stmt->bind_param("sssdi", $nombre, $descripcion, $ubicacion, $precio_estimado, $id);
    $stmt->execute();
    $stmt->close();
}

// Eliminar un destino
function deleteDestino($id) {
    global $mysqli;
    $stmt = $mysqli->prepare("DELETE FROM destinos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}
?>