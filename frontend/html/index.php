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
        <div id="contenedorPaginaIndex">
            <h1>Comparador de países</h1>
            <div id="galeriaImagenes">
                <div class="slider">
                    <div class="slide"><img src="../../imagenes/madrid.jpg" alt="Imagen 1"></div>
                    <div class="slide"><img src="../../imagenes/brasil.jpg" alt="Imagen 2"></div>
                    <div class="slide"><img src="../../imagenes/china.jpg" alt="Imagen 3"></div>
                    <div class="slide"><img src="../../imagenes/newYork.jpg" alt="Imagen 4"></div>
                    <div class="slide"><img src="../../imagenes/nigeria.jpg" alt="Imagen 5"></div>
                    <div class="slide"><img src="../../imagenes/paris.jpg" alt="Imagen 6"></div>
                    <div class="slide"><img src="../../imagenes/sidney.jpg" alt="Imagen 7"></div>
                </div>
            </div>
            
            <div id="resultadosBusqueda">
            <!-- Resultados se mostrarán aquí -->
            </div>
            
        </div>
        <?php
            include "../includes/footer.php"  //incluye el código del archivo footer.php
        ?>
    </div>
    
</body>
</html>