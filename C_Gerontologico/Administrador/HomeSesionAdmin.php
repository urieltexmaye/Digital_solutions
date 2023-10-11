<?php
require("../DevBackend/sesionActiveAdmin.php");
require("../DevBackend/getDatosUser.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
</head>
<body>
    <h1>Administrador</h1>
    <form action="../DevBackend/cerrarSesion.php" method="POST">
        <input class="logout-button" type="submit" value="Cerrar Sesión">
    </form>




    <form action="../DevBackend/Asistencia.php" method="POST">

    
<table border="1">

    <tr>
        <th>Nombre</th>
        <th>Danza</th>
        <th>Pintura</th>
        <th>Cocina</th>

        </tr>
        <?php 
        foreach ($datosUsuarios as $usuario) { ?>
        <tr>
            <th><input name="nombreP[]" type="text" style="border: none; outline:none" value="<?php echo $usuario['Nombre_Completo']; ?>" readonly> </th>
            <th><input name="nombreP[]" type="text" style="border: none; outline:none" value="<?php  $danza = $usuario['Danza']; if($danza == 1){ echo 'Inscrito';}else{ echo 'No inscrito';}?>" ></th>
            <th><input name="nombreP[]" type="text" style="border: none; outline:none" value="<?php  $pintura = $usuario['Pintura']; if($pintura == 1){ echo 'Inscrito';}else{ echo 'No inscrito';}?>"> </th>
            <th><input name="nombreP[]" type="text" style="border: none; outline:none" value="<?php $cocina = $usuario['Cocina']; if($cocina == 1){ echo 'Inscrito';}else{ echo 'No inscrito';}?>" readonly></th>

        </tr>
        
        
        <?php }?>
    
</table>

        
<input type="submit" value="Generar PDF">
        </form>



        <table border="1">
            <tr>
                <th>Nombre del usuario registrado</th>
                <th>Apellidos del usuario registrados</th>
            </tr>
            <?php 
        foreach ($datosUsuarios as $usuario) { ?>
            <tr>
                <th><input name="nombreP[]" type="text" style="border: none; outline:none" value="<?php echo $usuario['Nombre_Completo']; ?>" readonly> </th>
            </tr>
            <?php }?>
        </table>
        <input type="submit" value="Generar PDF">

    
</body>
</html>