<?php
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
$sqlVerificar = "SELECT COUNT(*) as count FROM (SELECT Teléfono FROM DatosAdministrador UNION ALL SELECT Teléfono FROM DatosMedicos) AS AllPhones WHERE Teléfono = '$telefono'";

$result = $conn->query($sqlVerificar);

if ($result->num_rows > 0) {
    // Extraer el resultado de la consulta
    $row = $result->fetch_assoc();
    $totalRegistros = intval($row["count"]);

    if ($totalRegistros > 0) {
        echo "El número de teléfono ya existe en la base de datos.";
    } else {
        // Insertar el registro en la tabla DatosUsuario
        $sql = "INSERT INTO DatosUsuario (Nombre_Completo, Teléfono, CorreoElectrónico, Danza, Pintura, Cocina, Tutor_Nombre, Tutor_apellidos, Tutor_Teléfono, Tutor_Dirección, Rol) 
                VALUES ('$nombre_completo', '$telefono', '$correo', '$Danza', '$Pintura', '$Cocina', '$Tnombre', '$Tapellidos', '$Ttelefono', '$Tdireccion', '$Rol')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../index.html");
        } else {
            echo "Error al registrar: " . $conn->error;
        }
    }
} else {
    echo "Error al verificar el número de teléfono: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>