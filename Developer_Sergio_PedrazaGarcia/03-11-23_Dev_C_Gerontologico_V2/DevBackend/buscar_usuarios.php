<?php
require("conexion.php"); // Se incluye el archivo de conexión a la base de datos.

if (isset($_POST["query"])) {
    $query = $conn->real_escape_string($_POST["query"]); // Se obtiene la cadena de búsqueda.
    // Consulta SQL para buscar usuarios cuyos nombres o apellidos coincidan con la cadena de búsqueda.
    $sql = "SELECT * FROM datosusuario WHERE CONCAT(nombre, ' ', apellidos) LIKE '%$query%'"; 
} else {
    // Consulta SQL para seleccionar todos los usuarios si no se proporciona una cadena de búsqueda.-
    $sql = "SELECT * FROM datosusuario"; 
}

$result = $conn->query($sql); // Se ejecuta la consulta SQL.
$datosUsuarios = array(); // Array para almacenar los datos de usuarios.

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $datosUsuarios[] = $row; // Se agregan los datos de usuarios al array.
        json_encode($datosUsuarios); // Se realiza la codificación JSON de los datos

    }
}

echo json_encode($datosUsuarios); // Se imprime la codificación JSON de los datos de usuarios.

$conn->close(); // Se cierra la conexión a la base de datos.
?>
