<?php
// Iniciar sesión si no está iniciada
session_start();

// Verifica si el usuario está autenticado
if (!isset($_SESSION["telefono"])  || $_SESSION["Rol"] !== "Admin") {
    header("Location: ../login.php"); // Redirecciona si no está autenticado
    exit();
}

// Conexión a la base de datos (debes proporcionar tus propios detalles de conexión)
require("../DevBackend/conexion.php");




$conn->close();
?>