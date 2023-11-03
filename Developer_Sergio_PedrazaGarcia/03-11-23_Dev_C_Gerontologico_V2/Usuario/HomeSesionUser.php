<?php
include("../DevBackend/AutenticationSesion.php");
verificarAutenticacion("user"); 
include("../DevBackend/GetData.php");
$datosUser = GetDataUser($conn);

require("b-navegacion.php");

$errores = isset($_SESSION["errores"]) ? $_SESSION["errores"] : [];
$datos = isset($_SESSION["datos"]) ? $_SESSION["datos"] : [];
// Esto refresa los inputs XD.....//
unset($_SESSION["errores"]);
unset($_SESSION["datos"]);



$exitoMessage = "";
$NoUpdateMessage = "";
$ErrorUpdateMessage = "";

if (isset($_SESSION["exito"])) {
    $exitoMessage = $_SESSION["exito"];
    unset($_SESSION["exito"]);
}
if (isset($_SESSION["NoUpdate"])) {
    $NoUpdateMessage = $_SESSION["NoUpdate"];
    unset($_SESSION["NoUpdate"]);
}
if (isset($_SESSION["ErrorUpdate"])) {
    $ErrorUpdateMessage = $_SESSION["ErrorUpdate"];
    unset($_SESSION["ErrorUpdate"]);
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/inicio.css">
    <link rel=" icon" type="image/ico" href="../iconos/LogoIcon.png"/>
    <link rel="stylesheet" href="../CSS/user.css">

    <title>Actualizar Perfil</title>
</head>
<body>




  <!--  <form action="../DevBackend/cerrarSesion.php" method="POST">
                <input class="logout-button" type="submit" value="Cerrar Sesión">
            </form>-->


        <div class="contenido">
        <center><h1>Actualizar Perfil</h1></center>
        <center><h4>Datos del usuario</h4></center>
            <form action="../DevBackend/UpdateUser.php" method="POST">
                <!--ponerle un id para este mensaje y ponerl en una hoja de estilo-->
            <p style="color: green;"><?php echo $exitoMessage; ?></p>
            <p style="color: red;"><?php echo $NoUpdateMessage; ?></p>
            <p style="color: red;"><?php echo $ErrorUpdateMessage; ?></p>

            <div>
                <input type="text" value="<?php echo $datosUser['id'] ?>" name="id" hidden>
                <br>
                <label for="nombre">Nombre(s)</label><br>
                <input type="text" id="name" name="nombre" value="<?php echo $datosUser['nombre'] ?>" oninput="validateName(this)" oninput="limpiarError(this, nombreError)" onfocus="ocultarErrorEnFoco(this, nombreError)">
                <?php if (isset($errores["nombre"])): ?>
                    <div id="nombreError" style='color: red;'><?php echo $errores["nombre"]; ?></div>
                <?php endif; ?>
            </div>
            <div>

                <label for="nombre">Apellidos</label><br>
                <input type="text" id="name" name="apellidos" value="<?php echo $datosUser['apellidos'] ?>" oninput="validateName(this)" oninput="limpiarError(this, nombreError)" onfocus="ocultarErrorEnFoco(this, nombreError)">
                <?php if (isset($errores["apellidos"])): ?>
                    <div id="nombreError" style='color: red;'><?php echo $errores["apellidos"]; ?></div>
                <?php endif; ?>
            </div>

            <div>
                <label for="telefono">Teléfono</label><br>
                <input type="tel" id="number_phone" name="telefono" value="<?php echo $datosUser['telefono'] ?>" oninput="limpiarError(this, telefonoError)" onfocus="ocultarErrorEnFoco(this, telefonoError)">
                <?php if (isset($errores["telefono"])): ?>
                        <div id="telefonoError" style='color: red;'><?php echo $errores["telefono"]; ?></div>
                <?php endif; ?>
                <?php if (isset($errores["telefono2"])): ?>
                    <div id="telefonoError" style='color: red;'><?php echo $errores["telefono2"]; ?></div>
                <?php endif; ?>
                <div id="custom-error1" style="color: red;"></div>
            </div>

    <div>
        <label for="correo">Correo electrónico</label><br>
        <input type="email" id="email" name="correo" value="<?php echo $datosUser['correoElectronico'] ?>" oninput="limpiarError(this, correoError)" onfocus="ocultarErrorEnFoco(this, correoError)">
        <?php if (isset($errores["correo"])): ?>
            <div id="correoError" style='color: red;'><?php echo $errores["correo"]; ?></div>
        <?php endif; ?>
        <?php if (isset($errores["correo2"])): ?>
            <div id="correoError" style='color: red;'><?php echo $errores["correo2"]; ?></div>
        <?php endif; ?>
        <div id="email-error" style="color: red;"></div>

    </div>
    <center>Talleres</center>
    <br>
    <div class="chekbox">
        <label for="danza">Danza</label>
        <input type="checkbox" id="danza" name="danza" <?php echo $datosUser['Danza'] == 1 ? 'checked' : ''; ?> value="1">
        <label for="pintura">Pintura</label>
        <input type="checkbox" id="pintura" name="pintura" <?php echo $datosUser['Pintura'] == 1 ? 'checked' : ''; ?> value="1">
        <label for="cocina">Cocina</label>
        <input type="checkbox" id="cocina" name="cocina" <?php echo $datosUser['Cocina'] == 1 ? 'checked' : ''; ?> value="1">
    </div>
    <center><h4>Datos del tutor(a)</h4></center>
    <div>
        <label for="nombre_tutor">Nombre(s)</label><br>
        <input type="text" id="tutor_name" name="nombre_tutor" value="<?php echo $datosUser['NombreT'] ?>" oninput="validateName(this)" oninput="limpiarError(this, nombretError)" onfocus="ocultarErrorEnFoco(this, nombretError)">
        <?php if (isset($errores["Tnombre"])): ?>
            <div id="nombretError" style='color: red;'><?php echo $errores["Tnombre"]; ?></div>
        <?php endif; ?>
    </div>
    <div>
        <label for="apellidos_tutor">Apellidos</label><br>
        <input type="text" id="apellidos_tutor" name="apellidos_tutor" value="<?php echo $datosUser['ApellidosT'] ?>" oninput="validateLastName(this)" oninput="limpiarError(this, apellidostError)" onfocus="ocultarErrorEnFoco(this, apellidostError)">
        <?php if (isset($errores["Tapellidos"])): ?>
            <div id="apellidostError" style='color: red;'><?php echo $errores["Tapellidos"]; ?></div>
        <?php endif; ?>
    </div>
    <div>
        <label for="telefono_tutor">Teléfono</label><br>
        <input type="text" id="tutor_number_phone" name="telefono_tutor" value="<?php echo $datosUser['TelefonoT'] ?>"  oninput="limpiarError(this, telefonotError)" onfocus="ocultarErrorEnFoco(this, telefonotError)">
        <?php if (isset($errores["Ttelefono"])): ?>
            <div id="telefonotError" style='color: red;'><?php echo $errores["Ttelefono"]; ?></div>
        <?php endif; ?>
        <?php if (isset($errores["TelefonoDuplicado"])): ?>
            <div id="TtelefonoError" style='color: red;'><?php echo $errores["TelefonoDuplicado"]; ?></div>
        <?php endif; ?>
        <?php if (isset($errores["Ttelefono2"])): ?>
            <div id="TtelefonoError" style='color: red;'><?php echo $errores["Ttelefono2"]; ?></div>
        <?php endif; ?>
        <div id="custom-error2" style="color: red;"></div>

    </div>
    <div>
        <label for="direccion_tutor">Dirección</label><br>
        <input type="text" id="direccion_tutor" name="direccion_tutor" value="<?php echo $datosUser['DireccionT'] ?>" oninput="limpiarError(this, direccionError)" onfocus="ocultarErrorEnFoco(this, direccionError)">
        <?php if (isset($errores["Tdireccion"])): ?>
            <div id="direccionError" style='color: red;'><?php echo $errores["Tdireccion"]; ?></div>
        <?php endif; ?>
    </div>
                <input type="submit" value="Actualizar">

            </form>
        </div>
        <script src="../js/validations.js"></script>
        <script src="../js/Validate.js"></script>
        <script src="::/js/navegacion.js"></script>




        <script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>



    </div>
</body>
</html>
