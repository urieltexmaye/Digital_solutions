<?php

require("conexion.php"); // Se establece la conexión a la base de datos.
session_start(); // Inicia la sesión.

$errores = []; // Un arreglo para almacenar errores.
$datos = $_POST; // Obtiene los datos enviados mediante POST.
$msg = []; // Un arreglo para mensajes.

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Obtiene los datos del formulario.
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $danza = isset($_POST['danza']) ? 1 : 0;
    $pintura = isset($_POST['pintura']) ? 1 : 0;
    $cocina = isset($_POST['cocina']) ? 1 : 0;
    $nombre_tutor = $_POST['nombre_tutor'];
    $apellidos_tutor = $_POST['apellidos_tutor'];
    $telefono_tutor = $_POST['telefono_tutor'];
    $direccion_tutor = $_POST['direccion_tutor'];
    $id = $_POST['id'];

    // Validaciones
    if (empty($nombre)) {
        $errores["nombre"] = "Este campo es obligatorio";
    }
    if (empty($apellidos)) {
        $errores["apellidos"] = "Este campo es obligatorio";
    }

    if (!preg_match("/^\d{10}$/", $telefono)) {
        $errores["telefono"] = "El teléfono debe contener 10 dígitos numéricos.";
    }

    // Comprueba si el teléfono ya está en uso por otro usuario.
    $sqlVerificar = "SELECT COUNT(*) as count FROM (
        SELECT Teléfono FROM DatosUsuario WHERE Teléfono = '$telefono' AND Id_user != '$id'
        UNION ALL SELECT Teléfono FROM DatosAdministrador
        UNION ALL SELECT Teléfono FROM DatosMedicos) AS AllPhones WHERE Teléfono = '$telefono'";
    $result = $conn->query($sqlVerificar);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalRegistros = intval($row["count"]);

        if ($totalRegistros > 0) {
            $errores["telefono2"] = "Ese número ya está en uso.";
        }
    }

    //Valida que solo sea hotmail o gmail
    if (!preg_match('/@(gmail|hotmail)\.com$/', $correo)) {
        $errores["correo"] = "El correo electrónico ingresado no es válido.";
    }

    // Comprueba si el correo ya está en uso por otro usuario.
    $CorreoValidate = "SELECT COUNT(*) as count FROM DatosUsuario WHERE CorreoElectrónico = '$correo' AND Id_user != '$id'";
    $resultValidate = $conn->query($CorreoValidate);
    if ($resultValidate->num_rows > 0) {
        $rowCorreo = $resultValidate->fetch_assoc();
        $TotalCorreo = intval($rowCorreo["count"]);

        if ($TotalCorreo > 0) {
            $errores["correo2"] = "El correo ya está en uso.";
        }
    }

    if (empty($nombre_tutor)) {
        $errores["Tnombre"] = "Este campo es obligatorio";
    }
    if (empty($apellidos_tutor)) {
        $errores["Tapellidos"] = "Este campo es obligatorio";
    }
    if (!preg_match("/^\d{10}$/", $telefono_tutor)) {
        $errores["Ttelefono"] = "El teléfono del tutor debe contener 10 dígitos numéricos.";
    }

    // Comprueba si el teléfono del tutor ya está en uso por otros usuarios.
    $Tutor_telefonoM = "SELECT COUNT(*) as count FROM (
        SELECT Teléfono FROM DatosMedicos WHERE Teléfono = '$telefono_tutor'
        UNION ALL SELECT Teléfono FROM DatosAdministrador) AS AllPhones WHERE Teléfono = '$telefono_tutor'";
    $resultNumberM = $conn->query($Tutor_telefonoM);
    if ($resultNumberM->num_rows > 0) {
        $rowM = $resultNumberM->fetch_assoc();
        $totalRegistrosNumberM = intval($rowM["count"]);

        if ($totalRegistrosNumberM > 0) {
            $errores["Ttelefono3"] = "Este número no está disponible.";
        }
    }

    // Comprueba si el teléfono del tutor ya está asociado a otros usuarios.
    $Tutor_telefono = "SELECT COUNT(*) as count FROM DatosUsuario WHERE Tutor_Teléfono = '$telefono_tutor'";
    $resultNumber = $conn->query($Tutor_telefono);
    if ($resultNumber->num_rows > 0) {
        $rowT = $resultNumber->fetch_assoc();
        $totalRegistrosNumber = intval($rowT["count"]);

        if ($totalRegistrosNumber > 2) {
            $errores["Ttelefono2"] = "El número del tutor ya existe.";
        }
    }

    if (empty($direccion_tutor)) {
        $errores["Tdireccion"] = "Este campo es obligatorio";
    }

    if (empty($errores)) {
        // Si no hay errores, se procede a actualizar los datos en la base de datos.
        $sql = "UPDATE datosusuario SET 
            Nombre= '$nombre',
            Apellidos= '$apellidos',
            Teléfono = '$telefono',
            CorreoElectrónico = '$correo',
            Danza = $danza,
            Pintura = $pintura,
            Cocina = $cocina,
            Tutor_Nombre = '$nombre_tutor',
            Tutor_apellidos = '$apellidos_tutor',
            Tutor_Teléfono = '$telefono_tutor',
            Tutor_Dirección = '$direccion_tutor'
            WHERE Id_user = '$id'";
        
        $result = $conn->query($sql);

        if ($conn->affected_rows > 0) {
            // Si la actualización fue exitosa, se almacena un mensaje de éxito y se redirige a la mima pagina.
            $_SESSION["telefono"] = $telefono;
            $_SESSION["exito"] = "Los datos se han actualizado con éxito.";
            header("Location: ../Usuario/HomeSesionUser.php");
        } else {
            // Si no se realizaron cambios, se almacena un mensaje de información y se redirige a la mima pagina.
            $_SESSION["NoUpdate"] = "No se realizaron cambios en los datos.";
            header("Location: ../Usuario/HomeSesionUser.php");
        }
    } else {
        // Si hay errores, se almacenan los errores y los datos ingresados para mostrar en la página.
        $_SESSION["errores"] = $errores;
        $_SESSION["datos"] = $datos;
        $_SESSION["ErrorUpdate"] = "Verifica tus datos.";
        header("Location: ../Usuario/HomeSesionUser.php");
        exit();
    }
} else {
    $errores = "Los campos están vacíos";
}

$conn->close(); // Cierra la conexión a la base de datos.



/**<?php

require("conexion.php");
session_start();

$errores = [];
$datos = $_POST; 

$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$danza = isset($_POST['danza']) ? 1 : 0;
$pintura = isset($_POST['pintura']) ? 1 : 0;
$cocina = isset($_POST['cocina']) ? 1 : 0;
$nombre_tutor = $_POST['nombre_tutor'];
$apellidos_tutor = $_POST['apellidos_tutor'];
$telefono_tutor = $_POST['telefono_tutor'];
$direccion_tutor = $_POST['direccion_tutor'];
$id = $_POST['id'];

$sql = "UPDATE datosusuario SET 
        Nombre_Completo = '$nombre',
        Teléfono = '$telefono',
        CorreoElectrónico = '$correo',
        Danza = $danza,
        Pintura = $pintura,
        Cocina = $cocina,
        Tutor_Nombre = '$nombre_tutor',
        Tutor_apellidos = '$apellidos_tutor',
        Tutor_Teléfono = '$telefono_tutor',
        Tutor_Dirección = '$direccion_tutor'
        WHERE Id_user = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "Datos actualizados correctamente.";
    var_dump($nombre);
} else {
    echo "Error al actualizar datos: " . $conn->error;
}

$conn->close();
?>
 */
?>




