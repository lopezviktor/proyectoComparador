// Escuchar cuando el contenido del DOM esté completamente cargado.
document.addEventListener('DOMContentLoaded', function() {
    // Llamar a la función que carga los datos de los países.
    fetchDatos();
    // Definición de la función para obtener y mostrar los datos de los países.
    function fetchDatos() {
        // Hacer una solicitud fetch al servidor para obtener los datos de los países en formato JSON.
        fetch("../../backend/controlador/GenerarJsonPaises.php")
        .then(response => response.json())  // Convertir la respuesta del servidor de formato JSON a un objeto JavaScript.
        .then(data => {
            // Obtener el cuerpo de la tabla para insertar los datos de los países.
            const tabla = document.getElementById('tablaPaises').getElementsByTagName('tbody')[0];
            tabla.innerHTML = '';  // Limpiar la tabla antes de añadir nuevos datos.

            // Iterar sobre cada país recibido y agregarlo a la tabla.
            data.forEach(pais => {
                let fila = tabla.insertRow(); // Crear una nueva fila en la tabla.
                // Configurar el HTML interno de la fila con celdas que incluyen inputs para permitir la edición de los datos del país.
                fila.innerHTML = `
                <td><input type="text" value="${pais.nombre}"/></td>
                <td><input type="double" value="${pais.poblacion}"/></td>
                <td><input type="double" value="${pais.superficie}"/></td>
                <td><input type="double" value="${pais.PIB}"/></td>
                <td><input type="double" value="${pais.esperanzaVida}"/></td>
                <td><input type="double" value="${pais.tasaNatalidad}"/></td>
                <td><input type="double" value="${pais.tasaMortalidad}"/></td>
                <td><button onclick="editarPais(this, '${pais.nombre}')">Guardar</button></td>
                <td><button onclick="borrarPais('${pais.nombre}')">Borrar</button></td>
                `;
            });
        })
        .catch(error => console.error('Error loading the countries:', error)); // Capturar y registrar errores si la solicitud falla.
    }
});

// Función para editar un país específico.
function editarPais(button, nombre) {
    const fila = button.parentNode.parentNode; // Obtener la fila de la tabla que contiene el botón que fue presionado.
    const inputs = fila.querySelectorAll('input'); // Obtener todos los inputs dentro de la fila para leer los valores modificados.

    // Preparar un objeto con los datos actualizados del país.
    const data = {
        nombre: nombre,
        nuevoNombre: inputs[0].value,
        poblacion: inputs[1].value,
        superficie: inputs[2].value,
        PIB: inputs[3].value,
        esperanzaVida: inputs[4].value,
        tasaNatalidad: inputs[5].value,
        tasaMortalidad: inputs[6].value
    };

    // Hacer una solicitud POST al servidor para actualizar los datos del país.
    fetch("../../backend/controlador/actualizarDatosPaises.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)  // Convertir el objeto de datos a una cadena JSON.
    })
    .then(response => response.json())  // Convertir la respuesta a JSON.
    .then(result => {
        // Mostrar un mensaje de éxito o error dependiendo del resultado de la actualización.
        alert(result.success || result.error);
    })
    .catch(error => console.log('Error', error)); // Capturar y registrar errores de la solicitud.
}

function borrarPais(nombre) {
    // Preparar el objeto con el nombre del país a borrar
    const data = { nombre: nombre };

    // Hacer una solicitud POST al servidor para borrar el país
    fetch("../../backend/controlador/deletePais.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)  // Convertir el objeto de datos a una cadena JSON
    })
    .then(response => response.json())  // Convertir la respuesta a JSON
    .then(result => {
        // Mostrar un mensaje de éxito o error dependiendo del resultado
        alert(result.success || result.error);
        // Recargar los datos de los países para reflejar los cambios
        fetchDatos();
    })
    .catch(error => console.error('Error', error)); // Capturar y registrar errores de la solicitud
}

