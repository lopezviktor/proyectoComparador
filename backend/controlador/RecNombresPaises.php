<?php

header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

 include "../modelo/Conexion.php";

 $conexion = new Conexion();
 $conexion->conectarBD();

 $query = "SELECT nombre FROM paises ORDER BY nombre";
 $result = mysqli_query($conexion->getConexion(), $query);

 $paises =[];
 while ($row = mysqli_fetch_assoc($result)){
    $paises[] = $row['nombre'];
 }
 echo json_encode($paises);
 $conexion->cerrarConexion();

?>