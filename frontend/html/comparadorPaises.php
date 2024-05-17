<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comparador</title>
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/comparador.js"></script>
    <script src="../js/buscarPaisPorNombre.js"></script>
</head>
<body>
    <div id="contenedor">
        <?php
            include "../includes/nav.php"  //incluye el cóigo del archivo nav.php

        ?>

        <div id="contenedorPagina">
            <h2>Selecciona y compara</h2>
            <form id="comparadorForm">
                <div id="listaPaises">
                    <!-- Los paises se cargarán aquí -->
                </div>
                
                <button type="button" onclick="comparadorPaises()">Comparar</button>
            </form>

            <div id="ResultadosComparacion"></div>
            
        </div>

        <?php

            include "../includes/footer.php"  //incluye el código del archivo footer.php

        ?>

    </div>

</body>
</html>