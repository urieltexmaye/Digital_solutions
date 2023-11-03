<?php
session_start();

// Verificar si la variable de sesión "error_message" está definida
if (isset($_SESSION["error_message"])) {
    $error_message = $_SESSION["error_message"];
    // Limpia la variable de sesión para que el mensaje de error no se muestre nuevamente en futuras visitas a la página
    unset($_SESSION["error_message"]);
} else {
    $error_message = ""; // Si no hay mensaje de error, inicialízalo como una cadena vacía
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/login.css">
    <link rel=" icon" type="image/ico" href="iconos/LogoIcon.png"/>
    <script src="js/validations.js"></script>

    <title>Iniciar sesión</title>
</head>
<body>

<div class="filtroMenu"></div>

    <div id="barra_de_navegacion" class="pagina-actual"></div>



    <div class="centrar">
        <div class="Form_Div">
            <h1><b>Inicio de sesión</b></h1>
            <form action="DevBackend/loginController.php" method="POST">
                
                <label for="telefono">Teléfono</label>
                <br>
                <input type="text" name="telefono" id="telefono" placeholder="Ingrese su número de teléfono" required oninput="PhoneValidation(this)">    
                <?php if (!empty($error_message)): ?>
                    <p style="color: red;"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <br>
                <div>
                    <br>
                    <input type="submit" value="Iniciar sesión">
                </div>
            </form>
        </div>
    </div>

    <script src="js/navegacion.js"></script>

</body>
</html>
