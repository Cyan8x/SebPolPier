<?php
require('./fpdf183/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->Image('../../imagenes/SebPolPier.jpg', 30, 5, 60, 20, 'JPG', '../index.php');
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(100);
        // Título
        $this->Cell(70, 10, 'Reporte de Productos', 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

require("./../Login/includes_login/connection.php");

$sql = 'SELECT productos.*, marca.nombre AS marc, categoria.nombre AS categ, proveedor.nombre AS prov FROM productos INNER JOIN marca ON productos.cod_marca = marca.cod_marca INNER JOIN categoria ON productos.cod_categoria = categoria.cod_categoria INNER JOIN proveedor ON productos.cod_prov = proveedor.cod_prov';

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);

$start_x = $pdf->GetX(); //initial x (start of column position)
$current_y = $pdf->GetY();
$current_x = $pdf->GetX();

$pdf->MultiCell(24, 5, 'Codigo', 1,'C');
$current_x += 24;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(17, 5, 'Marca', 1,'C');
$current_x += 17;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(30, 5, 'Categoria', 1,'C');
$current_x += 30;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(30, 5, 'Imagen', 1,'C');
$current_x += 30;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(60, 5, 'Nombre', 1,'C');
$current_x += 60;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(20, 5, 'Proveedor', 1,'C');
$current_x += 20;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(15, 5, 'Stock', 1,'C');
$current_x += 15;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(20, 5, 'P. en Dolares', 1,'C');
$current_x += 20;
$pdf->SetXY($current_x, $current_y);
$pdf->MultiCell(20, 5, 'P. en Soles', 1,'C');
$current_x += 20;
$pdf->Ln();
$current_x = $start_x;                       //set x to start_x (beginning of line)
$current_y += 5;                  //increase y by cell_height to print on next line

    $pdf->SetXY($current_x, $current_y);
foreach ($connection->query($sql) as $result) {
    $pdf->MultiCell(24, 30, $result['cod_producto'], 1, 'C');
    $current_x += 24;
    $pdf->SetXY($current_x, $current_y);
    $pdf->MultiCell(17, 30, $result['marc'], 1, 'C');
    $current_x += 17;
    $pdf->SetXY($current_x, $current_y);
    $pdf->MultiCell(30, 30, $result['categ'], 1, 'C');
    $current_x += 30;
    $pdf->SetXY($current_x, $current_y);
    $pdf->MultiCell(30, 30, $pdf->Image('../../imagenes/' . $result['imagen'], $pdf->GetX(), $pdf->GetY(), 30), 1);
    $current_x += 30;
    $pdf->SetXY($current_x, $current_y);
    $pdf->MultiCell(60, 15, $result['nombre'], 1, 'C');
    $current_x += 60;
    $pdf->SetXY($current_x, $current_y);
    $pdf->MultiCell(20, 30, $result['prov'], 1, 'C');
    $current_x += 20;
    $pdf->SetXY($current_x, $current_y);
    $pdf->MultiCell(15, 30, $result['stock'], 1, 'C');
    $current_x += 15;
    $pdf->SetXY($current_x, $current_y);
    $pdf->MultiCell(20, 30, $result['precio_dolares'], 1, 'C');
    $current_x += 20;
    $pdf->SetXY($current_x, $current_y);
    $pdf->MultiCell(20, 30, $result['precio_soles'], 1, 'C');
    $current_x+=20;

    $pdf->Ln();
    $current_x = $start_x;                       //set x to start_x (beginning of line)
    $current_y += 30;                  //increase y by cell_height to print on next line

    $pdf->SetXY($current_x, $current_y);
}

$pdf->Output();
