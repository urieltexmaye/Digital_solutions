<?php
require("conexion.php");

// Verifica si se ha enviado el número de teléfono
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conn->connect_error);
}
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $telefono = $_POST["telefono"];
    $Admin = 'Admin';
    $Doctor = 'Doctor';
    $Usuario = 'user';


    $sql = "SELECT * FROM DatosUsuario WHERE Teléfono = '$telefono' AND Rol = '$Usuario'";
    $sqlDoctor = "SELECT * FROM DatosMedicos WHERE Teléfono = '$telefono' AND Rol = '$Doctor' ";
    $sqlAdmin = "SELECT * FROM Datosadministrador WHERE Teléfono = '$telefono' AND Rol = '$Admin' ";


    $result = $conn->query($sql);
    $resultDoctor = $conn->query($sqlDoctor);
    $resultAdmin = $conn->query($sqlAdmin);



    if ($result->num_rows > 0) {
        // Teléfono encontrado, almacenar en la sesión
        $_SESSION["telefono"] = $telefono;
        $_SESSION["Rol"] = $Usuario;
        

        header("Location: ../Usuario/HomeSesionUser.php");
        exit();
    }
    if ($resultDoctor->num_rows > 0) {
        // Teléfono encontrado, almacenar en la sesión
        $_SESSION["telefono"] = $telefono;
        $_SESSION["Rol"] = $Doctor;


        header("Location: ../Doctor/HomeSesionDoctor.php");
        exit();
    }if ($resultAdmin->num_rows > 0) {
        // Teléfono encontrado, almacenar en la sesión
        $_SESSION["telefono"] = $telefono;
        $_SESSION["Rol"] = $Admin;


        header("Location: ../Administrador/HomeSesionAdmin.php");
        exit();
    }
     else {
        header("Location: ../login.php");
        echo "Teléfono no encontrado en la base de datos.";
    }
}

$conn->close();
?>
