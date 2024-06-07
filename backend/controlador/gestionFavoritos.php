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

    // Depuración: imprimir el input recibido
    error_log('Datos recibidos: ' . print_r($input, true));

    if (isset($input['pais']) && isset($input['accion'])) {
        $nombrePais = $input['pais'];
        $accion = $input['accion'];

        // Depuración: imprimir la acción y el país
        error_log('Acción: ' . $accion . ', País: ' . $nombrePais);

        // Verificar si el nombrePais existe en la tabla paises
        $verificarPais = $conexion->getConexion()->prepare("SELECT nombre FROM paises WHERE nombre = ?");
        $verificarPais->bind_param("s", $nombrePais);
        $verificarPais->execute();
        $verificarPais->store_result();

        if ($verificarPais->num_rows === 0) {
            echo json_encode(['error' => 'El país no existe en la base de datos']);
            $verificarPais->close();
            exit;
        }

        $verificarPais->close();

        if ($accion === 'añadir') {
            $query = $conexion->getConexion()->prepare("INSERT INTO favoritos (nombreUsuario, nombrePais) VALUES (?, ?)");
            $query->bind_param("ss", $nombreUsuario, $nombrePais);

            if ($query->execute()) {
                echo json_encode(['success' => 'Favorito añadido correctamente', 'pais' => $nombrePais, 'nombreUsuario' => $nombreUsuario]);
            } else {
                echo json_encode(['error' => 'Error al añadir favorito', 'detalle' => $query->error]);
            }
            
            $query->close();
        } elseif ($accion === 'eliminar') {
            $query = $conexion->getConexion()->prepare("DELETE FROM favoritos WHERE nombreUsuario = ? AND nombrePais = ?");
            $query->bind_param("ss", $nombreUsuario, $nombrePais);

            if ($query->execute()) {
                echo json_encode(['success' => 'Favorito eliminado correctamente', 'pais' => $nombrePais, 'nombreUsuario' => $nombreUsuario]);
            } else {
                echo json_encode(['error' => 'Error al eliminar favorito', 'detalle' => $query->error]);
            }
            
            $query->close();
        } else {
            echo json_encode(['error' => 'Acción no válida']);
        }

        $conexion->cerrarConexion();

    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Datos incompletos']);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Método no permitido']);
}

?>
