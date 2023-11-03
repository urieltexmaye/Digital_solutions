<?php
//inicializa la sesion para traer datos
session_start();
// Recupera la variable de sesión "errores" 
//o establece un arreglo vacío si no existe
$errores = isset($_SESSION["errores"]) ? $_SESSION["errores"] : [];
$datos = isset($_SESSION["datos"]) ? $_SESSION["datos"] : [];
// Esto refresa los inputs XD.....//
unset($_SESSION["errores"]);
unset($_SESSION["datos"]);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/register_02.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel=" icon" type="image/ico" href="iconos/LogoIcon.png"/>
    <link href="https://fonts.googleapis.com/css2?family=Chela+One&family=Montserrat:wght@500&family=Quicksand&family=Roboto:wght@100&display=swap" rel="stylesheet">
    <title>Registro</title>
</head>
<body>
    
<div class="filtroMenu"></div>
<div id="barra_de_navegacion" class="pagina-actual"></div>


<div class="form_div">



<center><h1>Registro</h1></center>

<center><h4>Datos del usuario</h4></center>



<form action="DevBackend/create_user.php" method="POST">
    <div>
        <label for="name">Nombre(s)</label>
        <input type="text" name="name" id="name" placeholder="Ingrese su nombre" value="<?php echo isset($datos['name']) ? $datos['name'] : ''; ?>" required oninput="validateName(this)" oninput="limpiarError(this, nombreError)" onfocus="ocultarErrorEnFoco(this, nombreError)">
        <?php if (isset($errores["nombre"])): ?>
            <div id="nombreError" style='color: red;'><?php echo $errores["nombre"]; ?></div>
        <?php endif; ?>
    </div>

    <div>
        <label for="last_name">Apellidos</label>
        <input type="text" name="last_name" id="last_name" placeholder="Ingrese sus apellidos"  required oninput="validateLastName(this)" value="<?php echo isset($datos['last_name']) ? $datos['last_name'] : ''; ?>" oninput="limpiarError(this, apellidosError)" onfocus="ocultarErrorEnFoco(this, apellidosError)">
        <?php if (isset($errores["apellidos"])): ?>
            <div id="apellidosError" style='color: red;'><?php echo $errores["apellidos"]; ?></div>
        <?php endif; ?>
    </div>

    <div>
        <label for="number_phone">Teléfono</label>
        <input type="tel" name="number_phone" id="number_phone" placeholder="Ingrese un numero de teléfono" value="<?php echo isset($datos['number_phone']) ? $datos['number_phone'] : ''; ?>" oninput="limpiarError(this, telefonoError)" onfocus="ocultarErrorEnFoco(this, telefonoError)" required>
        <?php if (isset($errores["telefono"])): ?>
            <div id="telefonoError" style='color: red;'><?php echo $errores["telefono"]; ?></div>
        <?php endif; ?>

        <?php if (isset($errores["telefono2"])): ?>
            <div id="telefonoError" style='color: red;'><?php echo $errores["telefono2"]; ?></div>
        <?php endif; ?>


        <div id="custom-error1" style="color: red;"></div>
    </div>

    <div>
        <label for="email">Correo electrónico</label>

        <input type="email" name="email" id="email" placeholder="Introduzca una dirección de correo electrónico válida" value="<?php echo isset($datos['email']) ? $datos['email'] : ''; ?>" oninput="limpiarError(this, correoError)" onfocus="ocultarErrorEnFoco(this, correoError)" required>
        <?php if (isset($errores["correo"])): ?>
            <div id="correoError" style='color: red;'><?php echo $errores["correo"]; ?></div>
        <?php endif; ?>
        <?php if (isset($errores["correo2"])): ?>
            <div id="correoError"  style='color: red;'><?php echo $errores["correo2"]; ?></div>
        <?php endif; ?>
        <div id="email-error" style="color: red;"></div>
    </div>
    <center><div>Talleres</div></center>
    <div class="Talleres">
        <label for="Danza">Danza</label>
        <input type="checkbox" name="Danza" value="1" id="Danza" <?php echo (isset($datos['Danza']) && $datos['Danza'] == 1) ? 'checked' : ''; ?>>
        <label for="Pintura">Pintura</label>
        <input type="checkbox" name="Pintura" value="1" id="Pintura" <?php echo (isset($datos['Pintura']) && $datos['Pintura'] == 1) ? 'checked' : ''; ?>>
        <label for="Cocina">Cocina</label>
        <input type="checkbox" name="Cocina" value="1" id="Cocina" <?php echo (isset($datos['Cocina']) && $datos['Cocina'] == 1) ? 'checked' : ''; ?>>
    </div>

    <center><h4>Datos del tutor(a)</h4></center>

    <div>
        <label for="tutor_name">Nombre(s)</label>
        <input type="text" name="tutor_name" id="tutor_name" placeholder="Ingrese su nombre" required oninput="validateName(this)" value="<?php echo isset($datos['tutor_name']) ? $datos['tutor_name'] : ''; ?>" oninput="limpiarError(this, TnombreError)" onfocus="ocultarErrorEnFoco(this, TnombreError)">
        <?php if (isset($errores["Tnombre"])): ?>
            <div id="TnombreError" style='color: red;'><?php echo $errores["Tnombre"]; ?></div>
        <?php endif; ?>
    </div>

    <div>
        <label for="tutor_last_name">Apellidos</label>
        <input type="text" name="tutor_last_name" id="tutor_last_name" placeholder="Ingrese sus apellidos" required oninput="validateName(this)" value="<?php echo isset($datos['tutor_last_name']) ? $datos['tutor_last_name'] : ''; ?>" oninput="limpiarError(this, TapellidosError)" onfocus="ocultarErrorEnFoco(this, TapellidosError)">
        <?php if (isset($errores["Tapellidos"])): ?>
            <div id="TapellidosError" style='color: red;'><?php echo $errores["Tapellidos"]; ?></div>
        <?php endif; ?>
    </div>

    <div>
        <label for="tutor_number_phone">Teléfono</label>
        <input type="tel" name="tutor_number_phone" id="tutor_number_phone" placeholder=" Ingrese su numero de teléfono" required value="<?php echo isset($datos['tutor_number_phone']) ? $datos['tutor_number_phone'] : ''; ?>" oninput="limpiarError(this, TtelefonoError)" onfocus="ocultarErrorEnFoco(this, TtelefonoError)">
        <div id="phone-error1" style="color: red;"></div>
        <div id="custom-error2" style="color: red;"></div>
        <?php if (isset($errores["TelefonoDuplicado"])): ?>
            <div id="TtelefonoError" style='color: red;'><?php echo $errores["TelefonoDuplicado"]; ?></div>
        <?php endif; ?>
        <?php if (isset($errores["Ttelefono"])): ?>
            <div id="TtelefonoError" style='color: red;'><?php echo $errores["Ttelefono"]; ?></div>
        <?php endif; ?>
        <?php if (isset($errores["Ttelefono2"])): ?>
            <div id="TtelefonoError" style='color: red;'><?php echo $errores["Ttelefono2"]; ?></div>
        <?php endif; ?>

    </div>

    <div>
        <label for="tutor_direccion">Dirección</label>
        <input type="text" name="tutor_direccion" id="tutor_direccion" placeholder="Ingrese su dirección" required  value="<?php echo isset($datos['tutor_direccion']) ? $datos['tutor_direccion'] : ''; ?>" oninput="limpiarError(this, TdireccionError)" onfocus="ocultarErrorEnFoco(this, TdireccionError)">
        <?php if (isset($errores["Tdireccion"])): ?>
            <div id="TdireccionError" style='color: red;'><?php echo $errores["Tdireccion"]; ?></div>
        <?php endif; ?>
    </div>

    <div>
        <input type="submit" value="CREAR CUENTA">
    </div>
</form>
</div>



<footer>
    <p><b>2023</b></p>
    <p>Centro Gerontológico Integral</p>
</footer>

<script src="js/validations.js"></script>
<script src="js/Validate.js"></script>
<script src="js/navegacion.js"></script>




<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</body>
</html>