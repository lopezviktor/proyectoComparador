<?php

header('Content-Type: application/json; charset=utf-8');

require_once "../modelo/Conexion.php";

$conexion = new Conexion();
$conexion->conectarBD();

// Establecer la codificación de caracteres de la conexión a UTF-8
mysqli_set_charset($conexion->getConexion(), "utf8");

// Captura el parámetro 'continente' de la URL, si existe; si no, asigna un valor vacío.
$continente = isset($_GET['continente']) ? $_GET['continente'] : '';

// Define la consulta SQL base para seleccionar los datos de los países.
$query = "SELECT nombre, bandera, poblacion, superficie, PIB, esperanzaVida, tasaNatalidad, tasaMortalidad, ubicacion FROM paises";

// Modifica la consulta si se ha proporcionado un continente específico.
if (!empty($continente)) {
    $query .= " WHERE continente = ?";
    $stmt = $conexion->getConexion()->prepare($query);
    $stmt->bind_param("s", $continente);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conexion->getConexion()->query($query);
}

// Inicializa un array para almacenar los datos de los países.
$datosArrayPaises = [];

// Itera sobre cada fila obtenida en la consulta, almacenando los datos en el array.
while ($registro = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $datosArrayPaises[] = $registro;
}

// Cierra la declaración preparada si se utilizó.
if (!empty($continente)) {
    $stmt->close();
}

// Convierte el array de países a formato JSON y lo envía como respuesta.
echo json_encode($datosArrayPaises, JSON_UNESCAPED_UNICODE);

// Cierra la conexión a la base de datos.
$conexion->cerrarConexion();

?>