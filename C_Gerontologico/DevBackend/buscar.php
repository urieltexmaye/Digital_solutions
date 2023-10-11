<?php
require("conexion.php");



$datosUsuarios = array();


if (isset($_GET["nombre"])) {
    // Obtener y almacenar los datos completos de los usuarios
    // Obtener y almacenar los datos completos de los usuarios
    $nombre = $_GET["nombre"];

    $sqlUser = "SELECT * FROM datosusuario WHERE Nombre_Completo LIKE '%$nombre%'";
    
    $resultuser = $conn->query($sqlUser);
    
    // Definir un array para almacenar los datos de los usuarios
    $datosUsuarios = array();
    
    if ($resultuser->num_rows > 0) {
        // Obtener y almacenar los datos completos de los usuarios
        while ($rows = $resultuser->fetch_assoc()) {
            $datosUsuarios[] = $rows;
        }

    }


    }
    

    $conn->close();

?>