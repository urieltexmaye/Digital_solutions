<?php
// Inicia una sesión
session_start();
// Crea una variable para almacenar el mensaje de éxito
$exitoMessage = "";
// Comprueba si la variable de sesión "exito" está definida
if (isset($_SESSION["exito"])) {
    // asigna su valor a la variable $exitoMessage

    $exitoMessage = $_SESSION["exito"];
    // Borra la variable de sesión "exito" 
    //para que el mensaje no se muestre nuevamente en futuras páginas
    unset($_SESSION["exito"]);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/inicio.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel=" icon" type="image/ico" href="iconos/LogoIcon.png"/>
    <link href="https://fonts.googleapis.com/css2?family=Chela+One&family=Montserrat:wght@500&family=Quicksand&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <title>Inicio</title>
</head>


<body class="tex">
    <!-- filtro al abrir menu test2-->
    <div class="filtroMenu"></div>

    <div id="barra_de_navegacion" class="pagina-actual"></div></div>



    <div class="slider">
        <div class="list">
            <div class="item">
                <img src="img/r1.jpg" alt="">
            </div>
            <div class="item">
                <img src="img/r4.jpg" alt="">
            </div>
            <div class="item">
                <img src="img/r3.jpg" alt="">
            </div>
            <div class="item">
                <img src="img/r5.jpg" alt="">
            </div>
            <div class="item">
                <img src="img/r6.jpg" alt="">
            </div>
            <div class="item">
                <img src="img/r7.jpg" alt="">
            </div>
        </div>
        <div class="buttons">
            <button id="prev"><img class="icon1" src="iconos/izquierda.png" alt=""></button>
            <button id="next"><img class="icon1" src="iconos/derecha.png" alt=""></button>
        </div>
        <ul class="dots">
            <li class="active"></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>


    <div class="pc-grid">
        <div id="item-0">&nbsp;</div>
        <div id="item-1">&nbsp;</div>
        <div id="item-2">
            <h3>Cuidado Integral</h3>
            <p>El Centro Gerontológico Integral es un espacio donde se brinda atención primaria a las y los adultos.</p>
        </div>
    </div>

    <div class="movil-grid">
        <div id="item-0"></div>
        <div id="item-1">&nbsp;</div>
        <div id="item-2">
            <h3>Cuidado Integral</h3>
            <p>El Centro Gerontológico Integral es un espacio donde se brinda atención primaria a las y los adultos.</p>
        </div>
    </div>
<?php

// Comprueba si la variable $exitoMessage no está vacía
if (!empty($exitoMessage)) {
    // Muestra el mensaje de éxito
    echo '<p class="alerta">' . $exitoMessage . '</p>';
    // Script para ocultar el mensaje después de 10 segundos
    echo '<script>
            setTimeout(function() {
                var alerta = document.querySelector(".alerta");
                alerta.style.display = "none";
            }, 10000); // 10000 milisegundos = 10 segundos
        </script>';
}
?>
    <!-- <div class="carrucel-texto">
        <div id="te-1" class="contain-text" >
            <h3>Talleres de Cocina</h3>
            <p>
                Intercambio de experiencias gastronómicas 
                y la promoción de una alimentación saludable.
            </p>
        </div>
        <div id="te-2" class="contain-text vi">
            <h3>Talleres de Danza</h3>
            <p>Este taller promueve la salud física,
                mejorando la movilidad y la coordinación.
            </p>
        </div>
        <div id="te-3" class="contain-text vi">
            <h3>Talleres de Pintura</h3>
            <p>Un espacio creativo donde los adultos mayores 
                pueden explorar su expresión artística a través de la pintura.
            </p>
        </div>
    </div> -->

    <footer>
        <p><b>2023</b></p>
        <p>Centro Gerontológico Integral</p>
    </footer>


    <script src="js/inicio.js"></script>
    <script src="js/navegacion.js"></script>

</body>
</html>