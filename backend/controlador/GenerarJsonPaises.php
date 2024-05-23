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

// Captura el parámetro 'continente' de la URL, si existe; si no, asigna un valor vacío.
$continente = isset($_GET['continente']) ? $_GET['continente'] : '';

// Define la consulta SQL base para seleccionar los datos de los países.
$query = "SELECT nombre, bandera, FORMAT(poblacion, 0) as poblacion, FORMAT(superficie, 0) as superficie, FORMAT(PIB, 0) as PIB, FORMAT(esperanzaVida, 2) as esperanzaVida, FORMAT(tasaNatalidad, 2) as tasaNatalidad, FORMAT(tasaMortalidad, 2) as tasaMortalidad FROM paises";

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

/* PARTE ANTERIOR CON LA QUERY SIN AÑADIR UN CONTINENTE.
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

*/
?>