<?php
// Incluye el archivo de Autenticación de Sesión 
//para gestionar la autenticación de usuarios
include("../DevBackend/AutenticationSesion.php");
// Verifica la autenticación del usuario como "Admin"
verificarAutenticacion("Admin");
// Incluye el archivo GetData.php que contiene 
//funciones para obtener datos de la base de datos.
include("../DevBackend/GetData.php");
$datosUsuarios = GetDataAllUser($conn);
$datosAsistencia = GetDataServices($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo.png" />
    <link rel=" icon" type="image/ico" href="../iconos/LogoIcon.png"/>
    <link rel="stylesheet" href="../CSS/admin.css">
    
    <title>Administrador</title>
</head>
<body>


<div class="filtroMenu"></div>
<div id="barra_de_navegacion" class="pagina-actual"></div>
<!--Esto no va por que genera errores el administrador no lleva barra de navegacion :) -->
<div class="filtroMenu"></div> 


<div class="centered-content">
        <div class="btn-group">
            <div id="btn1" class="btn">Usuarios registrados </div>
            <div id="btn2" class="btn">Talleres</div>
            <div id="btn3" class="btn">Asistencia</div>
        </div>
        <!--Inicio del contenido 1-->
        <div id="content1" class="content">
        <h1>Usuarios registrodos </h1>
        
    <table class="deslizar t1" border="1">
    <tr>
        <th>Nombre</th>
        <th>Apellidos</th>
    </tr>
        <?php 
        // Inicio de un bucle foreach que recorre el array $datosUsuarios
        foreach ($datosUsuarios as $usuario) { ?>
    <tr>
            <td><input name="nombre[]" type="text" style="border: none; outline:none" value="<?php echo $usuario['Nombre']; ?>" readonly> </td>
            <td><input name="Apellidos[]" type="text" style="border: none; outline:none" value="<?php echo $usuario['Apellidos']; ?>" readonly> </td>
    </tr>
        <?php }?>
    
 </table>
 <center>
 <form method="post" action="../DevBackend/Pdf.php" target="_blank">
        <button type="submit" class="btnPDF" name="generate_pdf" >Generar PDF</button>
 </form>
 </center>
        </div>
        <!--Inicio del contenido 2-->
        <div id="content2" class="content">
        <h1>Talleres</h1>

 <table class="responsive deslizar" border="1">
 <tr>
    <th>Nombre del cliente</th>
    <th>Danza</th>
    <th>Pintura</th>
    <th>Cocina</th>

    </tr>
    <?php 
    foreach ($datosUsuarios as $usuario) { ?>
    <tr>
        <td class="nowrap"><input name="nombreP[]" type="text" style="border: none; outline:none" value="<?php $nombre = $usuario['Nombre']; $apellidos =$usuario['Apellidos'];   echo "$nombre $apellidos" ; ?>" readonly> </td>
        <td><input name="nombreP[]" type="text" style="border: none; outline:none" value="<?php  $danza = $usuario['Danza']; if($danza == 1){ echo 'Está inscrito';}else{ echo 'No inscrito';}?>" ></t>
        <td><input name="nombreP[]" type="text" style="border: none; outline:none" value="<?php $cocina = $usuario['Cocina']; if($cocina == 1){ echo 'Está inscrito';}else{ echo '';}?>" readonly></td>
        <td><input name="nombreP[]" type="text" style="border: none; outline:none" value="<?php  $pintura = $usuario['Pintura']; if($pintura == 1){ echo 'Está inscrito';}else{ echo '';}?>"> </t>

    </tr>
    
    
    <?php }?>

 </table class="deslizar">
 <center>
 <form method="post" action="../DevBackend/Pdf.php" target="_blank">
        <button type="submit" class="btnPDF" name="talleres_PDF" >Generar PDF</button>
    </form>
 </center>

        </div>
        <!--Inicio del contenido 3-->
        <div id="content3" class="content">
        <h1>Asistencias</h1>

 <table border="1">

 <tr>
    <th>Nombre del cliente</th>
    <th>Servicio</th>
    <th>Fecha</th>
    <th>Asistencia</th>

    </tr>
    <?php 
    foreach ($datosAsistencia as $asistencia) { ?>
    <tr>
        <td><input name="nombreP[]" type="text" style="border: none; outline:none" value="<?php echo $asistencia['NombreUsuario']; ?>" readonly> </td>
        <td><input name="nombreP[]" type="text" style="border: none; outline:none" value="<?php  echo $asistencia['Tipo_Sevicio']; ?>" ></td>
        <td><input name="nombreP[]" type="date" style="border: none; outline:none" value="<?php echo $asistencia['FechaHora']; ?>" readonly></td>        
        <td><input name="nombreP[]" type="text" style="border: none; outline:none" value="<?php $true = $asistencia['Asistencia']; if($true==1){ echo'Asistió';}else{echo 'No asistió';} ?>" readonly></td>

    </tr>
    
    
    <?php }?>

 </table>
<center>
 <form method="post" action="../DevBackend/Pdf.php" target="_blank">
        <button type="submit" class="btnPDF" name="asistencia_PDF" >Generar PDF</button>
    </form>
 </center>
        

    <form action="../DevBackend/Asistencia.php" method="POST">
    </form>
        </div>
</div>

     <!--Estilo de los botones para seleccion-->   
    <style>

        .btn-group {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            border-radius: 5px;
        }
        .btn {
            padding: 10px 20px;
            border: 0px solid #ccc;
            
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color:#B7DCFF  ;
        }
        .btn.active {
            background-color: #007bff;
            color: white;
        }
        .content {
            margin-top: 20px;
            display: none;
        }
        .content.active {
            display: block;
        }
        .centered-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>

    <!--Para que oculte el contenido de cada boton-->
    <script>
        document.getElementById('btn1').addEventListener('click', function() {
            setActiveButton('btn1');
            setActiveContent('content1');
        });
        document.getElementById('btn2').addEventListener('click', function() {
            setActiveButton('btn2');
            setActiveContent('content2');
        });
        document.getElementById('btn3').addEventListener('click', function() {
            setActiveButton('btn3');
            setActiveContent('content3');
        });
        
        function setActiveButton(id) {
            const buttons = document.getElementsByClassName('btn');
            for (let i = 0; i < buttons.length; i++) {
                buttons[i].classList.remove('active');
            }
            document.getElementById(id).classList.add('active');
        }
        
        function setActiveContent(id) {
            const contents = document.getElementsByClassName('content');
            for (let i = 0; i < contents.length; i++) {
                contents[i].classList.remove('active');
            }
            document.getElementById(id).classList.add('active');
        }
        </script>
<script src="../js/admin.js"></script>
<script src="../js/Validate.js"></script>
<script src="../js/navegacion.js"></script>


</body>
</html>