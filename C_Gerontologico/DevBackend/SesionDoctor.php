<?php
// Iniciar sesión si no está iniciada

// Conexión a la base de datos (debes proporcionar tus propios detalles de conexión)
require("../DevBackend/conexion.php");

$telefono = $_SESSION["telefono"];


// Consulta SQL para obtener los datos completos del usuario
$sql = "SELECT * FROM DatosMedicos WHERE Teléfono = '$telefono'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // Mostrar los datos completos del usuario
    while ($row = $result->fetch_assoc()) {
        $nombreCompleto = $row["Nombre"];
        $correo = $row["Teléfono"];
        $especialidad = $row["Especialidad"];

        // Agrega más campos según tu base de datos
    }
}
else{
    $SinResultados = "No se encontro ningun registro";
}





?>