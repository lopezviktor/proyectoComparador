<?php

header('Content-Type: application/json; charset=utf-8');

session_start();

require_once "../modelo/Conexion.php";

$conexion = new Conexion();
$conexion->conectarBD();

// Establecer la codificación de caracteres de la conexión a UTF-8
mysqli_set_charset($conexion->getConexion(), "utf8");

// Comprobar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    // Enviar error si el usuario no está autenticado
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit;
}

// Obtener el nombre del usuario de la sesión
$nombreUsuario = $_SESSION['usuario'];

$query = $conexion->getConexion()->prepare("SELECT nombrePais FROM favoritos WHERE nombreUsuario = ?");
$query->bind_param("s", $nombreUsuario);
$query->execute();
$result = $query->get_result();

$favoritos = [];
while ($row = $result->fetch_assoc()) {
    $favoritos[] = $row['nombrePais'];
}

echo json_encode($favoritos);

$query->close();
$conexion->cerrarConexion();

?>
