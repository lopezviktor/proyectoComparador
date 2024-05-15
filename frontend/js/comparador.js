document.addEventListener('DOMContentLoaded', function(){

    // Llama a la función para obtener la lista de países desde el servidor.
    obtenerPaises();

    // Función asíncrona para obtener países del backend y mostrarlos como opciones con checkbox.
    async function obtenerPaises() {
        try {
            // Realiza una solicitud HTTP GET al servidor para obtener los países.
            const respuesta = await fetch('../../backend/controlador/GenerarJsonPaises.php');
            if (!respuesta.ok) {
                throw new Error('Error al obtener los países');
            }
            // Convierte la respuesta en formato JSON a un array de países.
            const paises = await respuesta.json();
            const lista = document.getElementById('listaPaises');
            paises.forEach(pais => { // Itera sobre cada país recibido del servidor.
                const contenedor = document.createElement('div'); // Crea un contenedor div para cada pareja de checkbox y etiqueta.
                const checkbox = document.createElement('input'); // Crea un input de tipo checkbox para cada país.
                checkbox.type = 'checkbox';
                checkbox.id = pais.nombre;
                checkbox.value = JSON.stringify(pais);
                checkbox.name = 'paises[]';

                const etiqueta = document.createElement('label');  // Crea una etiqueta para cada checkbox, usando el nombre del país.
                etiqueta.htmlFor = pais.nombre;
                etiqueta.textContent = pais.nombre;
                // Añade el checkbox y la etiqueta al div contenedor.
                contenedor.appendChild(checkbox);
                contenedor.appendChild(etiqueta);
                lista.appendChild(contenedor);

            });
        } catch (error) {
            console.error('Error:', error); // Captura y muestra en consola cualquier error durante la carga de países.
        }
    }
});
function comparadorPaises() {
    // Selecciona todos los checkboxes marcados que tienen el nombre 'paises[]'.
    const checkboxes = document.querySelectorAll('input[name="paises[]"]:checked');
     // Convierte los checkboxes marcados en un array de valores (nombres de los países).
    const paisesSeleccionados = Array.from(checkboxes).map(checkbox => JSON.parse(checkbox.value));
    // Ahora paisesSeleccionados es un array de objetos, cada uno representando un país seleccionado
    // Puedes acceder a sus propiedades como pais.nombre, pais.poblacion, etc.

    if(paisesSeleccionados.length < 2 || paisesSeleccionados.length > 4){
        alert('Por favor, selecione al menos dos paises para poder comparar y maximo cuatro.');
        return;
    }
    const divResultados = document.getElementById('ResultadosComparacion');
    divResultados.innerHTML = '';

    paisesSeleccionados.forEach(pais => {
        const contenedorPais = document.createElement('div'); // Crea un contenedor div para cada país, que contendrá el nombre y otros datos
        contenedorPais.className = 'pais-comparacion'; // Asigna una clase al contenedor

        const nombrePais = document.createElement('h3'); // Nombre en negrita
        // Inserta el nombre del país usando template strings y etiquetas de negrita
        nombrePais.innerHTML = `<strong>${pais.nombre}</strong>`;
        // Añade el nombre del país al contenedor
        contenedorPais.appendChild(nombrePais);

         // Crea un párrafo para los datos del país
        const datosPais = document.createElement('p');
        // Inserta varios datos del país en el párrafo, usando template strings `` para incorporar variables directamente en el texto
        datosPais.innerHTML = `Población: ${pais.poblacion} habitantes, Superficie: ${pais.superficie} km², PIB: ${pais.pib}, Esperanza de vida: ${pais.esperanzaVida} años, Tasa de natalidad: ${pais.tasaNatalidad}, Tasa de mortalidad: ${pais.tasaMortalidad}`;
        contenedorPais.appendChild(datosPais);
        // Añade el contenedor del país al div principal que mostrará todos los resultados
        divResultados.appendChild(contenedorPais);
    });
}