<?php
require("conexion.php"); // Se incluye el archivo de conexión a la base de datos.

if ($conn->connect_error) {
    // Se verifica si hay un error de conexión a la base de datos y se muestra un mensaje de error si es necesario.
    die("Error de conexión a la base de datos: " . $conn->connect_error); 
}

session_start(); // Se inicia la sesión.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $telefono = $_POST["telefono"]; // Se obtiene el número de teléfono del formulario.
    //Se declaran variables de los roles para comparar en la consulta
    $Admin = 'Admin';
    $Doctor = 'Doctor';
    $Usuario = 'user';
    //Se realiza la consulta para ver que rol tienen los numeros ingresados
    $sql = "SELECT * FROM DatosUsuario WHERE Teléfono = '$telefono' AND Rol = '$Usuario'";
    $sqlDoctor = "SELECT * FROM DatosMedicos WHERE Teléfono = '$telefono' AND Rol = '$Doctor'";
    $sqlAdmin = "SELECT * FROM Datosadministrador WHERE Teléfono = '$telefono' AND Rol = '$Admin'";

    $result = $conn->query($sql);
    $resultDoctor = $conn->query($sqlDoctor);
    $resultAdmin = $conn->query($sqlAdmin);

    if ($result->num_rows > 0) {
        // Si se encuentra un usuario con el número de teléfono y rol de usuario, se almacenan 
        //los datos en la sesión y se redirige a la página de inicio de usuario.
        $_SESSION["telefono"] = $telefono;
        $_SESSION["Rol"] = $Usuario;
        header("Location: ../index.php");
        exit();
    }

    if ($resultDoctor->num_rows > 0) {
        // Si se encuentra un usuario con el número de teléfono y rol de doctor, 
        //se almacenan los datos en la sesión y se redirige a la página de inicio de doctor.
        $_SESSION["telefono"] = $telefono;
        $_SESSION["Rol"] = $Doctor;
        header("Location: ../Doctor/HomeSesionDoctor.php");
        exit();
    }

    if ($resultAdmin->num_rows > 0) {
        // Si se encuentra un usuario con el número de teléfono y rol de administrador,
        // se almacenan los datos en la sesión y se redirige a la página de inicio de administrador.
        $_SESSION["telefono"] = $telefono;
        $_SESSION["Rol"] = $Admin;
        header("Location: ../Administrador/HomeSesionAdmin.php");
        exit();
    } else {
        // Si no se encuentra un usuario con el número de teléfono y rol correspondiente, 
        //se muestra un mensaje de error y se redirige a la página de inicio de sesión.
        $error_message = "El teléfono no está registrado.";
        $_SESSION["error_message"] = $error_message;
        header("Location: ../login.php");
        exit();
    }
}

$conn->close(); // Se cierra la conexión a la base de datos.
?>
