document.addEventListener('DOMContentLoaded', function() {
    const formResena = document.getElementById('formResena');
    const listaResenas = document.getElementById('listaResenas');

    formResena.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(formResena);
        
        fetch('../../backend/controlador/guardarResena.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                formResena.reset();
                cargarResenas();
            } else {
                console.error('Error al guardar la reseña:', data.error);
            }
        })
        .catch(error => console.error('Error:', error));
    });

    function cargarResenas() {
        fetch('../../backend/controlador/obtenerResenas.php')
        .then(response => response.json())
        .then(data => {
            listaResenas.innerHTML = '';
            data.forEach(resena => {
                const divResena = document.createElement('div');
                divResena.classList.add('resena');
                divResena.innerHTML = `
                    <h3>${resena.nombreUsuario}</h3>
                    <p>${resena.resena}</p>
                    <small>${new Date(resena.fecha).toLocaleString()}</small>
                `;
                listaResenas.appendChild(divResena);
            });
        })
        .catch(error => console.error('Error:', error));
    }

    cargarResenas();
});
