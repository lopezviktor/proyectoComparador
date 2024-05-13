document.addEventListener('DOMContentLoaded', function(){

    obtenerPaises();

    async function obtenerPaises() {
        try {
            const respuesta = await fetch('../../backend/controlador/RecNombresPaises.php');
            if (!respuesta.ok) {
                throw new Error('Error al obtener los países');
            }
            const paises = await respuesta.json();
            const seleccion = document.getElementById('seleccionPais');
            paises.forEach(pais => {
                const opcion = document.createElement('option');
                opcion.value = pais;
                opcion.textContent = pais;
                seleccion.appendChild(opcion);
            });
        } catch (error) {
            console.error('Error:', error);
        }
    }
});
function comparadorPaises() {
    const seleccion = document.getElementById('seleccionPais');
    const opcionesSeleccionadas = Array.from(seleccion.selectedOptions).map(opcion => opcion.value);
    if (opcionesSeleccionadas.length < 2) {
        alert('Por favor, seleccione al menos dos países para comparar.');
        return;
    }
    console.log('Países seleccionados para comparar:', opcionesSeleccionadas);
    
}