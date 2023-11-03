<?php
require("conexion.php"); // Se establece la conexión a la base de datos.

// Función para obtener datos de un doctor.
function GetDataDoctor($conn) {
    $telefono = $_SESSION["telefono"]; // Obtiene el teléfono de la sesión actual.
    $datosUsuario = array(); // Un arreglo para almacenar los datos.
    // Consulta SQL para obtener los datos de un doctor.
    $sql = "SELECT * FROM DatosMedicos WHERE Teléfono = '$telefono'"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $datosUsuario['nombreCompleto'] = $row["Nombre"];
            $datosUsuario['correo'] = $row["Teléfono"];
            $datosUsuario['especialidad'] = $row["Especialidad"];

            return $datosUsuario; // Retorna los datos del doctor.
        }
    } else {
        $datosUsuario['SinResultados'] = "No se encontró ningún registro";
        return $datosUsuario;
    }
}

// Función para obtener datos de un usuario.
function GetDataUser($conn) {
    $telefono = $_SESSION["telefono"]; // Obtiene el teléfono de la sesión actual.
    $datosUsuario = array(); // Un arreglo para almacenar los datos del usuario.
    // Consulta SQL para obtener los datos de un usuario.
    $sql = "SELECT * FROM DatosUsuario WHERE Teléfono = '$telefono'"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $datosUsuario['id'] = $row["Id_user"];
            $datosUsuario['nombre'] = $row["Nombre"];
            $datosUsuario['apellidos'] = $row["Apellidos"];
            $datosUsuario['telefono'] = $row["Teléfono"];
            $datosUsuario['correoElectronico'] = $row["CorreoElectrónico"];
            $datosUsuario['Danza'] = $row["Danza"];
            $datosUsuario['Pintura'] = $row["Pintura"];
            $datosUsuario['Cocina'] = $row["Cocina"];
            $datosUsuario['NombreT'] = $row["Tutor_Nombre"];
            $datosUsuario['ApellidosT'] = $row["Tutor_apellidos"];
            $datosUsuario['TelefonoT'] = $row["Tutor_Teléfono"];
            $datosUsuario['DireccionT'] = $row["Tutor_Dirección"];

            return $datosUsuario; // Retorna los datos del usuario.
        }
    } else {
        return false; // Retorna falso si no se encontraron resultados.
    }
}

// Función para obtener datos de todos los usuarios.
function GetDataAllUser($conn) {
    // Consulta SQL para obtener datos de todos los usuarios.
    $sqlUser = "SELECT * FROM datosusuario"; 
    $resultUser = $conn->query($sqlUser);
    $datosUsuarios = array(); // Un arreglo para almacenar los datos de usuarios.

    if ($resultUser->num_rows > 0) {
        while ($row = $resultUser->fetch_assoc()) {
            $datosUsuarios[] = $row; // Almacena los datos de cada usuario en el arreglo.
        }
    }

    return $datosUsuarios; // Retorna el arreglo con todos los datos de usuarios.
}

// Función para obtener datos de servicios.
function GetDataServices($conn) {
    // Consulta SQL para obtener datos de asistencias a servicios.
    $sqlAsistencia = "SELECT * FROM asistencia"; 
    $resultAsistencia = $conn->query($sqlAsistencia);
    $datosAsistencia = array(); // Un arreglo para almacenar los datos de asistencias.

    if ($resultAsistencia->num_rows > 0) {
        while ($row = $resultAsistencia->fetch_assoc()) {
            $datosAsistencia[] = $row; // Almacena los datos de cada asistencia en el arreglo.
        }
    }

    return $datosAsistencia; // Retorna el arreglo con los datos de asistencias a servicios.
}

// Función para buscar datos de usuario basados en un término y campo de búsqueda.
function SearchUserData($conn, $searchTerm, $searchField) {
    $searchTerm = $conn->real_escape_string($searchTerm); // Escapa el término de búsqueda para evitar SQL injection.

    $sql = "SELECT * FROM datosusuario WHERE $searchField LIKE '%$searchTerm%'"; // Consulta SQL para buscar datos de usuario.
    
    $result = $conn->query($sql);
    
    $searchResults = array(); // Un arreglo para almacenar los resultados de la búsqueda.

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $searchResults[] = $row; // Almacena los resultados de la búsqueda en el arreglo.
        }
    }

    return $searchResults; // Retorna el arreglo con los resultados de la búsqueda.
}

?>
