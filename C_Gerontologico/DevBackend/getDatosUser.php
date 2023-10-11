<?php
require("conexion.php");
    $sqlUser = "SELECT * FROM datosusuario ";
    
    $resultuser = $conn->query($sqlUser);
    
    // Definir un array para almacenar los datos de los usuarios
    $datosUsuarios = array();
    
    if ($resultuser->num_rows > 0) {
        // Obtener y almacenar los datos completos de los usuarios
        while ($rows = $resultuser->fetch_assoc()) {
            $datosUsuarios[] = $rows;
        }

    }
?>