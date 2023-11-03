<?php
// Función para verificar la autenticación y el rol del usuario.
function verificarAutenticacion($rolPermitido) {
    // Se inicia la sesión para acceder a las variables de sesión.
    session_start();
    
    // Se verifica si no existe una variable de sesión llamada "telefono" o si el rol de 
    //la sesión no coincide con el rol permitido.
    if (!isset($_SESSION["telefono"]) || $_SESSION["Rol"] !== $rolPermitido) {
        // Se redirige al usuario a la página de inicio de sesión si no se encuentra
        header("Location: ../login.php"); 
        exit();
    }
}
// Se incluye el archivo de conexión a la base de datos.
require("conexion.php");
// Se cierra la conexión a la base de datos.
$conn->close();
?>