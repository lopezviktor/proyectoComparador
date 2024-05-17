<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/adminUsuarios.js" ></script>
    <link rel="stylesheet" href="../css/styles.css">
    
    <title>Nuevo registro</title>
</head>
<body>
    <?php
        include "../includes/nav.php"  //incluye el código del archivo nav.php

    ?>

    <div>

    <h2>Registro</h2>
    <form id="formularioRegistro" action="../../backend/procesarRegistro.php" method="post">

      <label for="nombreUsuario">Nombre de Usuario:</label><br>
      <input type="text" id="nombreUsuario" name="nombreUsuario" required><br><br>
  
      <label for="nombre">Nombre:</label><br>
      <input type="text" id="nombre" name="nombre" required><br><br>
  
      <label for="apellidos">Apellidos:</label><br>
      <input type="text" id="apellidos" name="apellidos" required><br><br>
  
      <label for="correo">Correo Electrónico:</label><br>
      <input type="email" id="correo" name="correo" required><br><br>
  
      <label for="telefono">Teléfono:</label><br>
      <input type="text" id="telefono" name="telefono" required><br><br>
  
      <label for="password">Contraseña:</label><br>
      <input type="password" id="password" name="contrasena" required><br><br>
  
      <input type="submit" value="Registrarse"><br>

      <p>¿Ya tienes una cuenta? <a href="login.html">Inicia sesión aquí</a></p>
    </form>
    </div>

    <?php

        include "../includes/footer.php"  //incluye el código del archivo footer.php

    ?>


    

</body>
</html>