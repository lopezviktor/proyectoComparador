document.addEventListener('DOMContentLoaded', function() {
    const inputBusqueda = document.getElementById('inputBuscador');
    const contenedorPaises = document.getElementById("contenedorPaises");
    let favoritosUsuario = [];
    let usuarioLogueado = false;

    inputBusqueda.addEventListener('input', manejarInputBusqueda);

    function manejarInputBusqueda() {
        const terminoBusqueda = inputBusqueda.value.trim();
        if (terminoBusqueda.length >= 1) {
            buscarPaises(terminoBusqueda);
        } else {
            mostrarPaises();
        }
    }

    function buscarPaises(nombre) {
        fetch(`../../backend/controlador/buscarPaisPorNombre.php?nombre=${encodeURIComponent(nombre)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('No se pudo obtener los resultados.');
                }
                return response.json();
            })
            .then(paises => mostrarResultados(paises))
            .catch(error => console.error('Error al buscar países:', error));
    }

    function mostrarPaises() {
        fetch("../../backend/controlador/GenerarJsonPaises.php")
            .then(response => {
                if (!response.ok) {
                    throw new Error('No se pudo cargar los países.');
                }
                return response.json();
            })
            .then(paises => mostrarResultados(paises))
            .catch(error => console.error('Error al cargar todos los países', error));
    }

    function obtenerFavoritosUsuario() {
        fetch("../../backend/controlador/obtenerNombreFavoritos.php")
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    usuarioLogueado = false;
                    favoritosUsuario = [];
                }
            })
            .then(data => {
                if (data) {
                    favoritosUsuario = data;
                    usuarioLogueado = true;
                }
            })
            .catch(error => {
                console.error('Error al obtener favoritos del usuario:', error);
                usuarioLogueado = false;
                favoritosUsuario = [];
            });
    }

    function mostrarResultados(paises) {
        limpiarResultados();
        paises.forEach(pais => {
            const contenedorPais = crearContenedorPais(pais);
            contenedorPaises.appendChild(contenedorPais);
        });
    }

    function crearContenedorPais(pais) {
        const contenedorPais = document.createElement('div');
        contenedorPais.className = "contenedorPais";
        contenedorPais.id = "contenedorPais";

        const imagenBandera = document.createElement('img');
        imagenBandera.src = "../../imagenes/banderas/" + pais.bandera;
        imagenBandera.alt = 'Bandera de ' + pais.nombre;
        contenedorPais.appendChild(imagenBandera);

        const infoPais = document.createElement('div');
        infoPais.className = 'infoPais';
        infoPais.innerHTML = `<h3>${pais.nombre}</h3>
                            <p>Población: ${pais.poblacion} hab.</p>
                            <p>Superficie: ${pais.superficie} km².</p>
                            <p>PIB: ${pais.PIB} mill. €</p>
                            <p>Esperanza vida: ${pais.esperanzaVida} años</p>
                            <p>Tasa natalidad: ${pais.tasaNatalidad} %</p>
                            <p>Tasa mortalidad: ${pais.tasaMortalidad} %</p>`;

        const btnFavorito = document.createElement('button');
        if (favoritosUsuario.includes(pais.nombre)) {
            btnFavorito.textContent = 'Eliminar de favoritos';
            btnFavorito.classList.add('favorito');
        } else {
            btnFavorito.textContent = 'Añadir a favoritos';
        }
        btnFavorito.classList.add('btnFavorito');
        btnFavorito.addEventListener('click', function() {
            if (usuarioLogueado) {
                toggleFavorito(btnFavorito, pais.nombre);
            } else {
                alert('Para añadir a favoritos es necesario iniciar sesión.');
            }
        });

        infoPais.appendChild(btnFavorito);
        contenedorPais.appendChild(infoPais);
        return contenedorPais;
    }

    function toggleFavorito(button, nombrePais) {
        const isFavorito = button.classList.contains('favorito');
        const data = { 
            pais: nombrePais,
            accion: isFavorito ? 'eliminar' : 'añadir' 
        };

        fetch("../../backend/controlador/gestionFavoritos.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(errorInfo => {
                    throw new Error('Error en la petición: ' + (errorInfo.error || 'Desconocido'));
                });
            }
            return response.json();
        })
        .then(result => {
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
            }
        })
        .catch(error => console.error('Error:', error.message));
    }

    function limpiarResultados() {
        contenedorPaises.innerHTML = '';
    }

    function iniciar() {
        obtenerFavoritosUsuario();
        mostrarPaises();
    }

    iniciar();
});
