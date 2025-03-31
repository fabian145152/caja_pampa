<?php
session_start();
include_once "../../../funciones/funciones.php";
include "procesar.php";
$con = conexion();
$con->set_charset("utf8mb4");

$inputCorrecto = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsuario = $_POST['usuario'];
    // Validar el input
    if ($inputUsuario === "valorCorrecto") {
        $inputCorrecto = true; // Se considera correcto si es igual a "valorCorrecto"
    }
}

$total = 0;

echo $movil = $_GET['movil'];
echo "<br>";
//echo $_SESSION['globalData'];


echo $total_a_pagar = $_GET['total_a_pagar'];
echo "<br>";
echo $cant_viajes = $_GET['cant_viajes'];
echo "<br>";
echo $total = $_GET['tot_voucher'];
echo "<br>";
echo $deposito = $_POST['inputFijo'];
echo "<br>";
echo $movil = $_POST['inputUsuario'];

$inputCorrecto = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsuario = $_POST['usuario'];
    // Validar el input
    if ($inputUsuario === "valorCorrecto") {
        $inputCorrecto = true; // Se considera correcto si es igual a "valorCorrecto"
    }
}

exit();


$sql_comp = "SELECT * FROM completa WHERE movil = $movil";
$res_comp = $con->query($sql_comp);
$row_comp = $res_comp->fetch_assoc();
$apellido = $row_comp['apellido_titu'];
$fecha = date('d-m-Y');

exit;


/*
// Incluir el archivo FPDF
require('../../../fpdf/fpdf.php');
// Crear un nuevo PDF
$pdf = new FPDF('L', 'mm', array(210, 100));
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 16);
$pdf->Image('../../../imagenes/logo_porte.jpg', 30, 10, 20);
$pdf->Image('../../../imagenes/logo_pampa.png', 70, 10, 20);
$pdf->Ln(10); // Salto de línea

// Variables PHP que quieres mostrar en el PDF

// Añadir contenido al PDF

$pdf->Cell(40, 10, 'Recibo de Pago' . '  Pampa Porteno ' . '  ' . $fecha);
$pdf->Ln(10); // Salto de línea
$pdf->SetFont('Arial', '', 12); // Cambiar a fuente regular
$pdf->Cell(40, 10, 'Movil: ' . $movil .  'Nombre: ' . $apellido);
$pdf->Ln(10); // Salto de línea
$pdf->Cell(3, 10,   'Viajes: ' . $cant_viajes . '   ' . 'Total Voucher: ' . '$' . $total . '-');
$pdf->Ln(10); // Salto de línea
$pdf->Cell(40, 10, 'Se le depositaron: ' . $total_a_pagar);
$pdf->Ln(10); // Salto de línea


$pdf->Cell(40, 10, 'En la cuenta: ' . ' XXX ' . ' del banco ' . 'xxxxxxx');
$pdf->Ln(10); // Salto de línea



// Crear la carpeta 'recibos' si no existe
if (!file_exists('recibos')) {
    mkdir('recibos', 0777, true);
}

// Guardar el PDF en la carpeta 'recibos'
//$rutaArchivo = '../recibos/' . $movil .  $fecha . '.pdf';
$rutaArchivo = '../recibos/' . $movil . $fecha . '.pdf';
$pdf->Output('F', $rutaArchivo);
$pdf->Output('I');

// Mostrar mensaje de confirmación
echo "PDF generado exitosamente: <a href='$rutaArchivo'>Descargar</a>";
*/