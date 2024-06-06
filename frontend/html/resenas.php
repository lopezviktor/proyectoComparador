<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/styles.css">
    <script src="../js/resenas.js"></script>
    <title>Comparador de paises</title>
</head>
<body>
    <div id="contenedorIndex">
    <?php
            include "../includes/navSinBuscador.php"  //incluye el cóigo del archivo nav.php
    ?>

    <div id="contenedorPaginaPlus">

        <section id="resenas">
            <h2>Reseñas de Clientes</h2>
            <form id="formResena">
                <div>
                    <label for="resena">Reseña:</label>
                    <textarea id="resena" name="resena" required></textarea>
                </div>
                <div>
                    <button type="submit">Enviar Reseña</button>
                </div>
            </form>
            <div id="listaResenas">
                <!-- Aquí se mostrarán las reseñas -->
            </div>
        </section>
    </div>

    <?php

        include "../includes/footer.php"  //incluye el código del archivo footer.php

    ?>
</body>
</html>