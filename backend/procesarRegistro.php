<?php

require "modelo/Conexion.php";

$conexion = new Conexion();
$conexion->conectarBD();

// Verificar si se han enviado los datos del formulario de registro
if (!isset($_POST["nombreUsuario"])  !isset($_POST["nombre"])  !isset($_POST["apellidos"])  !isset($_POST["correo"])  !isset($_POST["telefono"]) || !isset($_POST["contrasena"])) {
    die("No se enviaron todos los datos requeridos para el registro.");
}

// Guardar en variables los datos enviados desde el formulario de registro
$nombreUsuario = $_POST['nombreUsuario'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$password = $_POST['contrasena'];

// Verificar si el nombre de usuario ya existe en la base de datos
$query = mysqli_query($conexion, "SELECT * FROM usuarios WHERE nombreUsuario='$nombreUsuario'");
$num = mysqli_num_rows($query);

if($num > 0){ // Si el nombre de usuario ya existe, mostrar mensaje de error
    echo "El nombre de usuario ya está en uso. Por favor, elige otro.";
    exit();
} else { // Si el nombre de usuario no existe, insertar el nuevo usuario en la base de datos
    $insert_query = "INSERT INTO usuarios (nombreUsuario, nombre, apellidos, correo, telefono, contrasena) VALUES ('$nombreUsuario', '$nombre', '$apellidos', '$correo', '$telefono', '$password')";
    $insert_result = mysqli_query($conexion, $insert_query);

    if ($insert_result) {
        echo "¡Registro exitoso! Ahora puedes iniciar sesión.";
        // Redireccionar a la página de inicio de sesión
        header("Location: login.html");
        exit();
    } else {
        echo "Error al registrar el usuario. Por favor, inténtalo de nuevo.";
        exit();
    }
}

?>