<?php
require('./fpdf183/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    $this->Image('../../imagenes/SebPolPier.jpg',30,5,60, 20,'JPG', '../index.php');
    // Arial bold 15
    $this->SetFont('Arial','B',20);
    // Movernos a la derecha
    $this->Cell(100);
    // Título
    $this->Cell(70,10,'Reporte de Usuarios',0,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require("./../Login/includes/connection.php");

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);

$sql2 = 'SELECT * FROM usuarios';

$pdf->Cell(10,5, 'Id',1,0,'C',0);
$pdf->Cell(40,5, 'Usuario',1,0,'C',0);
$pdf->Cell(50,5, 'Email',1,0,'C',0);
$pdf->Cell(30,5, 'Nombres',1,0,'C',0);
$pdf->Cell(30,5, 'Apellidos',1,0,'C',0);
$pdf->Cell(20,5, 'DNI',1,0,'C',0);
$pdf->Cell(60,5, 'Direccion',1,0,'C',0);
$pdf->Cell(20,5, 'Ciudad',1,0,'C',0);
$pdf->Cell(20,5, 'Telefono',1,1,'C',0);
foreach ($connection->query($sql2) as $result) {
    $pdf->Cell(10,5, $result['id_usuario'],1,0,'C',0);
    $pdf->Cell(40,5, $result['usuario'],1,0,'C',0);
    $pdf->Cell(50,5, $result['email'],1,0,'C',0);
    $pdf->Cell(30,5, $result['nombres'],1,0,'C',0);
    $pdf->Cell(30,5, $result['apellidos'],1,0,'C',0);
    $pdf->Cell(20,5, $result['dni'],1,0,'C',0);
    $pdf->Cell(60,5, $result['direccion'],1,0,'C',0);
    $pdf->Cell(20,5, $result['ciudad'],1,0,'C',0);
    $pdf->Cell(20,5, $result['telefono'],1,1,'C',0);
}

$pdf->Output();
?>