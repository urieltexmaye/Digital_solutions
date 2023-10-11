<?php

// Conexión a la base de datos (debes proporcionar tus propios detalles de conexión)
require("../DevBackend/conexion.php");

$telefono = $_SESSION["telefono"];


// Consulta SQL para obtener los datos completos del usuario
$sql = "SELECT * FROM DatosUsuario WHERE Teléfono = '$telefono'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // Mostrar los datos completos del usuario
    while ($row = $result->fetch_assoc()) {
        $id= $row["Id_user"];
        $nombreCompleto = $row["Nombre_Completo"];
        $telefono = $row["Teléfono"];
        $correoElectronico = $row["CorreoElectrónico"];
        $Danza = $row["Danza"];
        $Pintura = $row["Pintura"];
        $Cocina = $row["Cocina"];
        $NombreT = $row["Tutor_Nombre"];
        $ApellidosT = $row["Tutor_apellidos"];
        $TelefonoT = $row["Tutor_Teléfono"];
        $DireccionT = $row["Tutor_Dirección"];

        // Agrega más campos según tu base de datos
    }
} else {
    header("Location: ../login.php");

}


?>