<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/administrarPaisesAdmin.js"></script>
    <title>Formulario añadir países</title>
    <link rel="stylesheet" href="../css/styles.css">
    
</head>
<body>
    <!--ESTA PAGINA SOLO DEBERIA VERLA EL ADMINISTRADOR -->

    <div id="contenedorIndex">
    <?php
            include "../includes/navSinBuscador.php"  //incluye el cóigo del archivo nav.php

    ?>

    <div id="contenedorPaginaFormRegistro">

        <h2>Formulario de Ingreso de Países</h2>
        <form id="formularioPaises" action="/proyectoComparador/backend/procesarFormulario.php" method="post" enctype="multipart/form-data">

            <label for="nombre">Nombre del País:</label><br>
            <input type="text" id="nombre" name="nombre" required><br><br>

            <label for="bandera">Bandera:</label><br>
            <input type="file" id="bandera" name="bandera" required><br><br>

            <label for="poblacion">Población:</label><br>
            <input type="number" id="poblacion" name="poblacion" required><br><br>
            
            <label for="superficie">Superficie Total (km²):</label><br>
            <input type="number" id="superficie" name="superficie" required><br><br>

            <label for="pib">PIB:</label><br>
            <input type="number" id="pib" name="pib" required><br><br>
        
            <label for="esperanzaVida">Esperanza de Vida:</label><br>
            <input type="number" id="esperanzaVida" name="esperanzaVida" step="0.01" required><br><br>

            <label for="tasaNatalidad">Tasa de natalidad:</label><br>
            <input type="number" id="tasaNatalidad" name="tasaNatalidad" step="0.01" required><br><br>

            <label for="tasaMortalidad">Tasa de mortalidad:</label><br>
            <input type="number" id="tasaMortalidad" name="tasaMortalidad" step="0.01" required><br><br>

            <label for="continente">Continente:</label><br>
            <select id="continente" name="continente">
                <option value="">Seleccione un continente</option>
                <option value="Europa">Europa</option>
                <option value="Asia">Asia</option>
                <option value="America">América</option>
                <option value="Africa">África</option>
                <option value="Oceania">Oceanía</option>
                </select><br><br>
        
            <input type="submit" value="Guardar">
        </form>

    </div>
    </div>

    <?php

        include "../includes/footer.php"  //incluye el código del archivo footer.php

    ?>

  </body>

</html>