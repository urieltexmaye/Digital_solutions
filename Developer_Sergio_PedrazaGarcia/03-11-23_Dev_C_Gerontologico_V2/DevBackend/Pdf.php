<?php
include("../DevBackend/AutenticationSesion.php");
// Se verifica la autenticación del usuario. 
//Solo los administradores pueden acceder a esta funcionalidad.
verificarAutenticacion("Admin"); 
// Se incluye la librería FPDF para crear archivos PDF.
require('fpdf186/fpdf.php');
// Se establece la conexión a la base de datos.
require("conexion.php");
// Se obtienen los datos de usuarios y asistencia desde la base de datos.
include("GetData.php");
$datosUsuarios = GetDataAllUser($conn);
$datosAsistencia = GetDataServices($conn);

$conn->close();// Se cierra la conexión a la base de datos.

if($_SERVER['REQUEST_METHOD']=== 'POST'){
    // Generar PDF de usuarios registrados
    if (isset($_POST['generate_pdf'])) {
        // Se crea una clase personalizada PDF para definir el formato del PDF.
        class PDF extends FPDF {
            function Header() {
                $this->SetFont('Arial', 'B', 12);
                $this->Image('../img/logo.png', 10, 5, 40);
                $this->Cell(0, 10, 'Usuarios registrados', 0, 1, 'C', );
                $this->Ln( );  
            }
        
            function Footer() {
                // Establece la posición vertical
                $this->SetY(-15);
                // Establece la fuente y estilo
                $this->SetFont('Arial', 'I', 10);
                // Agrega el nombre del centro
                $this->Cell(0, 10, 'Centro Gerontologico ', 0, 0, 'C');
                // Agrega el número de página
                $this->Cell(0, 10, '' . $this->PageNo(), 0, 0, 'L');
            }
        }
        
        
        if (isset($_POST['generate_pdf'])) {
            $pdf = new PDF();
            // Habilita el salto de página automático
            $pdf->SetAutoPageBreak(true, 15); 
            // Agrega una página al PDF
            $pdf->AddPage();
            // Establece la fuente y estilo
            $pdf->SetFont('Arial', 'B', 10);
            //Agrega una celda vacía
            $pdf->Cell(20, 10, '', );
            // Establece el color de relleno
            $pdf->SetFillColor(87, 189, 255);
            // Establece el ancho de las celdas
            $anchoCelda=75;
            // Agrega una celda de encabezado
            $pdf->Cell($anchoCelda, 10,  'Nombre', 1, 0, 'C', 1);
             // Agrega otra celda de encabezado
            $pdf->Cell($anchoCelda, 10,  'Apellidos', 1, 0, 'C', 1);
            // Restaura el color de relleno predeterminado
            $pdf->SetFillColor(255, 255, 255);
            // Realiza un salto de línea
            $pdf->Ln();
            // Itera a través de los datos de usuarios y los agrega al PDF
            foreach ($datosUsuarios as $usuario) {
                $pdf->AddFont('Corier', '', 'courier.php');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(20, 10, '', );
                 // Agrega el nombre del usuario
                $pdf->Cell($anchoCelda, 10,  utf8_decode($usuario['Nombre']), 1);
                // Agrega los apellidos del usuario
                $pdf->Cell($anchoCelda, 10,  utf8_decode($usuario['Apellidos']), 1, 0);
                $pdf->Ln();
            }
            // Obtiene la fecha actual
            $fecha = date('Y-m-d');
            // Define el nombre del archivo PDF
            $nombre_archivo = "Usuarios Registrados $fecha.pdf";
        
            $pdf->Output();
            
        }
    
    }


    //Mismo codigo pero para Talleres
    if (isset($_POST['talleres_PDF'])) {
        class PDF extends FPDF {
            function Header() {
                $this->SetFont('Arial', 'B', 12);
                $this->Image('../img/logo.png', 10, 5, 40);
                $this->Cell(0, 10, 'Usuarios registrados (Taller)', 0, 1, 'C', );
                $this->Ln( );
        
        
                
            }
        
            function Footer() {
                $this->SetY(-15);
                $this->SetFont('Arial', 'I', 10);
                $this->Cell(0, 10, 'Centro Gerontologico ', 0, 0, 'C');
                $this->Cell(0, 10, '' . $this->PageNo(), 0, 0, 'L');
            }
        }

        if (isset($_POST['talleres_PDF'])) {
            $pdf = new PDF();
            $pdf->SetAutoPageBreak(true, 15); 
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(10, 10, '',0,0 );
            $pdf->SetFillColor(87, 189, 255);
            $anchoCeldaNombre=80;
            $anchoCeldaTalleres=30;
            $pdf->Cell($anchoCeldaNombre, 10,  'Nombre del cliente', 1, 0, 'C', 1);
            $pdf->Cell($anchoCeldaTalleres, 10,  'Danza', 1, 0, 'C', 1);
            $pdf->Cell($anchoCeldaTalleres, 10,  'Cocina', 1, 0, 'C', 1);
            $pdf->Cell($anchoCeldaTalleres, 10,  'Pintura', 1, 0, 'C', 1);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->Ln();
            foreach ($datosUsuarios as $usuario) {
                $pdf->AddFont('Corier', '', 'courier.php');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(10, 10, '', );
                $nombreCompleto = utf8_decode($usuario['Nombre'] . ' ' . $usuario['Apellidos']);
                $inscrito = utf8_decode('Está Inscrito');
                $noInscrito = utf8_decode('');

                $pdf->Cell($anchoCeldaNombre, 10,  $nombreCompleto, 1);
                //Valida que si el datos "Danza" es igual a 1
                if ($usuario['Danza'] == 1) {
                    //Si si pone el valor de la variable $inscrito
                    $pdf->Cell($anchoCeldaTalleres, 10, $inscrito, 1, 0, 'C');
                } else {
                    //Si no pone el valor de la variable $noInscrito
                    $pdf->Cell($anchoCeldaTalleres, 10, $noInscrito, 1, 0, 'C');
                }
                if ($usuario['Cocina'] == 1) {
                    $pdf->Cell($anchoCeldaTalleres, 10, $inscrito, 1, 0, 'C');
                } else {
                    $pdf->Cell($anchoCeldaTalleres, 10, $noInscrito, 1, 0, 'C');
                }

                if ($usuario['Pintura'] == 1) {
                    $pdf->Cell($anchoCeldaTalleres, 10, $inscrito, 1, 0, 'C');
                } else {
                    $pdf->Cell($anchoCeldaTalleres, 10, $noInscrito, 1, 0, 'C');
                }


                $pdf->Ln();
            }
        
            $fecha = date('Y-m-d'); 
            $nombre_archivo = "Usuarios inscritos a talleres $fecha.pdf";
        
            $pdf->Output();
            
        }
    
    }



    //Mismo codigo pero para asistencias
    if (isset($_POST['asistencia_PDF'])) {
        class PDF extends FPDF {
            function Header() {
                $this->SetFont('Arial', 'B', 12);
                $this->Image('../img/logo.png', 10, 5, 40);
                $this->Cell(0, 10, 'Asistencia a servicios', 0, 1, 'C', );
                $this->Ln( );  
            }
        
            function Footer() {
                $this->SetY(-15);
                $this->SetFont('Arial', 'I', 10);
                
                $this->Cell(0, 10, 'Centro Gerontologico ', 0, 0, 'C');
                $this->Cell(0, 10, '' . $this->PageNo(), 0, 0, 'L');
            }
        }
        if (isset($_POST['asistencia_PDF'])) {
            $pdf = new PDF();
            $pdf->SetAutoPageBreak(true, 15); 
            $pdf->AddPage();
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(5, 10, '',0,0 );
            $pdf->SetFillColor(87, 189, 255);
            $anchoCeldaNombre=80;
            $anchoCeldaTalleres=35;
            $pdf->Cell($anchoCeldaNombre, 10,  'Nombre del cliente', 1, 0, 'C', 1);
            $pdf->Cell($anchoCeldaTalleres, 10,  'Servicio', 1, 0, 'C', 1);
            $pdf->Cell($anchoCeldaTalleres, 10,  utf8_decode('¿Asistió al servicio?'), 1, 0, 'C', 1);
            $pdf->Cell($anchoCeldaTalleres, 10,  'Fecha del servicio', 1, 0, 'C', 1);
            $pdf->SetFillColor(255, 255, 255);
            $pdf->Ln();
            //cambiamos los valores de la base de datos
            foreach ($datosAsistencia as $usuario) {
                $pdf->AddFont('Corier', '', 'courier.php');
                $pdf->SetFont('Arial', '', 10);
                $pdf->Cell(5, 10, '', );

                $Asistió = utf8_decode('Asistió');
                $noAsistio = utf8_decode('No asistió');


                $pdf->Cell($anchoCeldaNombre, 10,  utf8_decode($usuario['NombreUsuario']), 1);
                $pdf->Cell($anchoCeldaTalleres, 10,  utf8_decode($usuario['Tipo_Sevicio']), 1, 0, 'C', 1);

                //Validamos los valores en la base ded atos de las asistencias
                if ($usuario['Asistencia'] == 1) {
                    $pdf->Cell($anchoCeldaTalleres, 10, $Asistió, 1, 0, 'C');
                } else {
                    $pdf->Cell($anchoCeldaTalleres, 10, $noAsistio, 1, 0, 'C');
                }
                $pdf->Cell($anchoCeldaTalleres, 10,  utf8_decode($usuario['FechaHora']), 1, 0, 'C', 1);


                $pdf->Ln();
            }
        
            $fecha = date('Y-m-d'); 
            $nombre_archivo = "Asistencias a servicios $fecha.pdf";
        
            $pdf->Output();
            
        }
    
    }

    
}
?>
