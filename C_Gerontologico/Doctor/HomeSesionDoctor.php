<?php
require("../DevBackend/sesionActiveDoctor.php");
require("../DevBackend/SesionDoctor.php");
require("../DevBackend/buscar.php");


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor</title>
</head>
<body>
    <form action="../DevBackend/cerrarSesion.php" method="POST">
        <input type="submit" value="Cerrar Sesión">
    </form>
    <h1>Medico</h1>
    <div>
            <label for="">Nombre</label><br>
            <input type="text" value=" <?php echo $nombreCompleto?>">
        </div>
        <div>
            <label for="">Correo</label><br>
            <input type="text" value=" <?php echo $correo?>">
        </div>
        <h1>Buscador de datos de usuario</h1>
    <form method="GET" >
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" list="Lista"  name="nombre" required >
        <input type="submit" value="Buscar">
    </form>
    <datalist style="background-color: aqua;"  id="Lista">
        <option style="background-color:cadetblue" >Juan torres</option>
        <option >Ninel</option>
        <option >Raquel</option>
        <option >Juan Pedraza Pedraza</option>
    </datalist>
        <h1>Usuarios</h1>
        <form action="../DevBackend/Asistencia.php" method="POST">

    
        <table border="0.5">

            <tr>
                <th>Nombre</th>
                <th>Tipo de servicio</th>
                <th>Fecha</th>
                <th>Asistencia</th>
                </tr>
                <?php 
                foreach ($datosUsuarios as $usuario) { ?>
                <tr>
                    <th><input name="nombreP[]" type="text" style="border: none; outline:none" value="<?php echo $usuario['Nombre_Completo']; ?>" readonly> </th>
                    <th><input name="servicioM[]" type="text" style="border: none; outline:none" value="<?php echo $especialidad?>" readonly></th>
                    <th> <input name="fecha[]" type="date" style="border: none; outline:none" name="" value="<?php echo date("Y-m-d"); ?>" id=""></th>
                    <th style="display:flex;">
                    <input type="radio" name="asistencia[<?php echo $usuario['Id_user']; ?>]" value="1" id="asistio_<?php echo $usuario['Id_user']; ?>">Asistió
                    <input type="radio" name="asistencia[<?php echo $usuario['Id_user']; ?>]" value="0" id="no_asistio_<?php echo $usuario['Id_user']; ?>">No asistió
                    </th>

                </tr>
                
                
                <?php }?>
            
        </table>
    
    
    
        <p>        <?php 
    if (isset($_GET["nombre"])) {
        if (empty($datosUsuarios)) {
            // No se encontraron registros, muestra un mensaje
            $SinResultadosEncontrados = "Sin ningun resultado";
            echo $SinResultadosEncontrados;
        } else {
            // Hay registros encontrados, muestra la tabla
        }
    }?>       </p>



        
        <input type="submit" value="Guardar">
        </form>



            

        <!-- Agrega más campos de entrada según sea necesario -->
   
</body>
</html>

