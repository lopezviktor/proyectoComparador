<?php

require_once "../modelo/Conexion.php";
require_once "../modelo/Usuario.php";

$conexion = new Conexion();
$conexion->conectarBD();

// Verificar si se han enviado los datos del formulario de registro
if (!isset($_POST["nombreUsuario"]) || !isset($_POST["nombre"]) || !isset($_POST["apellidos"]) || !isset($_POST["correo"]) || !isset($_POST["telefono"]) || !isset($_POST["contrasena"])) {
    die("No se enviaron todos los datos requeridos para el registro.");
}

// Guardar en variables los datos enviados desde el formulario de registro de usuarios
$nombreUsuario = $_POST['nombreUsuario'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$password = $_POST['contrasena'];

// Verificar si el nombre de usuario ya existe en la base de datos
$query = $conexion->getConexion()->prepare("SELECT * FROM usuarios WHERE nombreUsuario = ?");
$query->bind_param("s", $nombreUsuario);
$query->execute();
$result = $query->get_result();
$query->close();

if($result->num_rows > 0){ 
    echo "<script>
        alert('El nombre de usuario ya está en uso. Por favor, elige otro.');
        window.location= '../../frontend/html/registroUsuarios.php'
    </script>";
    //echo json_encode(['El nombre de usuario ya está en uso. Por favor, elige otro.'], JSON_UNESCAPED_UNICODE);
    //echo "El nombre de usuario ya está en uso. Por favor, elige otro.";
    exit();
} else {
    // Crear el usuario y guardarlo en la base de datos
    $usuario = new Usuario($nombreUsuario, $nombre, $apellidos, $correo, $telefono, $password);
    if ($usuario->guardarUsuario()) {

        echo "<script>
        alert('¡Registro exitoso! Ahora puedes iniciar sesión.');
        window.location= '../../frontend/html/login.php'
    </script>";

        //echo "¡Registro exitoso! Ahora puedes iniciar sesión.";
        //header("Location: ../../frontend/html/login.php");
        exit();
    } else {

        echo "<script>
        alert('Error al registrar el usuario. Por favor, inténtalo de nuevo.');
        window.location= '../../frontend/html/registroUsuarios.php'
    </script>";

        //echo "Error al registrar el usuario. Por favor, inténtalo de nuevo.";
        exit();
    }
}

?>