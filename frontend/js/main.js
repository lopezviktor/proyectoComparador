document.addEventListener('DOMContentLoaded', function() {
    const inputBusqueda = document.getElementById('inputBuscador');
    const contenedorPaises = document.getElementById("contenedorPaises");
    let favoritosUsuario = [];
    let usuarioLogueado = false;

    inputBusqueda.addEventListener('input', manejarInputBusqueda);

    function manejarInputBusqueda() {
        const terminoBusqueda = inputBusqueda.value.trim();
        if (terminoBusqueda.length >= 1) {
            buscarPaises(terminoBusqueda, mostrarResultados);
        } else {
            mostrarPaises(mostrarResultados);
        }
    }

    function mostrarResultados(paises) {
        limpiarResultados(contenedorPaises);
        paises.forEach(pais => {
            const contenedorPais = crearContenedorPais(pais, favoritosUsuario, usuarioLogueado, toggleFavorito);
            contenedorPaises.appendChild(contenedorPais);
        });
    }

    function toggleFavorito(button, nombrePais) {
        const isFavorito = button.classList.contains('favorito');
        const data = { 
            pais: nombrePais,
            accion: isFavorito ? 'eliminar' : 'añadir' 
        };

        gestionFavoritos(data, (result) => {
            if (result.success) {
                if (isFavorito) {
                    button.textContent = 'Añadir a favoritos';
                    button.classList.remove('favorito');
                    favoritosUsuario = favoritosUsuario.filter(fav => fav !== nombrePais);
                } else {
                    button.textContent = 'Eliminar de favoritos';
                    button.classList.add('favorito');
                    favoritosUsuario.push(nombrePais);
                }
            } else {
                console.error('Error en la operación:', result);
                alert("Para añadir a favoritos es necesario iniciar sesión")
            }
        });
    }

    function inicializarPagina() {
        mostrarPaises(mostrarResultados); // Mostrar países siempre

        // Cambio: Obtener favoritos del usuario después de cargar los países
        obtenerFavoritosUsuario((data) => {
            if (data.length > 0) {
                favoritosUsuario = data;
                usuarioLogueado = true;
                // Cambio: Actualizar los botones de favoritos si ya se cargaron los países
                actualizarFavoritosUI();
            }
        });
    }

    // Cambio: Nueva función para actualizar la UI de los favoritos
    function actualizarFavoritosUI() {
        const botonesFavoritos = document.querySelectorAll('.btnFavorito');
        botonesFavoritos.forEach(button => {
            const nombrePais = button.parentElement.querySelector('h3').textContent;
            if (favoritosUsuario.includes(nombrePais)) {
                button.textContent = 'Eliminar de favoritos';
                button.classList.add('favorito');
            } else {
                button.textContent = 'Añadir a favoritos';
                button.classList.remove('favorito');
            }
        });
    }

    inicializarPagina();
});
