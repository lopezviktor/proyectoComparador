document.addEventListener('DOMContentLoaded', function() {


    //Bateria de imagenes INDEX
    const images = document.querySelectorAll('#galeriaImagenes img');
    let currentIndex = 0;

    // Mostrar la primera imagen
    images[currentIndex].classList.add('active');

    function showNextImage() {
        images[currentIndex].classList.remove('active');
        currentIndex = (currentIndex + 1) % images.length;
        images[currentIndex].classList.add('active');
    }

    // Cambiar imagen cada 3 segundos
    setInterval(showNextImage, 4000);

});
