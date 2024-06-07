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

    // Extraer variables del JSON recibido, con valores por defecto en caso de no existir
    $nombre = $input['nombre'] ?? '';
    $nuevoNombre = $input['nuevoNombre'] ?? $nombre;
    $poblacion = $input['poblacion'] ?? 0;
    $superficie = $input['superficie'] ?? 0;
    $PIB = $input['PIB'] ?? 0.0;
    $esperanzaVida = $input['esperanzaVida'] ?? 0.0;
    $tasaNatalidad = $input['tasaNatalidad'] ?? 0.0;
    $tasaMortalidad = $input['tasaMortalidad'] ?? 0.0;

    // Preparar la consulta SQL para actualizar los datos del país
    $query = $conexion->getConexion()->prepare("UPDATE paises SET nombre = ?, poblacion = ?, superficie = ?, PIB = ?, esperanzaVida = ?, tasaNatalidad = ?, tasaMortalidad = ? WHERE nombre = ?");
    // Vincular los parámetros a la consulta para prevenir inyección SQL
    $query->bind_param("siisddds", $nuevoNombre, $poblacion, $superficie, $PIB, $esperanzaVida, $tasaNatalidad, $tasaMortalidad, $nombre);
    // Ejecutar la consulta
    $query->execute();

    // Comprobar si la actualización fue exitosa
    if ($query->affected_rows > 0) {
        // Si se afectaron filas, devolver éxito
        echo json_encode(['success' => 'Datos actualizados correctamente']);
    } else {
        // Si no se afectaron filas, puede ser que los datos sean iguales a los anteriores
        echo json_encode(['error' => 'No se pudo actualizar la información o los datos son los mismos'], JSON_UNESCAPED_UNICODE);
    }

    // Cerrar la consulta preparada
    $query->close();
} else {
    // Si el método de solicitud no es POST, devolver error
    echo json_encode(['error' => 'Método de solicitud no soportado'], JSON_UNESCAPED_UNICODE);
}

// Cerrar la conexión a la base de datos
$conexion->cerrarConexion();
?>


