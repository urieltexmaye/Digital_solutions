<?php
session_start(); // Se inicia la sesión.

session_destroy(); // Se destruye la sesión actual, eliminando todas las variables de sesión.

header("Location: ../login.php"); // Se redirige al usuario a la página de inicio de sesión.

exit(); // Se finaliza la ejecución del script para asegurarse de que no se ejecute más código.
?>
