<?php

header('Content-Type: application/json; charset=utf-8');

require_once "../modelo/Conexion.php";

$conexion = new Conexion();
$conexion->conectarBD();

// Establecer la codificación de caracteres de la conexión a UTF-8
mysqli_set_charset($conexion->getConexion(), "utf8");

// Capturar el parámetro de búsqueda desde la URL
$nombrePais = isset($_GET['nombre']) ? $_GET['nombre'] : '';

// Modificar la consulta para buscar por nombre
if (!empty($nombrePais)) {
    $consulta = $conexion->getConexion()->prepare("SELECT nombre, bandera, poblacion, superficie, PIB, esperanzaVida, tasaNatalidad, tasaMortalidad FROM paises WHERE nombre LIKE ?");
    $nombrePais = "%$nombrePais%";
    $consulta->bind_param("s", $nombrePais);
    $consulta->execute();
    $resultado = $consulta->get_result();
} else {
    $resultado = mysqli_query($conexion->getConexion(), "SELECT nombre, bandera, poblacion, superficie, PIB, esperanzaVida, tasaNatalidad, tasaMortalidad FROM paises");
}

$datosArrayPaises = array();
while ($registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
    $datosArrayPaises[] = $registro;
}

$consulta->close();

// Generamos un fichero json
$datosJsonPaises = json_encode($datosArrayPaises, JSON_UNESCAPED_UNICODE);
echo $datosJsonPaises;

?>
