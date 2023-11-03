

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/inicio.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chela+One&family=Montserrat:wght@500&family=Quicksand&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>
            <img src="img/logo.png" class="logo">
            <ul class="media-menu">
                <li><a href="index.php">INICIO</a></li>
                <?php
                session_start();
                
                    if (!isset($_SESSION["telefono"]) ) {
                        echo '<li><a href="register.php">REGISTRARME</a></li>';
                        echo '<li><a href="login.php">INICIAR SESIÓN</a></li>';
                        
                    }
                ?>
                
                <li><a href="talleres.html">TALLERES</a></li>
                <li><a href="servicios.html">SERVICIOS</a></li>
                <li><a href="Acerca_de.html">ACERCA DE</a></li>
                <?php
                
                if (isset($_SESSION["telefono"])) {
                    
                    if ($_SESSION["Rol"] === 'user') {
                        echo '<li id="perfil-item">
                        <a class="bottom"  style="border-bottom: none">PERFIL <img src="img/perfil.png" alt=""></a>
                        <ul class="perfil-options">
                            <li><a href="Usuario/HomeSesionUser.php">EDITAR PERFIL</a></li>
                            <li><a href="DevBackend/cerrarSesion.php">CERRAR SESIÓN</a></li>
                        </ul>
                    </li>';
                    } elseif ($_SESSION["Rol"] === 'Doctor') {
                        echo '<li><a href="Doctor/HomeSesionDoctor.php">PERFIL</a></li>';
                    }
                    elseif($_SESSION["Rol"] === 'Admin'){
                        echo '<li><a href="Administrador/HomeSesionAdmin.php">PERFIL</a></li>';
                    }
                    // echo '<li><a href="DevBackend/cerrarSesion.php">SALIR</a></li>';
                }
                ?>

            </ul>
            <label class="hamburger">
                <input type="checkbox" onclick="toggleMenu()">
                <svg viewBox="0 0 32 32">
                <path class="line line-top-bottom" d="M27 10 13 10C10.8 10 9 8.2 9 6 9 3.5 10.8 2 13 2 15.2 2 17 3.8 17 6L17 26C17 28.2 18.8 30 21 30 23.2 30 25 28.2 25 26 25 23.8 23.2 22 21 22L7 22"></path>
                <path class="line" d="M7 16 27 16"></path>
                </svg>
            </label>
            <ul class="menu">
                <li><a href="index.php">INICIO</a></li>
                <?php
                    if (!isset($_SESSION["telefono"])  ) {
                        echo '<li><a href="register.php">REGISTRARME</a></li>';
                        echo '<li><a href="login.php">INICIAR SESIÓN</a></li>';
                        
                    }
                ?>
                <li><a href="talleres.html">TALLERES</a></li>
                <li><a href="servicios.html">SERVICIOS</a></li>
                <li><a href="Acerca_de.html">ACERCA DE</a></li>
                <?php
                if (isset($_SESSION["telefono"])) {
                    if ($_SESSION["Rol"] === 'user') {
                        echo '<li><a href="Usuario/HomeSesionUser.php">EDITAR PERFIL</a></li>';
                    } elseif ($_SESSION["Rol"] === 'Doctor') {
                        echo '<li><a href="Doctor/HomeSesionDoctor.php">PERFIL</a></li>';
                    }
                    elseif($_SESSION["Rol"] === 'Admin'){
                        echo '<li><a href="Administrador/HomeSesionAdmin.php">PERFIL</a></li>';
                    }
                    echo '<li><a href="DevBackend/cerrarSesion.php">CERRAR SESIÓN</a></li>';
                }
                ?>
            </ul>
        </nav>
    </header> 
    <script src="js/navegacion.js"></script>
</body>
</html>
