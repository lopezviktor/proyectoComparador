document.addEventListener('DOMContentLoaded', function() {
    const inputBusqueda = document.getElementById('inputBuscador');
    inputBusqueda.addEventListener('input', manejarInputBusqueda);

    function manejarInputBusqueda() {
        const terminoBusqueda = inputBusqueda.value.trim();
        if (terminoBusqueda.length >= 1) {
            buscarPaises(terminoBusqueda);
        } else {
            mostrarPaises();
        }
    }

    async function buscarPaises(nombre) {
        try {
            const response = await fetch(`../../backend/controlador/buscarPaisPorNombre.php?nombre=${encodeURIComponent(nombre)}`);
            if (!response.ok) {
                throw new Error('No se pudo obtener los resultados.');
            }
            const paises = await response.json();
            mostrarResultados(paises);
        } catch (error) {
            console.error('Error al buscar países:', error);
        }
    }

    async function mostrarPaises() {
        try {
            const response = await fetch("../../backend/controlador/GenerarJsonPaises.php");
            const paises = await response.json();
            mostrarResultados(paises);
        } catch (error) {
            console.log('Error al cargar todos los países', error);
        }
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

        const btnFavorito = document.createElement('button');
        btnFavorito.textContent = 'Favoritos';
        btnFavorito.classList.add('btnFavorito');
        btnFavorito.addEventListener('click', function() {
            addFavorito(pais.nombre);
        });

        infoPais.appendChild(btnFavorito);
        contenedorPais.appendChild(infoPais);
        return contenedorPais;
    }
    
    function addFavorito(nombrePais) {
        fetch("../../backend/controlador/gestionFavoritos.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ pais: nombrePais })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la petición');
            }
            return response.json();
        })
        .then(data => {
            console.log('Operación completada:', data);
            // Puedes agregar aquí cualquier otra lógica para manejar la respuesta.
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
    

    function limpiarResultados() {
        const contenedorPaises = document.getElementById("contenedorPaises");
        contenedorPaises.innerHTML = '';
    }

    mostrarPaises();
});
