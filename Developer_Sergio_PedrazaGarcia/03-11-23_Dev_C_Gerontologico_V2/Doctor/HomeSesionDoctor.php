<?php
//Incluimos el archivo de autenticacion de usuarios
include("../DevBackend/AutenticationSesion.php");
//llamamos la funcion y colocamos a que rol debe de tener
//para tener acceso a la pagina
verificarAutenticacion("Doctor"); 
//Se hace referencia a el archivo
include("../DevBackend/GetData.php");
//nombramos una variable la funcion que queremos traer
$datosDoctor = GetDataDoctor($conn);
//incializa la variable
$datosUsuarios='';
//se envia el valor ingresado a la variable
if (isset($_POST["datosUsuarios"])) {
    //usamos el arhivop para buscar los usuarios
    include '../DevBackend/buscar_usuarios.php';
    //obtenemos los datos
    $datosUsuarios = json_decode($_POST["datosUsuarios"], true); 
}
//inicializa  las variables
$exitoMessage = "";
$errorMessage = "";
//verifica si se ah enviado o existe enn
//la sesion un menssaje de exito
if (isset($_SESSION["exito"])) {
        //coloca el valor que contiene exito
    $exitoMessage = $_SESSION["exito"];
    //limpia el valor de exito
    unset($_SESSION["exito"]);
}
//verifica si se ah enviado o existe enn
//la sesion un menssaje de error
if (isset($_SESSION["errorDuplicate"])) {
    //coloca el valor que contiene errorDuplicate
    $errorMessage = $_SESSION["errorDuplicate"];
    //limpia el valor de error
    unset($_SESSION["errorDuplicate"]);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo.png" />
    <link rel=" icon" type="image/ico" href="../iconos/LogoIcon.png"/>
    <link rel="stylesheet" href="../CSS/doctor.css">

    <title>Doctor</title>
</head>
<body>

<div class="filtroMenu"></div>

<div id="barra_de_navegacion" class="pagina-actual"></div></div>
<!-- <a href="../DevBackend/cerrarSesion.php">SALIR</a> -->
<div class="container">
    <!-- <h1 class="tituloPrincipal">Médico</h1>
    <div class="infoDoctor">
        <label for="" class="labelNombre">Nombre</label><br>
        <input type="text" class="inputNombre" value=" <?php echo $datosDoctor['nombreCompleto']?>">
    </div>
    <div class="infoDoctor">
        <label for="" class="labelEspecialidad">Especialidad</label><br>
        <input type="text" class="inputEspecialidad" value=" <?php echo $datosDoctor['especialidad']?>">
    </div> -->
    <?php
    //Si exite un valor recibido en exitoMensaje
    if (!empty($exitoMessage)) {
        //imprim,e el valor y se le da un tiempo de aparicion
        echo '<p class="alerta">' . $exitoMessage . '</p>';
        echo '<script>
        
                    setTimeout(function() {
                    var alerta = document.querySelector(".alerta");
                    alerta.style.display = "none";
                    }, 7500); 
                </script>';
    }
    //Si exite un valor recibido en errorMensaje
    if (!empty($errorMessage)) {
         //imprim,e el valor y se le da un tiempo de aparicion
        echo '<p class="alerta_asistencia">' . $errorMessage . '</p>';
        echo '<script>
                    setTimeout(function() {
                    var alerta = document.querySelector(".alerta");
                    alerta.style.display = "none";
                    }, 7500); 
                </script>';
    }
    
    ?>
    <!-- <h1 class="tituloBuscador">Buscador de datos de usuario</h1> -->
    <form id="search-form">
        <input type="text" id="search" class="inputBuscador" placeholder="Buscar nombre del paciente" oninput="validateSearch(this)">
    </form>
    <div id="results"></div>
    <form id="user-form" action="../DevBackend/asistencia.php" method="POST">
        <table class="tablaPrincipal">
            <tr>
                <th hidden class="idUsuario">Id Usuario</th>
                <th class="nombrePaciente">Nombre del paciente</th>
                <th class="tipoServicio">Tipo de servicio</th>
                <th class="fecha">Fecha</th>
                <th class="asistencia">Asistencia</th>
            </tr>
            <tbody id="user-data"></tbody>
        </table>
        <center><input type="submit" class="btnGuardar" value="Guardar"></center>
    </form>
</div>
<script>
    const searchInput = document.getElementById("search");
    const userDataBody = document.getElementById("user-data");
    let userData = [];

    searchInput.addEventListener("input", function() {
        const query = searchInput.value;
        
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../DevBackend/buscar_usuarios.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                userData = JSON.parse(xhr.responseText);
                populateUserTable(userData);
            }
        };
        xhr.send("query=" + query);
    });

    const form = document.getElementById("user-form");
    
    form.addEventListener("submit", function(e) {
        e.preventDefault(); // No envía el formulario por defecto
        
        
        const selectedRadio = document.querySelector("input[name='asistencia']:checked");
        
        if (selectedRadio) {
            // Obtenien la fila del usuario seleccionado -> ____ <-
            const userRow = selectedRadio.closest("tr");
            // Envia solo el usuario seleccionado   --->user
            form.innerHTML = ""; // Borrar otros datos XXXXXXX
            form.appendChild(userRow);
            form.submit(); // Envia el formulario >>>>>>>>
        }
    });

    function populateUserTable(data) {
        userDataBody.innerHTML = "";
        data.forEach(user => {
            const row = document.createElement("tr");
            // si se puede le pones un id a los inputs para quitarles los bordes en una hoja de estilos
            //y le quitas el style a los inputs porfas si ves esto XD.....
            row.innerHTML = `
            
                <td hidden><input name="id" type="text" value="${user.Id_user}"></td>
                <td><input style="border: none; outline: none;" name="Nombre" type="text" value="${user.Nombre} ${user.Apellidos}" readonly></td>
                <td>            
                    <input style="border: none; outline: none;"  type="text" name="servicio" value="<?php $especialidad = $datosDoctor['especialidad']; if($especialidad == 'Fisio Terapeuta'){ echo 'Fisico';} if($especialidad == 'Médico'){ echo 'Médico';} if($especialidad == 'Psicologo'){echo 'Psicológico';}?>" readonly>
                </td>
                <td><input name="fecha" type="date" style="border: none; outline:none" value="<?php echo date("Y-m-d"); ?>" id=""></td>
                <td>
                    <input type="radio" name="asistencia" value="1" id="asistio_${user.Id_user}">Asistió
                    <input type="radio" name="asistencia" value="0" id="no_asistio_${user.Id_user}">No asistió
                </td>
            `;
            userDataBody.appendChild(row);
        });
    }
</script>
<script>
    // cargar la página con datos precagados :)
    window.addEventListener("load", function() {
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../DevBackend/buscar_usuarios.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                userData = JSON.parse(xhr.responseText);
                populateUserTable(userData);
            }
        };
        xhr.send("query=");
    });
</script>
<script src="../js/Validate.js"></script>
<script src="../js/navegacion.js"></script>

</body>
</html>
