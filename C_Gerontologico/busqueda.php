<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="" method="POST">
    <input type="text" name="busqueda" placeholder="Buscar usuarios por nombre o correo">
    <button type="submit">Buscar</button>
</form>



<?php
// Conexión a la base de datos (asumiendo que ya tienes la conexión configurada)
require("DevBackend/conexion.php");


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $busqueda = $_POST["busqueda"];
    $sql = "SELECT Nombre_Completo FROM datosusuario WHERE Nombre_Completo LIKE '%$busqueda%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<form action='' method='POST'>";
        echo "<table>";
        echo "<tr><th>Nombre</th></tr>";

        while ($row = $result->fetch_assoc()) {
            
            $nombre = $row["Nombre_Completo"];

            echo "<tr>";
            echo "<td>$nombre</td>";
            echo "<td>";
            echo "<label><input type='radio' name='asistencia[$nombre]' value='asistio'>Asistió</label>";
            echo "<label><input type='radio' name='asistencia[$nombre]' value='no_asistio'>No Asistió</label>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
        echo "<button type='submit'>Registrar Asistencia</button>";
        echo "</form>";
    } else {
        echo "No se encontraron resultados.";
    }
}

// Cerrar la conexión
$conn->close();
?>
<?php
// Conexión a la base de datos (asumiendo que ya tienes la conexión configurada)

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $asistencia = $_POST["asistencia"];

    foreach ($asistencia as $usuario_id => $estado) {
        // Registrar la asistencia en la base de datos
        $fecha = date("Y-m-d");
        $hora = date("H:i:s");
        $sql = "INSERT INTO asistencia (usuario_id, fecha, hora, estado) VALUES ('$usuario_id', '$fecha', '$hora', '$estado')";
        $conexion->query($sql);
    }

    echo "Asistencia registrada correctamente.";
}

// Cerrar la conexión
$conexion->close();
?>


</body>
</html>