document.addEventListener('DOMContentLoaded', function(){
    cargarDatosUsuario();

    document.getElementById('perfilForm').addEventListener('submit', function(event){
        event.preventDefault();
        actualizarDatosUsuario();
    });
});
function cargarDatosUsuario(){
    fetch('../../backend/controlador/obtenerDatosUsuarios.php')
    .then(response => {
        console.log('Respuesta recibida');
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        const datos = data[0];
        document.getElementById('nombreUsuario').value = datos.nombreUsuario;
        console.log(datos.nombreUsuario);
        document.getElementById('nombre').value = datos.nombre;
        document.getElementById('apellidos').value = datos.apellidos;
        document.getElementById('correo').value = datos.correo;
        document.getElementById('telefono').value = datos.telefono;
    })
    .catch(error => console.log('Error', error));
}

function actualizarDatosUsuario(){
    const formData = new FormData(document.getElementById('perfilForm'));
    fetch('../../backend/controlador/actualizacionDatosUsuario.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        alert(result);
    })
    .catch(error => console.log('Error', error));
}