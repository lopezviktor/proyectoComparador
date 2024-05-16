document.addEventListener('DOMContentLoaded', function(){

    function mostrarPaises(){
        const ruta = "../../backend/controlador/GenerarJsonPaises.php";

        fetch(ruta)
        .then(response => {
            if(!response.ok){
            console.log('No se pudo obtener los resultados.');
            }
            return response.json();
        })
        .then(datos => {
            console.log(datos); // Agregar esta línea para depurar
            mostrarResultados(datos);
        })
        .catch(error =>{
            console.log('Error al buscar paises', error)
        });
    }

    function mostrarResultados(resultados) {
        console.log(resultados); // Para verificar lo que recibe la función
        const contenedorPaises = document.getElementById("contenedorPaises");
        // Limpiar contenedor de paises
        contenedorPaises.innerHTML = '';

        // Iterar sobre cada país en el array de resultados
        resultados.forEach(pais => {
            const contenedorPais = document.createElement('div');
            contenedorPais.id = "contenedorPais";

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

    // Llamada a la función inicial para mostrar los países
    mostrarPaises();

    function mostrarResultadosPorNombre() {
        var inputBuscador = document.getElementById('inputBuscador').value; // Obtiene el valor del input
        if (inputBuscador.length > 0) { // Verifica que el input no esté vacío
            fetch(`../../backend/controlador/buscarPaisPorNombre.php?nombre=${encodeURIComponent(inputBuscador)}`) // Envía una solicitud GET al servidor
                .then(response => response.json()) // Procesa la respuesta como JSON
                .then(data => {
                    const resultadosBusqueda = document.getElementById('resultadosBusqueda');
                    resultadosBusqueda.innerHTML = ''; // Limpia resultados anteriores
                    data.forEach(pais => { // Itera sobre cada país devuelto por el servidor
                        const div = document.createElement('div');
                        div.textContent = `${pais.nombre} - Población: ${pais.poblacion}`;
                        resultadosBusqueda.appendChild(div); // Añade cada país a los resultados de búsqueda
                    });
                })
                .catch(error => console.error('Error al buscar paises:', error));
        } else {
            document.getElementById('resultadosBusqueda').innerHTML = ''; // Limpia los resultados si el input está vacío
        }
    }

});