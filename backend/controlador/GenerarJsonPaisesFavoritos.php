<?php

header('Content-Type: application/json; charset=utf-8');

session_start();

require_once "../modelo/Conexion.php";

$conexion = new Conexion();
$conexion->conectarBD();

// Establecer la codificación de caracteres de la conexión a UTF-8
mysqli_set_charset($conexion->getConexion(), "utf8");

// Comprobar si el usuario está autenticado
if (!isset($_SESSION['usuario'])) {
    // Enviar error si el usuario no está autenticado
    echo json_encode(['error' => 'Usuario no autenticado']);
    exit;
}

// Obtener el nombre del usuario de la sesión
$nombreUsuario = $_SESSION['usuario'];

// Captura el parámetro 'continente' de la URL, si existe; si no, asigna un valor vacío.
$continente = isset($_GET['continente']) ? $_GET['continente'] : '';

// Define la consulta SQL base para seleccionar los datos de los países favoritos del usuario.
$query = "
    SELECT p.nombre, p.bandera, p.poblacion, p.superficie, p.PIB, p.esperanzaVida, p.tasaNatalidad, p.tasaMortalidad 
    FROM favoritos f
    JOIN paises p ON f.nombrePais = p.nombre
    WHERE f.nombreUsuario = ?
";

// Modifica la consulta si se ha proporcionado un continente específico.
if (!empty($continente)) {
    $query .= " AND p.continente = ?";
    $stmt = $conexion->getConexion()->prepare($query);
    $stmt->bind_param("ss", $nombreUsuario, $continente);
} else {
    $stmt = $conexion->getConexion()->prepare($query);
    $stmt->bind_param("s", $nombreUsuario);
}

$stmt->execute();
$result = $stmt->get_result();

// Inicializa un array para almacenar los datos de los países.
$datosArrayPaises = [];

// Itera sobre cada fila obtenida en la consulta, almacenando los datos en el array.
while ($registro = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $datosArrayPaises[] = $registro;
}

// Cierra la declaración preparada.
$stmt->close();

// Convierte el array de países a formato JSON y lo envía como respuesta.
echo json_encode($datosArrayPaises, JSON_UNESCAPED_UNICODE);

// Cierra la conexión a la base de datos.
$conexion->cerrarConexion();

?>
