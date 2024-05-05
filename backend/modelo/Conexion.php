<?php
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpasswd = '';
    $dbname = 'comparador';

    $conexion = mysqli_connect($dbhost,$dbuser,$dbpasswd,$dbname);
    if (!$conexion){
        die ("Error de conexión :".mysqli_connect_error());
    }
    else{
        echo("conectado");
    }
?>