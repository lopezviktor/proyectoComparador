<?php

header('Content-Type: application/json; charset=utf-8');

require_once "../modelo/Conexion.php";

$conexion = new Conexion();
$conexion->conectarBD();

// Establecer la codificación de caracteres de la conexión a UTF-8
mysqli_set_charset($conexion->getConexion(), "utf8");

// Capturar el parámetro de búsqueda desde la URL
$nombrePais = isset($_GET['nombre']) ? $_GET['nombre'] : null;

$datosArrayPaises = array();


if (!empty($nombrePais)) {
    $nombrePais = "%$nombrePais%";
    $consulta = $conexion->getConexion()->prepare("SELECT nombre, bandera, poblacion, superficie, PIB, esperanzaVida, tasaNatalidad, tasaMortalidad, ubicacion FROM paises WHERE nombre LIKE ?");
    $consulta->bind_param("s", $nombrePais);
    $consulta->execute();
    $resultado = $consulta->get_result();
    while ($registro = mysqli_fetch_array($resultado, MYSQLI_ASSOC)) {
        $datosArrayPaises[] = $registro;
    }
    $consulta->close();
}

// Generamos un fichero json
echo json_encode($datosArrayPaises, JSON_UNESCAPED_UNICODE);

?>
