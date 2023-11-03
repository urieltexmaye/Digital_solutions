<?php
// Requiere el archivo de conexión a la base de datos
require("conexion.php");

// Inicia una sesión
session_start();

//array para almacenar errores
$errores = [];

// Almacena los datos enviados a través de POST
$datos = $_POST;

// Comprueba si la solicitud es de tipo POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Obtiene los datos del formulario
    $telefono = $_POST["number_phone"];
    $nombre = $_POST["name"];
    $apellidos = $_POST["last_name"];
    $nombre_completo = $nombre . ' ' . $apellidos;
    $correo = $_POST["email"];
    $Danza = isset($_POST["Danza"]) ? $_POST["Danza"] : "";
    $Pintura = isset($_POST["Pintura"]) ? $_POST["Pintura"] : "";
    $Cocina = isset($_POST["Cocina"]) ? $_POST["Cocina"] : "";
    $Tnombre = $_POST["tutor_name"];
    $Tapellidos = $_POST["tutor_last_name"];
    $Ttelefono = $_POST["tutor_number_phone"];
    $Tdireccion = $_POST["tutor_direccion"];
    $Rol = "user";

    // Validaciones

    // Valida si el campo "nombre" está vacío
    if (empty($nombre)) {
        $errores["nombre"] = "Este campo es obligatorio";
    }

    // Valida si el campo "apellidos" está vacío
    if (empty($apellidos)) {
        $errores["apellidos"] = "Este campo es obligatorio.";
    }

    // Valida que el número de teléfono tenga 10 dígitos
    if (!preg_match("/^\d{10}$/", $telefono)) {
        $errores["telefono"] = "El número de teléfono debe tener 10 dígitos.";
    }

    // Consulta a la base de datos para verificar si el número de teléfono ya está en uso
    $sqlVerificar = "SELECT COUNT(*) as count FROM (
        SELECT Teléfono FROM DatosUsuario WHERE Teléfono = '$telefono'
        UNION ALL SELECT Teléfono FROM DatosAdministrador
        UNION ALL SELECT Teléfono FROM DatosMedicos
    ) AS AllPhones WHERE Teléfono = '$telefono'";
    $result = $conn->query($sqlVerificar);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $totalRegistros = intval($row["count"]);

        if ($totalRegistros > 0) {
            $errores["telefono2"] = "Este número ya está en uso.";
        }
    }

    // Valida el formato del correo electrónico
    if (!preg_match('/@(gmail|hotmail)\.com$/', $correo)) {
        $errores["correo"] = "El correo electrónico ingresado no es válido.";
    }

    // Consulta a la base de datos para verificar si el correo ya está en uso
    $CorreoValidate = "SELECT COUNT(*) as count FROM DatosUsuario WHERE CorreoElectrónico = '$correo'";
    $resultValidate = $conn->query($CorreoValidate);
    if ($resultValidate->num_rows > 0) {
        $rowCorreo = $resultValidate->fetch_assoc();
        $TotalCorreo = intval($rowCorreo["count"]);

        if ($TotalCorreo > 0) {
            $errores["correo2"] = "El correo ya está en uso.";
        }
    }

    // Valida si el campo "Tnombre" está vacío
    if (empty($Tnombre)) {
        $errores["Tnombre"] = "Este campo es obligatorio";
    }

    // Valida si el campo "Tapellidos" está vacío
    if (empty($Tapellidos)) {
        $errores["Tapellidos"] = "Este campo es obligatorio";
    }

    // Valida que el número de teléfono del tutor tenga 10 dígitos numéricos
    if (!preg_match("/^\d{10}$/", $Ttelefono)) {
        $errores["Ttelefono"] = "El teléfono debe contener 10 dígitos numéricos.";
    }

    // Consulta a la base de datos para verificar si el número de teléfono del tutor no está disponible
    $Tutor_telefonoM = "SELECT COUNT(*) as count FROM (
        SELECT Teléfono FROM DatosMedicos WHERE Teléfono = '$Ttelefono'
        UNION ALL SELECT Teléfono FROM DatosAdministrador
    ) AS AllPhones WHERE Teléfono = '$Ttelefono'";
    $resultNumberM = $conn->query($Tutor_telefonoM);
    if ($resultNumberM->num_rows > 0) {
        $rowM = $resultNumberM->fetch_assoc();
        $totalRegistrosNumberM = intval($rowM["count"]);

        if ($totalRegistrosNumberM > 0) {
            $errores["Ttelefono3"] = "Este número no está disponible.";
        }
    }

    // Valida si el número de teléfono del usuario y del tutor son iguales
    if ($telefono == $Ttelefono) {
        $errores["TelefonoDuplicado"] = "Proporciona un número de teléfono diferente.";
    }

    // Consulta a la base de datos para verificar si el número de teléfono del tutor ya existe
    $Tutor_telefono = "SELECT COUNT(*) as count FROM DatosUsuario WHERE Tutor_Teléfono = '$Ttelefono'";
    $resultNumber = $conn->query($Tutor_telefono);
    if ($resultNumber->num_rows > 0) {
        $rowT = $resultNumber->fetch_assoc();
        $totalRegistrosNumber = intval($rowT["count"]);

        if ($totalRegistrosNumber > 1) {
            $errores["Ttelefono2"] = "El número del tutor ya existe.";
        }
    }

    // Valida si el campo "Tdireccion" está vacío
    if (empty($Tdireccion)) {
        $errores["Tdireccion"] = "Este campo es obligatorio";
    }

    // Si no hay errores, guarda los datos en la base de datos
    if (empty($errores)) {
        $sql = "INSERT INTO DatosUsuario (Nombre, Apellidos, Teléfono, CorreoElectrónico, Danza, Pintura, Cocina, Tutor_Nombre, Tutor_apellidos, Tutor_Teléfono, Tutor_Dirección, Rol) 
                VALUES ('$nombre', '$apellidos', '$telefono', '$correo', '$Danza', '$Pintura', '$Cocina', '$Tnombre', '$Tapellidos', '$Ttelefono', '$Tdireccion', '$Rol')";

        // Si la inserción es exitosa, almacenar un mensaje de éxito en la sesión 
        //y redirige al usuario a la página de inicio
        if ($conn->query($sql) === TRUE) {
            $_SESSION["exito"] = "Tus datos se han guardado con éxito.";
            header("Location: ../index.php");
        } else {
            // En caso de error en la consulta, mostrar eñ mensaje de error
            echo "Error al registrar: " . $conn->error;
        }
        exit();
    } else {
        // Si hay errores, almacena los errores y los datos en la sesión y
        //redirige al usuario a la página de registro
        $_SESSION["errores"] = $errores;
        $_SESSION["datos"] = $datos;
        header("Location: ../register.php");
        exit();
    }
} else {
    $errores = "Los campos están vacíos";
}

