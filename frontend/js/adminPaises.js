function subirPais(){
    const nombre = document.getElementById('nombrePais').value;
    const poblacion = document.getElementById('poblacion').value;
    const superficie = document.getElementById('supercifie').value;
    const pib = document.getElementById('pib').value;
    const esperanzaVida = document.getElementById('esperanzaVida').value;
    const tasaNatalidad = document.getElementById('tasaNatalidad').value;
    const tasaMortalidad = document.getElementById('tasaMortalidad').value;

    fetch('backend/procesarFormulario.php',{
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `nombre=${nombre}&poblacion=${poblacion}&superficie=${superficie}&pib=${pib}&esperanzaVida=${esperanzaVida}&tasaNatalidad=${tasaNatalidad}&tasaMortalidad=${tasaMortalidad}`
    })
    .then(response => response.text())
    .then(data => alert("Pais subido correctamente: " + data))
    .catch(error => console.error("Error :", error));
}