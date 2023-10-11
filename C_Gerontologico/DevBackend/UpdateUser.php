<?php

// Verificar si la conexión fue exitosa
require("conexion.php");
// Recibir los datos del formulario
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$danza = isset($_POST['danza']) ? 1 : 0;
$pintura = isset($_POST['pintura']) ? 1 : 0;
$cocina = isset($_POST['cocina']) ? 1 : 0;
$nombre_tutor = $_POST['nombre_tutor'];
$apellidos_tutor = $_POST['apellidos_tutor'];
$telefono_tutor = $_POST['telefono_tutor'];
$direccion_tutor = $_POST['direccion_tutor'];
$id = $_POST['id'];

// Consulta SQL para actualizar los datos en la tabla datosusuario
$sql = "UPDATE datosusuario SET 
        Nombre_Completo = '$nombre',
        Teléfono = '$telefono',
        CorreoElectrónico = '$correo',
        Danza = $danza,
        Pintura = $pintura,
        Cocina = $cocina,
        Tutor_Nombre = '$nombre_tutor',
        Tutor_apellidos = '$apellidos_tutor',
        Tutor_Teléfono = '$telefono_tutor',
        Tutor_Dirección = '$direccion_tutor'
        WHERE Id_user = '$id'"; // Reemplaza 'tu_id' con el ID del usuario que deseas actualizar

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Datos actualizados correctamente.";
} else {
    echo "Error al actualizar datos: " . $conn->error;
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
