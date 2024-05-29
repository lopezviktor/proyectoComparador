document.addEventListener('DOMContentLoaded', function() {
    const inputBusqueda = document.getElementById('inputBuscador');
    inputBusqueda.addEventListener('input', manejarInputBusqueda);

    function manejarInputBusqueda() {
        const terminoBusqueda = inputBusqueda.value.trim();
        if (terminoBusqueda.length >= 1) {
            buscarPaises(terminoBusqueda);
        } else if (terminoBusqueda.length === 0) {
            mostrarPaises(); // Mostrar todos los países si el campo de búsqueda está vacío
        } else {
            limpiarResultados(); // Limpiar los resultados si la longitud es menor que 3 pero no es 0
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
            .then(mostrarResultados)
            .catch(error => {
                console.error('Error al buscar países:', error);
            });
    }

    function mostrarPaises() {
        fetch("../../backend/controlador/GenerarJsonPaises.php")
            .then(response => response.json())
            .then(mostrarResultados)
            .catch(error => console.log('Error al cargar todos los países', error));
    }

    function mostrarResultados(paises) {
        const contenedorPaises = document.getElementById("contenedorPaises");
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
        contenedorPais.appendChild(infoPais);

        return contenedorPais;
    }

    function limpiarResultados() {
        const contenedorPaises = document.getElementById("contenedorPaises");
        contenedorPaises.innerHTML = '';
    }

    // Inicialmente cargar todos los países
    mostrarPaises();

    //Bateria de imagenes INDEX
    const images = document.querySelectorAll('#galeriaImagenes img');
    let currentIndex = 0;

    // Mostrar la primera imagen
    images[currentIndex].classList.add('active');

    function showNextImage() {
        images[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % images.length;
        images[currentIndex].classList.add('active');
    }

    // Cambiar imagen cada 3 segundos
    setInterval(showNextImage, 4000);

});
