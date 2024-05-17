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
    const checkboxes = document.querySelectorAll('input[name="paises[]"]:checked');
    const paisesSeleccionados = Array.from(checkboxes).map(checkbox => JSON.parse(checkbox.value));

    if (paisesSeleccionados.length < 2) {
        alert('Por favor, seleccione al menos dos países para poder comparar.');
        return;
    }

    const divResultados = document.getElementById('ResultadosComparacion');
    divResultados.innerHTML = ''; // Limpiar resultados anteriores

    // Crear la tabla y establecer su clase para estilos
    const tabla = document.createElement('table');
    tabla.className = 'tabla-comparativa';

    // Crear fila de cabecera y añadir las celdas de cabecera para cada país
    const filaCabecera = tabla.insertRow();
    filaCabecera.insertCell().textContent = 'Categoría'; // Celda vacía para la columna de categorías

    paisesSeleccionados.forEach(pais => {
        const celdaCabecera = document.createElement('th');
        celdaCabecera.textContent = pais.nombre;
        filaCabecera.appendChild(celdaCabecera);
    });

    // Función para agregar filas de datos a la tabla
    const agregarFila = (titulo, propiedad) => {
        const fila = tabla.insertRow();
        fila.insertCell().textContent = titulo; // Celda para el título de la categoría

        paisesSeleccionados.forEach(pais => {
            const celda = fila.insertCell();
            celda.textContent = pais[propiedad]; // Datos de cada país para la categoría dada
        });
    };

    // Agregar filas con datos específicos
    agregarFila('Población', 'poblacion');
    agregarFila('Superficie', 'superficie');
    agregarFila('PIB', 'PIB');
    agregarFila('Esperanza de vida', 'esperanzaVida');
    agregarFila('Tasa de natalidad', 'tasaNatalidad');
    agregarFila('Tasa de mortalidad', 'tasaMortalidad');

    // Añadir la tabla completa al div de resultados
    divResultados.appendChild(tabla);
}


