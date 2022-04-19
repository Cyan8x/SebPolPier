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
    $this->Cell(70,10,'Reporte de Productos',0,0,'C');
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

$sql = 'SELECT productos.*, marcas.marca AS marc, categorias.categoria AS categ, proveedores.proveedor AS prov FROM productos INNER JOIN marcas ON productos.cod_marca = marcas.cod_marca INNER JOIN categorias ON productos.cod_categoria = categorias.cod_categoria INNER JOIN proveedores ON productos.cod_prov = proveedores.cod_prov';

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);

$pdf->Cell(30,5, 'Codigo',1,0,'C',0);
$pdf->Cell(20,5, 'Marca',1,0,'C',0);
$pdf->Cell(30,5, 'Categoria',1,0,'C',0);
$pdf->Cell(120,5, 'Nombre',1,0,'C',0);
$pdf->Cell(20,5, 'Proveedor',1,0,'C',0);
$pdf->Cell(15,5, 'Stock',1,0,'C',0);
$pdf->Cell(20,5, 'Precio',1,1,'C',0);
foreach ($connection->query($sql) as $result) {
    $pdf->Cell(30,5, $result['cod_producto'],1,0,'C',0);
    $pdf->Cell(20,5, $result['marc'],1,0,'C',0);
    $pdf->Cell(30,5, $result['categ'],1,0,'C',0);
    $pdf->Cell(120,5, $result['nombre'],1,0,'C',0);
    $pdf->Cell(20,5, $result['prov'],1,0,'C',0);
    $pdf->Cell(15,5, $result['stock'],1,0,'C',0);
    $pdf->Cell(20,5, '$ '.$result['precio'],1,1,'C',0);
}

$pdf->Output();
?>