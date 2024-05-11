document.addEventListener('DOMContentLoaded', function(){

    const formularioPaises = document.getElementById('formularioPaises');
    formularioPaises.addEventListener('submit', function(event){
        event.preventDefault();ç

        const nombrePais = document.getElementById('nombrePais').value;
        const poblacion = document.getElementById('poblacion').value;
        const superficie = document.getElementById('supercifie').value;
        const pib = document.getElementById('pib').value;
        const esperanzaVida = document.getElementById('esperanzaVida').value;
        const tasaNatalidad = document.getElementById('tasaNatalidad').value;
        const tasaMortalidad = document.getElementById('tasaMortalidad').value;

        let errores = [];

        if(!/^[a-zA-Z\s]+$/.test(nombrePais)){
            errores.push("El nombre solo puede contener letras.")
        }
        
        //Verificamos que el resto de datos sean numericos todos aunque el type del formmulario ya este en 'number'

        if(!/^[0-9]+$/.test(poblacion)){
            errores.push("La población solo puede contener caracteres numéricos.")
        }
        if(!/^[0-9]+$/.test(superficie)){
            errores.push("La población solo puede contener caracteres numéricos.")
        }
        if(!/^[0-9]+$/.test(pib)){
            errores.push("La población solo puede contener caracteres numéricos.")
        }
        if(!/^[0-9]+$/.test(esperanzaVida)){
            errores.push("La población solo puede contener caracteres numéricos.")
        }
        if(!/^[0-9]+$/.test(tasaNatalidad)){
            errores.push("La población solo puede contener caracteres numéricos.")
        }
        if(!/^[0-9]+$/.test(tasaMortalidad)){
            errores.push("La población solo puede contener caracteres numéricos.")
        }

        if(errores.length > 0){
            alert(errores.join("\n"));

        }else {
            formularioRegistro.submit();
        }
    })
})


