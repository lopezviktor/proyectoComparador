<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/script.js"></script>
    <script src="../js/adminPerfilUsuario.js"></script>
    <link rel="stylesheet" href="../css/styles.css">
    <title>Perfil Usuario</title>
</head>
<body>
    <div id="contenedor">
        <?php
            include "../includes/navSinBuscador.php"  //incluye el cóigo del archivo nav.php
        ?>
        <h1>Perfil del Usuario</h1>
            <form id="perfilForm">

                <label for="nombreUsuario">Nombre de Usuario:</label><br>
                <input type="text" id="nombreUsuario" name="nombreUsuario"><br><br>

                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" name="nombre"><br><br>

                <label for="apellidos">Apellidos:</label><br>
                <input type="text" id="apellidos" name="apellidos"><br><br>
            
                <label for="correo">Correo Electrónico:</label><br>
                <input type="email" id="correo" name="correo"><br><br>
            
                <label for="telefono">Teléfono:</label><br>
                <input type="text" id="telefono" name="telefono"><br><br>
            
                <label for="password">Contraseña:</label><br>
                <input type="password" id="password" name="contrasena"><br><br>

                <button type="submit">Guardar Cambios</button>
            </form>
        <?php
            include "../includes/footer.php"  //incluye el código del archivo footer.php

        ?>
    </div>
</body>
</html>