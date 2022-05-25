<?php
require('./fpdf183/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    $this->Image('../../imagenes/SebPolPier.jpg',10,5,50, 20,'JPG', '../index.php');
    // Arial bold 15
    $this->SetFont('Arial','B',20);
    // Movernos a la derecha
    $this->Cell(100);
    // Título
    $this->Cell(30,10,'Reporte de Usuarios',0,0,'C');
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

require("./../Login/includes_login/connection.php");

$pdf = new PDF('P', 'mm', 'A4');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);

$sql2 = 'SELECT * FROM usuarios';

$pdf->Cell(10,5, 'Id',1,0,'C',0);
$pdf->Cell(80,5, 'Email',1,0,'C',0);
$pdf->Cell(50,5, 'Nombres',1,0,'C',0);
$pdf->Cell(50,5, 'Apellidos',1,1,'C',0);
foreach ($connection->query($sql2) as $result) {
    $pdf->Cell(10,5, $result['id_user'],1,0,'C',0);
    $pdf->Cell(80,5, $result['email'],1,0,'C',0);
    $pdf->Cell(50,5, $result['nombres'],1,0,'C',0);
    $pdf->Cell(50,5, $result['apellidos'],1,1,'C',0);
}

$pdf->Output();
?>