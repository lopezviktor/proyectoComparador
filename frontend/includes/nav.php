<?php
session_start(); // Asegúrate de llamar a session_start() si no se ha llamado antes.
?>
<nav id="nav">
    <div class="logo">
        <a href="index.php"><img src="../../imagenes/logo.png" alt="Logo comparador"></a>
    </div>
    <div class="buscadorNav">
        <div class="iconoBuscar"></div>
        <span class="espacioBuscador"></span>
        <input type="text" id="inputBuscador" placeholder="Buscar país...">
    </div>
    <ul class="listaNav">
        <li><a href="index.php">Home</a></li>
        <li><a href="paises.php">Países</a></li>
        <li><a href="comparadorPaises.php">Comparador</a></li>
        <li><a href="sobreNosotros.php">Sobre nosotros</a></li>
        <?php if (isset($_SESSION['usuario'])): ?>
            <li class="nombre-usuario">Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?></li>
            <li><a href="../../backend/controlador/logout.php">Cerrar sesión</a></li>

            <?php if ($_SESSION['usuario']=="admin"): ?> 
                
                <li><a href="../html/registroPaises.php">Registrar País</a></li>

            <?php  endif; ?>
                <!-- Aqui termina el if -->

            
        <?php else: ?>
            <li><a href="login.php">Acceder o Registrar</a></li>
        <?php endif; ?>
    </ul>
</nav>
