function limpiarResultados(contenedor) {
    contenedor.innerHTML = '';
}

function crearContenedorPais(pais, favoritosUsuario, usuarioLogueado, toggleFavorito) {
    const contenedorPais = document.createElement('div');
    contenedorPais.className = "contenedorPais";
    contenedorPais.id = "contenedorPais";

    const imagenBandera = document.createElement('img');
    imagenBandera.src = "../../imagenes/banderas/" + pais.bandera;
    imagenBandera.alt = 'Bandera de ' + pais.nombre;

    imagenBandera.addEventListener('click', function() {
        localStorage.setItem('paisSeleccionado', pais.nombre);
        window.location.href = '../html/pais.php';
    });

    contenedorPais.appendChild(imagenBandera);

    const infoPais = document.createElement('div');
    infoPais.className = 'infoPais';
    infoPais.innerHTML = `<h3>${pais.nombre}</h3>
                            <p>Población: <br> ${pais.poblacion} hab</p>
                            <p>Superficie: <br> ${pais.superficie} km²</p>
                            <p>PIB: <br> ${pais.PIB} mill. €</p>
                            <p>Esperanza vida: <br> ${pais.esperanzaVida} años</p>
                            <!--
                            <p>Tasa natalidad: ${pais.tasaNatalidad} %</p>
                            <p>Tasa mortalidad: ${pais.tasaMortalidad} %</p>
                            -->`;

    const btnFavorito = document.createElement('button');
    if (favoritosUsuario.includes(pais.nombre)) {
        btnFavorito.textContent = 'Eliminar de favoritos';
        btnFavorito.classList.add('favorito');
    } else {
        btnFavorito.textContent = 'Añadir a favoritos';
    }
    btnFavorito.classList.add('btnFavorito');
    btnFavorito.addEventListener('click', function() {
        toggleFavorito(btnFavorito, pais.nombre);
    });

    infoPais.appendChild(btnFavorito);
    contenedorPais.appendChild(infoPais);
    return contenedorPais;
}
