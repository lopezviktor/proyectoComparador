<?php

header('Content-Type: application/json; charset=utf-8');

require_once "../modelo/Conexion.php";

$conexion = new Conexion();
$conexion->conectarBD();

// Establecer la codificación de caracteres de la conexión a UTF-8
mysqli_set_charset($conexion->getConexion(), "utf8");

$resulConsulta = mysqli_query($conexion->getConexion(), "SELECT nombreUsuario, nombre, 
    apellidos, correo, telefono  FROM usuarios") or
die ("Problemas con la consulta a la BBDD").mysqli_error($conexion->getConexion());

while ($registro = mysqli_fetch_assoc($resulConsulta)) {

    $datosArrayUsuarios[] = $registro;

}

//Genereramos un fichero json
$datosJsonUsuarios = json_encode($datosArrayUsuarios, JSON_UNESCAPED_UNICODE);
echo($datosJsonUsuarios);

?>