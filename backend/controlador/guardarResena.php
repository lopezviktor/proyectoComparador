<?php

// Iniciar sesión para mantener el contexto del usuario
session_start();

// Incluir el script de conexión a la base de datos
require_once "../modelo/Conexion.php";

// Crear una instancia de la clase Conexion y conectar a la BD
$conexion = new Conexion();
$conexion->conectarBD();

// Ajustar la codificación de caracteres para evitar problemas con UTF-8
mysqli_set_charset($conexion->getConexion(), "utf8");

// Comprobar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    // Enviar error si el usuario no está autenticado
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit;
}

// Obtener el nombre del usuario de la sesión
$nombreUsuario = $_SESSION['usuario'];

// Permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");
// Permitir métodos POST
header("Access-Control-Allow-Methods: POST");
// Permitir contenido JSON
header("Content-Type: application/json");

$resena = $_POST['resena'];

$query = $conexion->getConexion()->prepare("INSERT INTO resenas (nombreUsuario, resena) VALUES (?, ?)");
    $query->bind_param("ss", $nombreUsuario, $resena);

    if ($query->execute()) {
        echo json_encode(['success' => 'Reseña añadida correctamente']);
    } else {
        echo json_encode(['error' => 'Error al añadir reseña', 'detalle' => $query->error]);
    }

    $query->close();

    $conexion->cerrarConexion();
?>