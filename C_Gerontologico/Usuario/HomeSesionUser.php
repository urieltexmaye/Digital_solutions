<?php
require("../DevBackend/sesionActiveUser.php");
require("../DevBackend/SesionUser.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <style>
        /* Estilos en línea para simplificar, puedes moverlos a tu archivo CSS */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

header {
    background-color: #fafafa;
    color: #fff;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
}

header a {
    color: #1a1919;
    text-decoration: none;
    margin-left: 20px;
}

header a:hover {
    text-decoration: underline;
}

.logo img {
    max-width: 200px; /* Ajusta el tamaño de tu logo */
}
.logout-form {
            display: inline-block;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .logout-button {
            background-color: #ff4d4d;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }

        .logout-button:hover {
            background-color: #ff3333;
        }

    </style>

<header>
        <div class="logo">
            <img src="../Imagenes/Logo.png" alt="Logo de tu sitio web">
        </div>
        <nav>
            <a href="#">Inicio</a>
            <a href="register.html">Regístrate</a>
            <a href="login.php">Iniciar Sesión</a>
            <a href="servicios.html">Servicios</a>
            <a href="talleres.html">Talleres</a>
            <a href="Acerca_de.html">Acerca de</a>
            <form action="../DevBackend/cerrarSesion.php" method="POST">
            <input class="logout-button" type="submit" value="Cerrar Sesión">
        </form>
    <div>
        </nav>
    </header>

        <div>
            <form action="../DevBackend/UpdateUser.php" method="POST">
            <div>
                <input type="text" value="<?php echo $id ?>" name="id" hidden>
                <br>
        <label for="nombre">Nombre</label><br>
        <input type="text" id="nombre" name="nombre" value="<?php echo $nombreCompleto ?>">
    </div>
    <div>
        <label for="telefono">Teléfono</label><br>
        <input type="text" id="telefono" name="telefono" value="<?php echo $telefono ?>">
    </div>
    <div>
        <label for="correo">Correo</label><br>
        <input type="text" id="correo" name="correo" value="<?php echo $correoElectronico ?>">
    </div>
    <h4>Talleres</h4>
    <div>
        <label for="danza">Danza</label>
        <input type="checkbox" id="danza" name="danza" <?php echo $Danza == 1 ? 'checked' : ''; ?> value="1">
        <label for="pintura">Pintura</label>
        <input type="checkbox" id="pintura" name="pintura" <?php echo $Pintura == 1 ? 'checked' : ''; ?> value="1">
        <label for="cocina">Cocina</label>
        <input type="checkbox" id="cocina" name="cocina" <?php echo $Cocina == 1 ? 'checked' : ''; ?> value="1">
    </div>
    <div>
        <label for="nombre_tutor">Nombre Tutor</label><br>
        <input type="text" id="nombre_tutor" name="nombre_tutor" value="<?php echo $NombreT ?>">
    </div>
    <div>
        <label for="apellidos_tutor">Tutor Apellidos</label><br>
        <input type="text" id="apellidos_tutor" name="apellidos_tutor" value="<?php echo $ApellidosT ?>">
    </div>
    <div>
        <label for="telefono_tutor">Tutor Teléfono</label><br>
        <input type="text" id="telefono_tutor" name="telefono_tutor" value="<?php echo $TelefonoT ?>">
    </div>
    <div>
        <label for="direccion_tutor">Tutor Dirección</label><br>
        <input type="text" id="direccion_tutor" name="direccion_tutor" value="<?php echo $DireccionT ?>">
    </div>
                <input type="submit" value="Actualizar">

            </form>
        </div>



        


    </div>
</body>
</html>
