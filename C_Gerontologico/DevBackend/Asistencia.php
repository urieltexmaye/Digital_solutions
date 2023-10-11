<?php
require("conexion.php");

$nombresP = isset($_POST["nombreP"]) ? $_POST["nombreP"] : array();
$serviciosM = isset($_POST["servicioM"]) ? $_POST["servicioM"] : array();
$fechas = isset($_POST["fecha"]) ? $_POST["fecha"] : array();
$asistencias = isset($_POST["asistencia"]) ? $_POST["asistencia"] : array();

// Procesa los datos de cada registro
for ($i = 0; $i < count($nombresP); $i++) {
    $nombre = isset($nombresP[$i]) ? $nombresP[$i] : '';
    $ServicioM = isset($serviciosM[$i]) ? $serviciosM[$i] : '';
    $fecha = isset($fechas[$i]) ? $fechas[$i] : '';
    $asistencia = isset($asistencias[$i]) ? $asistencias[$i] : '';


    // Consulta SQL para insertar los valores en la tabla "asistencia"
    $sql = "INSERT INTO asistencia (NombreUsuario, Tipo_Sevicio, FechaHora, Asistencia) VALUES ('$nombre', '$ServicioM', '$fecha', '$asistencia')";

    if ($conn->query($sql) !== TRUE) {
        echo "Error al registrar: " . $conn->error;
        // Puedes manejar errores aquí si es necesario
    }
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
