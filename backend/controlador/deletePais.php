<?php
// Iniciar sesión para mantener el contexto del usuario
session_start();
// Establecer cabecera JSON para la respuesta
header('Content-Type: application/json; charset=utf-8');

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

// Verificar que el método de solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Leer el cuerpo de la solicitud y convertirlo de JSON a array PHP
    $input = json_decode(file_get_contents('php://input'), true);

    $nombrePais = $input['nombre'];

    $query = $conexion->getConexion()->prepare("DELETE FROM paises WHERE nombre = ?");
    $query->bind_param("s", $nombrePais);
    if ($query->execute()) {
        echo json_encode(['success' => "$nombrePais ha sido borrado correctamente"]);
    } else {
        echo json_encode(['error' => "Error al borrar $nombrePais"]);
    }
    
    $query->close();
    $conexion->cerrarConexion();
}
    
?>