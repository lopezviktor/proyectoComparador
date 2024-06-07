<?php
//Archivo que procesa los datos enviados desde el formulario de países y los maneja en el backend.

/*
$dbhost = 'localhost';
$dbuser = 'root';
$dbpasswd = '';
$dbname = 'comparador';
*/
require "../modelo/Conexion.php";

$conexion = new Conexion();
$conexion->conectarBD();

// conexión a la BD
//$conexion = mysqli_connect($dbhost,$dbuser,$dbpasswd,$dbname);
if (!$conexion->getConexion()){
    die ("Error de conexión :".mysqli_connect_error());
}
else{
    echo("conectado");
    echo "<br>";
}

// Verificar si se han enviado los datos del formulario de registro
if (!isset($_POST["nombre"]) || !isset($_POST["poblacion"]) ||
    !isset($_POST["superficie"]) || !isset($_POST["pib"]) || !isset($_POST["esperanzaVida"]) || 
    !isset($_POST["tasaNatalidad"]) || !isset($_POST["tasaMortalidad"]) || !isset($_POST["continente"]))
    {
    die("No se enviaron todos los datos requeridos para el registro.");
    }

    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $poblacion = $_POST['poblacion'];
    $superficie = $_POST['superficie'];
    $pib = $_POST['pib'];
    $esperanzaVida = $_POST['esperanzaVida'];
    $tasaNatalidad = isset($_POST['tasaNatalidad']) ? $_POST['tasaNatalidad'] : null;
    $tasaMortalidad = isset($_POST['tasaMortalidad']) ? $_POST['tasaMortalidad'] : null;
    $continente = $_POST['continente'];

    // Procesar la subida de la imagen de la bandera
    $banderaNombre = $_FILES['bandera']['name'];
    $banderaTemp = $_FILES['bandera']['tmp_name'];
    $carpetaDestino = "C:/xampp/htdocs/proyectoComparador/imagenes/banderas/"; // Cambia esto por la ruta donde quieres guardar las imágenes
    $tipo = $_FILES['bandera']['type']; 
    $tamano = $_FILES['bandera']['size'];

    if ($_FILES['bandera']['name'] != "") {

        //Verifica que la imagen tiene extensión jpg, gif o png y tamaño menor de 10 Mb (por defecto trabaja en bytes)
        if ((strpos($tipo,'jpeg') || strpos($tipo,'gif') || strpos($tipo,'png') || strpos($tipo,'bmp')) 
            && ($tamano < 10000000)) {   //Con strpos buscamos la extensión jpg
    
            //Movemos la imagen a la carpeta 'imagenes' del servidor
            //$carpetaDestino = "C:/xampp/htdocs/comparadorPaises/imagenes/banderas/";
            $banderaNombre = $nombre;   //renombra el fichero con en nombre del país 
                    
            //$tipo = ''; // Initialize $tipo variable
            if (strpos($tipo,'jpeg')) {
                $tipo = '.jpg';
            } elseif (strpos($tipo,'gif')) {
                $tipo = '.gif';
            } elseif (strpos($tipo,'png')) {
                $tipo = '.png';
            } elseif (strpos($tipo,'bmp')) {
                $tipo = '.bmp';
            }

            // Mover el archivo de la bandera a la carpeta destino
            move_uploaded_file($_FILES['bandera']['tmp_name'], 
            $carpetaDestino . $banderaNombre . $tipo);

            #variable con el registro que se va a insertar
            $nombre = $_POST['nombre']; 

            #Se hace una consulta a la tabla registros de base de datos, se usa COUNT para saber cuántos registros tiene.
            $queryRegistro = mysqli_query($conexion->getConexion(), "SELECT COUNT(nombre) AS cantidad FROM paises WHERE nombre = '$nombre'");
            $row = $queryRegistro->fetch_assoc();

            #Si la cantidad es mayor a 0 significa que ya hay un registro, por lo contrario, se inserta a la base de datos.
            if ($row['cantidad'] == 0) { 
            //if($queryRegistro = 0) {               

            // Preparar la consulta SQL para insertar los datos en la tabla
            $query = "INSERT INTO paises (nombre, bandera, poblacion, superficie, pib, esperanzaVida, tasaNatalidad, tasaMortalidad, continente) VALUES ('$nombre', '$banderaNombre', $poblacion, $superficie, $pib, $esperanzaVida, $tasaNatalidad, $tasaMortalidad, '$continente')";

            // Ejecutar la consulta
            if ($conexion->getConexion()->query($query) === TRUE) {
                //echo "Los datos se han guardado correctamente.";

                echo "<script>
                alert('Los datos se han guardado correctamente.');
                window.location= '../../frontend/html/registroPaises.php'
            </script>";

            } else {
                echo "Error al guardar los datos: " . $conexion->getConexion()->error;
            }

            }else{  
                
                echo "<script>
                alert('El país $nombre ya existe');
                window.location= '../../frontend/html/registroPaises.php'
            </script>";

                //echo "<br>";
                //echo "El país $nombre ya existe";
                //echo "El archivo $banderaNombre$tipo no se ha guardado correctamente";
            }
    
        }else {

            echo "<script>
            alert('El archivo debe ser jpg, gif, bmp o png y máximo 10 Mb');
            window.location= '../../frontend/html/registroPaises.php'
        </script>";

            //echo "<br>";
            //echo "El archivo debe ser jpg, gif o png y máximo 10 Mb";
        }
    
    }else {

        echo "<script>
        alert('Introduce una imagen');
        window.location= '../../frontend/html/registroPaises.php'
    </script>";

        //echo "<br>";
        //echo "Introduce una imagen";
    }

    // Cerrar la conexión
    //$mysqli->close();


?>