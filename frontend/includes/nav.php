<?php
session_start(); // Asegúrate de llamar a session_start() si no se ha llamado antes.
?>
<nav id="nav">
    <div class="logo">
        <a href="index.php"><img src="../../imagenes/logo.png" alt="Logo comparador"></a>
    </div>
    <!--
    <div class="buscadorNav">
        <div class="iconoBuscar"></div>
        <span class="espacioBuscador"></span>
        <input type="text" id="inputBuscador" placeholder="Buscar país...">
    </div>
-->
    <ul class="listaNav">
        <li><a href="index.php">Home</a></li>
        <li><a href="paises.php">Países</a></li>
        <li><a href="comparadorPaises.php">Comparador</a></li>
        <!--<li><a href="sobreNosotros.php">Sobre nosotros</a></li>-->
        <?php if (isset($_SESSION['usuario'])): ?>
        <li class ="favoritosComparador">
            <a href="../html/comparadorFavoritos.php"><?= htmlspecialchars('Favoritos') ?></a>
        </li>
        <li class="nombre-usuario">
            Bienvenido <a href="../html/paginaPerfil.php"><?= htmlspecialchars($_SESSION['usuario']) ?></a>
        </li>
        <li><a href="../../backend/controlador/logout.php">Cerrar sesión</a></li>

        <?php if ($_SESSION['usuario'] == "admin"): ?> 
            <li><a href="../html/registroPaises.php">Registrar País</a></li>
            <li><a href="../html/tablaPaisesAdmin.php">Modificar País</a></li>
        <?php endif; ?>
        <?php else: ?>
            <li><a href="login.php">Acceder o Registrar</a></li>
        <?php endif; ?>
    </ul>
<!--
    <div class="buscadorNav">
        <div class="iconoBuscar"></div>
        <span class="espacioBuscador"></span>
        <input type="text" id="inputBuscador" placeholder="Buscar país...">
    </div>
-->
    <!--Añadimos al buscador una imagen -->
    <div class="buscadorNav">
        <div class="iconoBuscar"><img src="../../imagenes/lupa.png" alt="Icono de búsqueda"></div>
        <span class="espacioBuscador"></span>
    <input type="text" id="inputBuscador" placeholder="Buscar país...">
</div>

</nav>
