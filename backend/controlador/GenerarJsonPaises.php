<?php

header('Content-Type: application/json; charset=utf-8');

/*
$conexion = mysqli_connect("localhost", "root", "", "comparador") or
die("Ha habido un error conectando a la BBDD");
*/

require_once "../modelo/Conexion.php";

$conexion = new Conexion();
$conexion->conectarBD();

// Establecer la codificación de caracteres de la conexión a UTF-8
mysqli_set_charset($conexion->getConexion(), "utf8");

$resulConsulta = mysqli_query($conexion->getConexion(), "SELECT nombre, bandera, poblacion, superficie, 
PIB, esperanzaVida, tasaNatalidad, tasaMortalidad FROM paises") or
die("Problemas con la consulta a la BBDD").mysqli_error($conexion->getConexion());

$datosArrayPaises = array();

while ($registro = mysqli_fetch_array($resulConsulta, MYSQLI_ASSOC)) {
    $datosArrayPaises[] = $registro;
}

// Generamos un fichero json
$datosJsonPaises = json_encode($datosArrayPaises, JSON_UNESCAPED_UNICODE);
echo $datosJsonPaises;

?>