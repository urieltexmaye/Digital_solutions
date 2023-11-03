<?php
require("conexion.php"); // Se incluye el archivo de conexión a la base de datos.
session_start(); // Se inicia la sesión.

$errores = []; // Array para almacenar los errores.
$datos = $_POST; // Array para almacenar los datos del formulario.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Se obtienen los datos del formulario.
    $id = $_POST["id"];
    $nombre = $_POST["Nombre"];
    $servicio = $_POST["servicio"];
    $fecha = $_POST["fecha"];
    $asistencia = $_POST["asistencia"];

    // verifica si ya se ha registrado la asistencia para el usuario, el servicio y la fecha seleccionados.
    $asistenciaValidate = "SELECT COUNT(*) as count FROM asistencia WHERE NombreUsuario = '$nombre' AND Tipo_Sevicio = '$servicio' AND FechaHora = '$fecha'";
    $resultValidate = $conn->query($asistenciaValidate);

    if ($resultValidate->num_rows > 0) {
        $rowAsistencia = $resultValidate->fetch_assoc();
        $TotalAsistencia = intval($rowAsistencia["count"]);

        if ($TotalAsistencia > 0) {
            // establece un mensaje de error de asistencia duplicada.
            $_SESSION["errorDuplicate"] = "Ya ha sido registrado su asistencia.";
            // redirige de vuelta a la página de inicio del médico.
            header("Location: ../Doctor/HomeSesionDoctor.php"); 
        } else {
            // Si no se ha registrado la asistencia previamente y se ha 
            //seleccionado una opción de asistencia, se procede a registrar 
            //la asistencia en la base de datos.
            if ($asistencia !== "") {
                

                $sql = "INSERT INTO asistencia (NombreUsuario, Tipo_Sevicio, FechaHora, Asistencia) VALUES ('$nombre', '$servicio', '$fecha', '$asistencia')";

                if ($conn->query($sql) === TRUE) {
                    // establece un mensaje de éxito.
                    $_SESSION["exito"] = "La asistencia de $nombre fue registrada.";
                    // redirige de vuelta a la página de inicio del médico.
                    header("Location: ../Doctor/HomeSesionDoctor.php"); 
                } else {
                    // En caso de error, se muestra un mensaje de error.
                    echo "Error al guardar la asistencia: " . $conn->error; 
                }
            } else {
                // muestra un mensaje si no se ha seleccionado una opción de asistencia.
                echo "No se ha seleccionado una opción de asistencia."; 
            }
        }
    }

    $conn->close(); // cierra la conexión a la base de datos.
}
?>
