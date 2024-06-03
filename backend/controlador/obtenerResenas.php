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

$query = $conexion->getConexion()->prepare("SELECT nombreUsuario, resena, fecha FROM resenas ORDER BY fecha DESC");

if ($query->execute()) {
    $result = $query->get_result();
    $resenas = [];

    while ($row = $result->fetch_assoc()) {
        $resenas[] = $row;
    }

    echo json_encode($resenas);
} else {
    echo json_encode(['error' => 'Error al obtener las reseñas', 'detalle' => $query->error]);
}

$query->close();
$conexion->cerrarConexion();

?>
