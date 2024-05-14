document.addEventListener('DOMContentLoaded', function(){

    // Llama a la función para obtener la lista de países desde el servidor.
    obtenerPaises();

    // Función asíncrona para obtener países del backend y mostrarlos como opciones con checkbox.
    async function obtenerPaises() {
        try {
            // Realiza una solicitud HTTP GET al servidor para obtener los países.
            const respuesta = await fetch('../../backend/controlador/RecNombresPaises.php');
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
                checkbox.id = pais;
                checkbox.value = pais;
                checkbox.name = 'paises[]';

                const etiqueta = document.createElement('label');  // Crea una etiqueta para cada checkbox, usando el nombre del país.
                etiqueta.htmlFor = pais;
                etiqueta.textContent = pais;
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
    const paisesSeleccionados = Array.from(checkboxes).map(checkbox => checkbox.value);

    if(paisesSeleccionados.length < 2){
        alert('Por favor, selecione al menos dos paises para poder comparar.');
        return;
    }
    const divResultados = document.getElementById('ResultadosComparacion');
    divResultados.innerHTML = '';
     // Crea una lista HTML para mostrar los nombres de los países seleccionados.
    const  lista = document.createElement('ul');
    paisesSeleccionados.forEach(pais => { // Itera sobre cada país seleccionado y lo añade a la lista.
        const item = document.createElement('li');
        item.textContent = pais;
        lista.appendChild(item);
    });
    // Añade la lista de países seleccionados al div de resultados.
    divResultados.appendChild(lista);
}