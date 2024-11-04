<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirige al login si no está autenticado
    exit;
}

$rol = $_SESSION['rol'];

if ($rol === 'administrador') {
    echo "<button>Eliminar</button>";
    echo "<button>Actualizar</button>";
} elseif ($rol === 'usuario') {
    echo "<button>Agregar Destino</button>";
    echo "<button>Eliminar</button>";
} else {
    echo "No tienes permisos para acceder a esta página.";
}
?>
