document.addEventListener('DOMContentLoaded', function(){

    // Obtener referencia al campo de entrada de texto para búsqueda
    const inputBusqueda = document.getElementById('inputBuscador');

    // Agregar evento de input al campo de búsqueda
    inputBusqueda.addEventListener('input', function() {
        const terminoBusqueda = inputBusqueda.value.trim();
        
        // Realizar la búsqueda solo si el término de búsqueda tiene al menos 3 caracteres
        
        if (terminoBusqueda.length >= 1) {
            buscarPaises(terminoBusqueda);
        }else if(terminoBusqueda.length === 0){
            limpiarResultados();
            console.log("Hay que limpiar los resultados")
        }
    });

    // Función para buscar países por nombre
    function buscarPaises(nombre) {
        // Realizar una solicitud GET al script PHP con el término de búsqueda como parámetro
        fetch(`../../backend/controlador/buscarPaisPorNombre.php?nombre=${nombre}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('No se pudo obtener los resultados.');
                }
                return response.json();
            })
            .then(data => {
                mostrarResultados(data);
            })
            .catch(error => {
                console.error('Error al buscar países:', error);
            });
    }

    // Función para mostrar los resultados de la búsqueda
    function mostrarResultados(resultados) {
        console.log(resultados); // Para verificar lo que recibe la función
        const contenedorPaises = document.getElementById("resultadosBusqueda");
        // Limpiar contenedor de paises
        contenedorPaises.innerHTML = '';

        // Iterar sobre cada país en el array de resultados
        resultados.forEach(pais => {
            const contenedorPais = document.createElement('div');
            contenedorPais.id = "contenedorPaisIndex";

            // Añadir imagen de la bandera
            const imagenBandera = document.createElement('img');
            imagenBandera.src = "../../imagenes/banderas/" + pais.bandera;
            imagenBandera.alt = 'Bandera de ' + pais.nombre;
            contenedorPais.appendChild(imagenBandera);

            // Añadir información del país
            const infoPais = document.createElement('div');
            infoPais.className = 'infoPais';
            infoPais.innerHTML = `<h3>${pais.nombre}</h3>
                                <p>Población: ${pais.poblacion} hab.</p>
                                <p>Superficie: ${pais.superficie} km².</p>
                                <p>PIB: ${pais.PIB} millones €.</p>
                                <p>Esperanza de vida: ${pais.esperanzaVida} años</p>
                                <p>Tasa de natalidad: ${pais.tasaNatalidad}%</p>
                                <p>Tasa de mortalidad: ${pais.tasaMortalidad}%</p>`;
            contenedorPais.appendChild(infoPais);

            // Añadir el contenedor de país al contenedor principal
            contenedorPaises.appendChild(contenedorPais);
        });
    }
    function limpiarResultados() {
        const contenedorResultados = document.getElementById('resultadosBusqueda');
        contenedorResultados.innerHTML = ''; // Esto borra el contenido del elemento
    }
});