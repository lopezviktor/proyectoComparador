function buscarPaises(nombre, callback) {
    fetch(`../../backend/controlador/buscarPaisPorNombre.php?nombre=${encodeURIComponent(nombre)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('No se pudo obtener los resultados.');
            }
            return response.json();
        })
        .then(paises => callback(paises))
        .catch(error => console.error('Error al buscar países:', error));
}

function mostrarPaises(callback) {
    fetch("../../backend/controlador/GenerarJsonPaises.php")
        .then(response => {
            if (!response.ok) {
                throw new Error('No se pudo cargar los países.');
            }
            return response.json();
        })
        .then(paises => callback(paises))
        .catch(error => console.error('Error al cargar todos los países', error));
}
