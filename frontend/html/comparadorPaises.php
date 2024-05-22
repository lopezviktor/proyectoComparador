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
            include "../includes/navSinBuscador.php"  //incluye el cóigo del archivo nav.php

        ?>

        <div id="contenedorPaginaComparador">
            <form id="comparadorForm">
            <h2>Selecciona y compara</h2>
                <select id="selectorContinente">
                <option value="">Seleccione un continente</option>
                <option value="Europa">Europa</option>
                <option value="Asia">Asia</option>
                <option value="America">América</option>
                <option value="Africa">África</option>
                <option value="Oceania">Oceanía</option>
                </select>

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