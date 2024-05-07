document.addEventListener('DOMContentLoaded', function (){
    const btnSubmitLogin = document.getElementById('btnSubmitLogin');

    btnSubmitLogin.addEventListener('click', function (event){
        if(!validarFormularioLogin()){
            event.preventDefault(); // Detiene la acción predeterminada (envío del formulario)
        }
    });
});
function validarFormularioLogin(){
        const usuario = document.getElementById('usuario').value;
        const password = document.getElementById('password').value;
        let mensajesError = [];
    
    if (usuario.trim() === ""){
        mensajesError.push('El nombre de usuario es obligatorio.');
    }
    if (password.length < 8){
        mensajesError.push('La contraseña debe de tener al menos 8 caracteres.');
    }
    if(mensajesError > 0){
        alert(mensajesError.join('\n'));
        return false;
    }
    return true;
};
