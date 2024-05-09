<?php
//Archivo que procesa los datos enviados desde el formulario de países y los maneja en el backend.


$dbhost = 'localhost';
$dbuser = 'root';
$dbpasswd = '';
$dbname = 'comparador';

// conexión a la BD
$conexion = mysqli_connect($dbhost,$dbuser,$dbpasswd,$dbname);
if (!$conexion){
    die ("Error de conexión :".mysqli_connect_error());
}
else{
    echo("conectado");
    echo "<br>";
}

// Verificar si se han enviado los datos del formulario de registro
if (!isset($_POST["nombre"]) || !isset($_POST["poblacion"]) ||
    !isset($_POST["superficie"]) || !isset($_POST["pib"]) || !isset($_POST["esperanzaVida"]) || 
    !isset($_POST["tasaNatalidad"]) || !isset($_POST["tasaMortalidad"])) {
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


    // Procesar la subida de la imagen de la bandera
    $banderaNombre = $_FILES['bandera']['name'];
    $banderaTemp = $_FILES['bandera']['tmp_name'];
    $carpetaDestino = "C:/xampp/htdocs/proyectoComparador/imagenes/banderas/"; // Cambia esto por la ruta donde quieres guardar las imágenes
    $tipo = $_FILES['bandera']['type']; 
    $tamano = $_FILES['bandera']['size'];

    ////////////////////////////////////////
/*
    //Almacenar los datos del archivo en variables
    if (isset($_FILES['bandera'])) {
        $banderaNombre = $_FILES['bandera']['name'];
        $tipo = $_FILES['bandera']['type']; 
        $tamano = $_FILES['bandera']['size'];
        $banderaTemp = $_FILES['bandera']['tmp_name'];
    
        // Resto del código para procesar la imagen
    } else {
        echo "<br>";
        echo "Introduce una imagen";
    }
*/
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
            $queryRegistro = mysqli_query($conexion, "SELECT COUNT(nombre) AS cantidad FROM paises WHERE nombre = '$nombre'");
            $row = $queryRegistro->fetch_assoc();

            #Si la cantidad es mayor a 0 significa que ya hay un registro, por lo contrario, se inserta a la base de datos.
            if ($row['cantidad'] == 0) { 
            //if($queryRegistro = 0) {               
            

                // Mover el archivo de la bandera a la carpeta destino
                //move_uploaded_file($banderaTemp, $carpetaDestino.$banderaNombre);

                // Preparar la consulta SQL para insertar los datos en la tabla
                $insertar = mysqli_query($conexion, "INSERT INTO paises (nombre, bandera, poblacion, superficie, 
                    pib, esperanzaVida, tasaNatalidad, tasaMortalidad) 

                    VALUES ('$nombre', 'https://localhost/proyectoComparador/imagenes/banderas/$banderaNombre$tipo', 
                    $poblacion, $superficie, $pib, $esperanzaVida, $tasaNatalidad, $tasaMortalidad)");

                    //VALUES ('$nombre', 'C:/xampp/htdocs/comparadorPaises/imagenes/banderas/$banderaNombre$tipo', 
                    //$poblacion, $superficie, $pib, $esperanzaVida, $tasaNatalidad, $tasaMortalidad)");

                // Ejecutar la consulta
                if ($insertar) {
                    echo "<br>";
                    echo "Los datos se han guardado correctamente.";
                } else {
                    echo "<br>";
                    echo "Error al guardar los datos: ";
                }
 

            }else{           

                echo "<br>";
                echo "El país $nombre ya existe";
                //echo "El archivo $banderaNombre$tipo no se ha guardado correctamente";
            }
    
        }else {
            echo "<br>";
            echo "El archivo debe ser jpg, gif o png y máximo 10 Mb";
        }
    
    }else {
        echo "<br>";
        echo "Introduce una imagen";
    }

    ///////////////////////////////////////



    // Cerrar la conexión
    //$mysqli->close();


?>