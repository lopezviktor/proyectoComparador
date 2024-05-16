document.addEventListener('DOMContentLoaded', function(){
    const formularioRegistro = document.getElementById('formularioRegistro');

    formularioRegistro.addEventListener("submit", function(event){
        event.preventDefault();

        const nombreUsuario = document.getElementById('nombreUsuario').value;
        const nombre = document.getElementById('nombre').value;
        const apellidos = document.getElementById('apellidos').value;
        const correo = document.getElementById('correo').value;
        const contrasena = document.getElementById('password').value;

        let errores = [];

        if(!/^[a-zA-Z\s]+$/.test(nombre)){
            errores.push("El nombre solo puede contener letras.")
        }
        if (!/^[a-zA-Z\s]+$/.test(apellidos)) {
            errores.push("Los apellidos solo pueden contener letras.");
        }
        if (!/\S+@\S+\.\S+/.test(correo)) {
            errores.push("Debes ingresar un correo electrónico válido.");
        }
        if (contrasena.length < 8) {
            errores.push("La contraseña debe tener al menos 8 caracteres.");
        }
        //Si hay errores, los muestra y no envia el formulario
        if(errores.length > 0) {
            alert(errores.join("\n"));

        }else {
            formularioRegistro.submit();

        }
    });
});