// Cerrar la conexión a la base de datos
$conn->close();









//Este codigo hace seguro para ataques SQL probarlo despues

/*
require("conexion.php");

$telefono = $_POST["number_phone"];
$nombre = $_POST["name"];
$apellidos = $_POST["last_name"];
$nombre_completo = $nombre . ' ' . $apellidos;
$correo = $_POST["email"];
$Danza = isset($_POST["Danza"]) ? $_POST["Danza"] : "";
$Pintura = isset($_POST["Pintura"]) ? $_POST["Pintura"] : "";
$Cocina = isset($_POST["Cocina"]) ? $_POST["Cocina"] : "";
$Tnombre = $_POST["tutor_name"];
$Tapellidos = $_POST["tutor_last_name"];
$Ttelefono = $_POST["tutor_number_phone"];
$Tdireccion = $_POST["tutor_direccion"];
$Rol = "user";

// Consulta SQL para verificar si el número de teléfono ya existe en las tablas "Administrador" o "Doctor"
$sqlVerificar = "SELECT COUNT(*) as count FROM (SELECT Teléfono FROM DatosAdministrador UNION ALL SELECT Teléfono FROM DatosMedicos) AS AllPhones WHERE Teléfono = ?";

// Utilizar una consulta preparada
$stmt = $conn->prepare($sqlVerificar);
$stmt->bind_param("s", $telefono);
$stmt->execute();
$stmt->bind_result($totalRegistros);
$stmt->fetch();
$stmt->close();

if ($totalRegistros > 0) {
    echo "El número de teléfono ya existe en la base de datos.";
} else {
    // Insertar el registro en la tabla DatosUsuario
    $sql = "INSERT INTO DatosUsuario (Nombre_Completo, Teléfono, CorreoElectrónico, Danza, Pintura, Cocina, Tutor_Nombre, Tutor_apellidos, Tutor_Teléfono, Tutor_Dirección, Rol) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Utilizar una consulta preparada para la inserción
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssss", $nombre_completo, $telefono, $correo, $Danza, $Pintura, $Cocina, $Tnombre, $Tapellidos, $Ttelefono, $Tdireccion, $Rol);
    
    if ($stmt->execute()) {
        header("Location: ../index.html");
    } else {
        echo "Error al registrar: " . $stmt->error;
    }

    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conn->close();

*/




?>