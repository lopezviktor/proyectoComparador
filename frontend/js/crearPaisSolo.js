document.addEventListener('DOMContentLoaded', function() {
    const nombrePais = localStorage.getItem('paisSeleccionado');

    if (!nombrePais) {
        console.error('No se encontró el nombre del país seleccionado.');
        return;
    }

    fetch(`../../backend/controlador/buscarPaisPorNombre.php?nombre=${encodeURIComponent(nombrePais)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(paises => {
            console.log('Respuesta del servidor:', paises);
            if (paises.length > 0) {
                crearContenedorPais(paises[0]);
            } else {
                console.error('No se encontró la información del país.');
            }
        })
        .catch(error => console.error('Error al obtener la información del país:', error));

    function crearContenedorPais(pais) {
        const contenedorPais = document.getElementById('contenedorPaisSolo');
        contenedorPais.className = "contenedorPaisSolo";

        if (!pais.bandera) {
            console.error('La propiedad "bandera" no está definida en el objeto país:', pais);
            return;
        }

        const imagenBandera = document.createElement('img');
        imagenBandera.src = "../../imagenes/banderas/" + pais.bandera;
        imagenBandera.alt = 'Bandera de ' + pais.nombre;
        imagenBandera.className = "imagenBandera";

        const imagenUbicacion = document.createElement('img');
        imagenUbicacion.src = "../../imagenes/ubicacion/" + pais.ubicacion;
        imagenUbicacion.alt = 'Ubicación de ' + pais.nombre;
        imagenUbicacion.className = "imagenUbicacion";

        const imagenesContainer = document.createElement('div');
    imagenesContainer.className = 'imagenes';
    imagenesContainer.appendChild(imagenBandera);
    imagenesContainer.appendChild(imagenUbicacion);

    const titulo = document.createElement('h3');
    titulo.textContent = pais.nombre;

    const infoPais = document.createElement('div');
    infoPais.className = 'infoPais';
    infoPais.innerHTML = `
        <p>La población es de ${pais.poblacion} habitantes.</p>
        <p>Su superficie es de ${pais.superficie} km².</p>
        <p>Tiene un PIB de ${pais.PIB} millones de €.</p>
        <p>La esperanza de vida es de ${pais.esperanzaVida} años, con una tasa de natalidad del ${pais.tasaNatalidad} %, y una tasa de mortalidad del ${pais.tasaMortalidad} %.</p>
    `;

    contenedorPais.appendChild(imagenesContainer);
    contenedorPais.appendChild(titulo);
    contenedorPais.appendChild(infoPais);

    }
});
