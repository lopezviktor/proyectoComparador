<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración - Países</title>
    <link rel="stylesheet" href="path_to_your_css.css">
    <script src="../js/administrarPaisesAdmin.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

    <div id="contenedorIndex">
        <?php
                include "../includes/navSinBuscador.php"  //incluye el cóigo del archivo nav.php

        ?>
        <div id="contenedorPagina">

    <h1>Administración de Países</h1>
    <table id="tablaPaises">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Población</th>
                <th>Superficie</th>
                <th>PIB</th>
                <th>Esperanza Vida</th>
                <th>Tasa Natalidad</th>
                <th>Tasa Mortalidad</th>
                <th colspan="2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <!-- Los datos se llenarán desde el backend -->
        </tbody>
    </table>
    </div>
    </div>

    <?php

        include "../includes/footer.php"  //incluye el código del archivo footer.php

    ?>
</body>
</html>
