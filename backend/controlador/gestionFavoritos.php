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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['pais'])) {
        $nombrePais = $input['pais'];

        // Aquí puedes añadir la lógica para gestionar el país favorito.
        // Ejemplo: guardar en una base de datos, etc.

        // Responder con un mensaje de éxito

        $query = $conexion->getConexion()->prepare("INSERT INTO favoritos (nombreUsuario, nombrePais) VALUES (?, ?)");
        $query->bind_param("ss", $nombreUsuario, $nombrePais);
        
        if ($query->execute()) {
            echo json_encode(['success' => 'Favorito actualizado correctamente', 'pais' => $nombrePais, 'nombreUsuario' => $nombreUsuario]);
        } else {
            echo json_encode(['error' => 'Error al actualizar favorito']);
        }
        
        $query->close();
        $conexion->cerrarConexion();
        

    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Datos incompletos']);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Método no permitido']);
}




/*
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

$_SESSION['nombreUsuario'] = 'nombre_del_usuario';  // Asignar durante el login

$nombrePais = $_POST['nombrePais'] ?? '';
$accion = $_POST['accion'] ?? '';

if (!isset($_SESSION['nombreUsuario'])) {
    echo json_encode(['error' => 'Usuario no autenticado o sesión no iniciada']);
    exit;
}

if (!$nombrePais || !$accion) {
    echo json_encode(['error' => 'Datos insuficientes para la acción']);
    exit;
}


if ($accion == 'agregar') {
    $query = $conexion->getConexion()->prepare("INSERT INTO favoritos (nombreUsuario, nombrePais) VALUES (?, ?)");
    $query->bind_param("ss", $_SESSION['nombreUsuario'], $nombrePais);
} else {
    $query = $conexion->getConexion()->prepare("DELETE FROM favoritos WHERE nombreUsuario = ? AND nombrePais = ?");
    $query->bind_param("ss", $_SESSION['nombreUsuario'], $nombrePais);
}

if ($query->execute()) {
    echo json_encode(['success' => 'Favorito actualizado correctamente']);
} else {
    echo json_encode(['error' => 'Error al actualizar favorito']);
}

$query->close();
$conexion->cerrarConexion();

*/

?>