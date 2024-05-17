<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/script.js"></script>
    <script src="../js/buscarPaisPorNombre.js" ></script>
    <link rel="stylesheet" href="../css/styles.css">
    <title>Comparador de paises</title>
    
</head>
<body>
    <div id="contenedorIndex">
        <?php
            include "../includes/nav.php"  //incluye el cóigo del archivo nav.php

        ?>
        
        <div id="contenedorPagina">
            <h1> Comparador de países</h1>
            <div id="resultadosBusqueda"></div>
        </div>

        <?php

            include "../includes/footer.php"  //incluye el código del archivo footer.php

        ?>

    </div>
    
</body>
</html>