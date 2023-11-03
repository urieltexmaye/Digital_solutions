

document.addEventListener('DOMContentLoaded', function () {
    var hamburger = document.querySelector('.hamburger');
    var menuDesplegable = document.querySelector('.menu-desplegable');

    hamburger.addEventListener('click', function () {
        menuDesplegable.style.display = (menuDesplegable.style.display === 'block') ? 'none' : 'block';
    });
});


// }

function toggleMenu() {
    var menu = document.querySelector('.menu');
    var filtroMenu = document.querySelector('.filtroMenu');
    var hamburger = document.querySelector('.hamburger');

    if (menu.style.display === 'block') {
        menu.style.display = 'none';
        filtroMenu.style.display = 'none';
        hamburger.style.position = 'absolute';
    } else {
        menu.style.display = 'block';
        filtroMenu.style.display = 'block';
        hamburger.style.position = 'fixed';
    }
}



// Cargar la barra de navegación mediante fetch
fetch('b-navegacion.php')
.then(response => response.text())
.then(data => {
    // Insertar el contenido en el contenedor
    document.getElementById('barra_de_navegacion').innerHTML = data;

    // Obtener la URL de la página actual
    var url = window.location.href;

    // Obtener todos los elementos <a> dentro de la barra de navegación
    var enlaces = document.querySelectorAll('nav a');

    // Iterar sobre los enlaces y agregar la clase 'pagina-actual' al enlace que coincide con la URL actual
    enlaces.forEach(function(enlace) {
    if (url.includes(enlace.href)) {
        enlace.classList.add('pagina-actual');
    }
    });
})

.catch(error => console.error('Error al cargar la barra de navegación:', error));


