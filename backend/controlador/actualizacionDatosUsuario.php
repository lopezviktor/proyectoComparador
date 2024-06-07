<?php

session_start();
header('Content-Type: application/json; charset=utf-8');

require_once "../modelo/Conexion.php";

$conexion = new Conexion();
$conexion->conectarBD();

// Establecer la codificación de caracteres de la conexión a UTF-8
mysqli_set_charset($conexion->getConexion(), "utf8");

if (!isset($_SESSION['usuario'])) {
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit;
}

$usuario = $_SESSION['usuario'];

$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : null;
$correo = isset($_POST['correo']) ? $_POST['correo'] : null;
$telefono = isset($_POST['telefono']) ? $_POST['telefono'] : null;

// Preparar la consulta de actualización
$query = $conexion->getConexion()->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, correo = ?, telefono = ? WHERE nombreUsuario = ?");

if (!$query) {
    echo json_encode(['error' => 'Error preparando la consulta']);
    exit;
}

$query->bind_param("sssss", $nombre, $apellidos, $correo, $telefono, $usuario);
$query->execute();

// Verificar si la actualización fue exitosa
if ($query->affected_rows > 0) {
    echo json_encode('Datos actualizados correctamente');
} else {
    echo json_encode(['error' => 'No se pudo actualizar la información o los datos son los mismos'], JSON_UNESCAPED_UNICODE); //Para que ponga acentos bien
}

$query->close();
$conexion->cerrarConexion();
?>
