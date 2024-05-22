document.addEventListener('DOMContentLoaded', function(){

    const selectorContinente = document.getElementById('selectorContinente');
    
    selectorContinente.addEventListener('change', function(){
        const continenteSeleccionado = selectorContinente.value;
        obtenerPaises(continenteSeleccionado);
    });

    // Función asíncrona para obtener países del backend y mostrarlos como opciones con checkbox.
    async function obtenerPaises(continente) {
        
        const lista = document.getElementById('listaPaises');
        lista.innerHTML = ''; // Limpiar la lista anterior
        try {
            // Realiza una solicitud HTTP GET al servidor para obtener los países.
            const url = `../../backend/controlador/GenerarJsonPaises.php?continente=${encodeURIComponent(continente)}`;
            const respuesta = await fetch(url);
            if (!respuesta.ok) {
                throw new Error('Error al obtener los países');
            }
            // Convierte la respuesta en formato JSON a un array de países.
            const paises = await respuesta.json();
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
    // Convierte los checkboxes marcados en un array de objetos país.
    const paisesSeleccionados = Array.from(checkboxes).map(checkbox => JSON.parse(checkbox.value));

    if (paisesSeleccionados.length < 2 || paisesSeleccionados.length > 4) {
        alert('Por favor, seleccione de dos países a cuatro paises para poder comparar.');
        return;
    }

    const divResultados = document.getElementById('ResultadosComparacion');
    divResultados.innerHTML = ''; // Limpiar resultados anteriores

    agregarTablaPrincipal(paisesSeleccionados);
    agregarTablaComparacion(paisesSeleccionados, 'poblacion', 'Comparación por población:');
    agregarTablaComparacion(paisesSeleccionados, 'superficie', 'Comparación por superficie:');
    agregarTablaComparacion(paisesSeleccionados, 'PIB', 'Comparación por pib:');
    agregarTablaComparacion(paisesSeleccionados, 'esperanzaVida', 'Comparación por esperanza de vida:');
    agregarTablaComparacion(paisesSeleccionados, 'tasaNatalidad', 'Comparación por la tasa de natalidad:');
    agregarTablaComparacion(paisesSeleccionados, 'tasaMortalidad', 'Comparación por la tasa de mortalidad:');
}


function agregarTablaPrincipal(paisesSeleccionados) {
    const divResultados = document.getElementById('ResultadosComparacion');
    divResultados.innerHTML = ''; // Asegurarse de limpiar resultados previos

    // Crear la tabla y establecer su clase para estilos
    const tabla = document.createElement('table');
    tabla.className = 'tabla-comparativa';
    divResultados.appendChild(tabla); // Añadir la tabla al div de resultados

    // Crear fila de cabecera y añadir las celdas de cabecera para cada país
    const filaCabecera = tabla.insertRow();
    filaCabecera.insertCell().textContent = 'País'; // Columna para nombres de categorías

    // Agrega una celda de cabecera para cada país seleccionado.
    paisesSeleccionados.forEach(pais => {
        const celdaCabecera = document.createElement('th');
        celdaCabecera.textContent = pais.nombre;
        filaCabecera.appendChild(celdaCabecera);
    });

    // Función para agregar filas con datos de cada país
    const agregarFila = (titulo, propiedad) => {
        const fila = tabla.insertRow();
        fila.insertCell().textContent = titulo; // Título de la fila

        paisesSeleccionados.forEach(pais => {
            const celda = fila.insertCell();
            if (titulo === 'Bandera:') {
                const img = document.createElement('img');
                img.src = `../../imagenes/banderas/${pais[propiedad]}`;
                img.alt = `Bandera de ${pais.nombre}`;
                img.style.width = '60px';
                img.style.height = '30px';
                celda.appendChild(img);
            } else {
                celda.textContent = pais[propiedad]; // Datos de cada país
            }
        });
    };

    // Llamadas a agregarFila para cada propiedad que deseas mostrar
    agregarFila('Bandera:', 'bandera');
    agregarFila('Población (hab.):', 'poblacion');
    agregarFila('Superficie (km2):', 'superficie');
    agregarFila('PIB (%):', 'PIB');
    agregarFila('Esperanza de vida (años):', 'esperanzaVida');
    agregarFila('Tasa de natalidad (%):', 'tasaNatalidad');
    agregarFila('Tasa de mortalidad (%)', 'tasaMortalidad');
}


function agregarTablaComparacion(paises, propiedad, titulo) {
    const divResultados = document.getElementById('ResultadosComparacion');

    paises.sort((a, b) => b[propiedad] - a[propiedad]);

    const tabla = document.createElement('table');
    tabla.className = 'tabla-comparativa';

    // Crear fila de cabecera y añadir las celdas de cabecera para cada país
    const filaCabecera = tabla.insertRow();
    filaCabecera.insertCell().textContent = 'País'; // Columna para nombres de categorías

    paises.forEach(pais => {
        const celdaCabecera = filaCabecera.insertCell();
        celdaCabecera.textContent = pais.nombre; // Agrega el nombre del país en la cabecera
    });

    // Agregar fila para la propiedad especificada
    const filaDatos = tabla.insertRow();
    filaDatos.insertCell().textContent = titulo; // Título de la fila para la propiedad (e.g., 'Población (hab.):')

    paises.forEach(pais => {
        const celdaDatos = filaDatos.insertCell();
        celdaDatos.textContent = pais[propiedad]; // Asegúrate de que esta propiedad existe y tiene datos válidos
    });

    // Agregar fila para banderas
    const filaBanderas = tabla.insertRow();
    filaBanderas.insertCell().textContent = 'Bandera'; // Etiqueta para la fila de banderas

    paises.forEach(pais => {
        const celdaBandera = filaBanderas.insertCell();
        const img = document.createElement('img');
        img.src = `../../imagenes/banderas/${pais.bandera}`; // Asume que la propiedad contiene el nombre del archivo
        img.alt = `Bandera de ${pais.nombre}`;
        img.style.width = '60px';
        img.style.height = '30px';
        celdaBandera.appendChild(img);
    });

    // Añadir la tabla completa al div de resultados
    divResultados.appendChild(tabla);
}



