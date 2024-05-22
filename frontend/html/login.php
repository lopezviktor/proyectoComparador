<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/script.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <title>Comparador de paises</title>
    
</head>
<body>
    <div id="contenedor">
        <?php
                include "../includes/nav.php"  //incluye el cóigo del archivo nav.php

        ?>

        <div class="contenedorSesion">
            <h2>Iniciar Sesión</h2>
            <form id="formularioLogin" action="../../backend/controlador/login.php" method="post"> 
                
                <label for="usuario">Usuario:</label><br>
                <input type="text" id="usuario" name="nombreUsuario" required><br><br>

                <label for="password">Contraseña:</label><br>
                <input type="password" id="password" name="contrasena" required><br><br>

                <input type="submit" id="btnSubmitLogin" value="Iniciar Sesión">
            </form>

            <div style="text-align: center;">
                <p>¿Aún no tienes una cuenta?</p>
                <p><a href="registroUsuarios.php">Regístrate gratis aquí</a></p>
            </div>

        </div>

        <?php

            include "../includes/footer.php"  //incluye el código del archivo footer.php

        ?>

    </div>
</body>
</html>