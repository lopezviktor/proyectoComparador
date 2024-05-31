function obtenerFavoritosUsuario(callback) {
    fetch("../../backend/controlador/obtenerNombreFavoritos.php")
        .then(response => response.ok ? response.json() : null)
        .then(data => {
            if (data) {
                callback(data);
            } else {
                callback([]);
            }
        })
        .catch(error => {
            console.error('Error al obtener favoritos del usuario:', error);
            callback([]);
        });
}

function gestionFavoritos(data, callback) {
    fetch("../../backend/controlador/gestionFavoritos.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(errorInfo => {
                throw new Error('Error en la petición: ' + (errorInfo.error || 'Desconocido'));
            });
        }
        return response.json();
    })
    .then(result => callback(result))
    .catch(error => console.error('Error:', error.message));
}
