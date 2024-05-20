<?php
session_start();  // Esto debe ir al principio, antes de cualquier salida HTML.

require_once "../modelo/Conexion.php";

$conexion = new Conexion();
$conexion->conectarBD();
echo("Conectado");
if (!isset($_POST["nombreUsuario"]) || !isset($_POST["contrasena"])) {
    die("No se enviaron los datos de usuario y contraseña.");
}

$user = $_POST['nombreUsuario'];
$passwd = $_POST['contrasena'];

$query = $conexion->getConexion()->prepare("SELECT * FROM usuarios WHERE nombreUsuario = ? AND contrasena = ?");
$query->bind_param("ss", $user, $passwd);
$query->execute();
$result = $query->get_result();

if($result->num_rows == 1) { // Si se encuentra el usuario
    $row = $result->fetch_assoc();
    $_SESSION['usuario'] = $row['nombreUsuario'];  // Guardar nombre de usuario en sesión
    echo "Debug: Usuario encontrado y sesión iniciada.";
    header("Location: ../../frontend/html/index.php");
    exit();
} else {
    echo "Datos incorrectos";
    header("Location: ../../frontend/html/registroUsuarios.php");
    exit();
}
?>
