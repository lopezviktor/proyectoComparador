<?php

    require "modelo/Conexion.php";

    $conexion = new Conexion();
    $conexion->conectarBD();

    if (!isset($_POST["nombreUsuario"]) || !isset($_POST["contrasena"])) {
        die("No se enviaron los datos de usuario y contraseña.");
    }
    
    $user = $_POST['nombreUsuario'];
    $passwd = $_POST['contrasena'];
    
    // Realizar la consulta a la BD (usando consultas preparadas para mejorar la seguridad)
    $query = $conexion->getConexion()->prepare("SELECT * FROM usuarios WHERE nombreUsuario = ? AND contrasena = ?");
    $query->bind_param("ss", $user, $passwd);
    $query->execute();
    $result = $query->get_result();
    
    if($result->num_rows == 1) { // si se ha recuperado un registro
        header("Location: ../frontend/html/index.php"); // Redirigir al index
        exit();
    } else {
        echo "Datos incorrectos";
        // Opcion de mandar al registro : header("Location: ../frontend/html/registroUsuarios.html");
        exit();
    }

?>