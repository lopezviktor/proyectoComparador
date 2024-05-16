<?php

/*
** EN PRINCIPIO ESTE PHP NO ES NECESARIO YA QUE PODEMOS UTILIZAR EL GENERARJSONPAISES.PHP
*/


header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");

include "../modelo/Conexion.php";

$conexion = new Conexion();
$conexion->conectarBD();

$query = "SELECT nombre, bandera, poblacion, superficie, pib, esperanzaVida, tasaNatalidad, tasaMortalidad FROM paises ORDER BY nombre";
$result = mysqli_query($conexion->getConexion(), $query);

$paises = [];
while ($row = mysqli_fetch_assoc($result)) {
    $paises[] = [
        'nombre' => $row['nombre'],
        'bandera' => $row['bandera'],
        'poblacion' => $row['poblacion'],
        'superficie' => $row['superficie'],
        'pib' => $row['pib'],
        'esperanzaVida' => $row['esperanzaVida'],
        'tasaNatalidad' => $row['tasaNatalidad'],
        'tasaMortalidad' => $row['tasaMortalidad']
    ];
}
echo json_encode($paises);
$conexion->cerrarConexion();
?>