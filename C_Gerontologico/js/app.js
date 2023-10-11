let slider = document.querySelector('.slider .list');
let items = document.querySelectorAll('.slider .list .item');
let next = document.getElementById('next');
let prev = document.getElementById('prev');
let dots = document.querySelectorAll('.slider .dots li');
let textContainers = document.querySelectorAll('.contain-text');

let lengthItems = items.length - 1;
let active = 0;

next.onclick = function(){
    active = active + 1 <= lengthItems ? active + 1 : 0;
    reloadSlider();
}

prev.onclick = function(){
    active = active - 1 >= 0 ? active - 1 : lengthItems;
    reloadSlider();
}

let refreshInterval = setInterval(() => { next.click() }, 5000);

function reloadSlider() {
    slider.style.left = -items[active].offsetLeft + 'px';

    let last_active_dot = document.querySelector('.slider .dots li.active');
    last_active_dot.classList.remove('active');
    dots[active].classList.add('active');

    textContainers.forEach(container => container.classList.remove('active'));

    // Mostrar el contenedor correspondiente
    textContainers[active].classList.add('active');

    clearInterval(refreshInterval);
    refreshInterval = setInterval(() => { next.click() }, 5000);
}

dots.forEach((li, key) => {
    li.addEventListener('click', () => {
        active = key;
        reloadSlider();
    })
});

slider.addEventListener('transitionend', function() {
    textContainers.forEach((container, index) => {
        if (index === active) {
            container.style.opacity = '1';
        } else {
            container.style.opacity = '0';
        }
    });
});

window.onresize = function(event) {
    reloadSlider();
};



document.addEventListener('DOMContentLoaded', function () {
    var hamburger = document.querySelector('.hamburger');
    var menuDesplegable = document.querySelector('.menu-desplegable');

    hamburger.addEventListener('click', function () {
        menuDesplegable.style.display = (menuDesplegable.style.display === 'block') ? 'none' : 'block';
    });
});

// function toggleMenu() {
//     var menu = document.querySelector('.menu');
//     menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
    
// }

function toggleMenu() {
    var menu = document.querySelector('.menu');
    var filtroMenu = document.querySelector('.filtroMenu');
    var hamburger = document.querySelector('.hamburger');

    if (menu.style.display === 'block') {
        menu.style.display = 'none';
        filtroMenu.style.display = 'none';
        hamburger.style.position = 'absolute'; // Cambia a absolute
    } else {
        menu.style.display = 'block';
        filtroMenu.style.display = 'block';
        hamburger.style.position = 'fixed'; // Cambia a fixed
    }
}



