<?php
require('./fpdf183/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->Image('../../imagenes/SebPolPier.jpg', 30, 5, 60, 20, 'JPG', '../index.php');
        // Arial bold 15
        $this->SetFont('Arial', 'B', 20);
        // Movernos a la derecha
        $this->Cell(100);
        // Título
        $this->Cell(70, 10, 'Reporte de Pedidos', 0, 0, 'C');
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

require("./../Login/includes/connection.php");

$sql1 = 'SELECT ventas.*, detalle2_venta.monto_finalD, detalle2_venta.monto_finalS FROM ventas INNER JOIN detalle2_venta ON ventas.cod_venta = detalle2_venta.cod_venta';

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);


foreach ($connection->query($sql1) as $result1) {
    $pdf->Cell(8, 5, 'Cod.', 1, 0, 'C', 0);
    $pdf->Cell(17, 5, 'Usuario', 1, 0, 'C', 0);
    $pdf->Cell(25, 5, 'Nombres', 1, 0, 'C', 0);
    $pdf->Cell(25, 5, 'Apellidos', 1, 0, 'C', 0);
    $pdf->Cell(15, 5, 'Dni', 1, 0, 'C', 0);
    $pdf->Cell(35, 5, 'Email', 1, 0, 'C', 0);
    $pdf->Cell(52, 5, 'Direccion', 1, 0, 'C', 0);
    $pdf->Cell(15, 5, 'Ciudad', 1, 0, 'C', 0);
    $pdf->Cell(16, 5, 'Telefono', 1, 0, 'C', 0);
    $pdf->Cell(19, 5, 'Fech. Comp.', 1, 0, 'C', 0);
    $pdf->Cell(16, 5, 'Estado', 1, 0, 'C', 0);
    $pdf->Cell(16, 5, 'Monto F. $', 1, 0, 'C', 0);
    $pdf->Cell(16, 5, 'Monto F. S/', 1, 1, 'C', 0);
    $pdf->Cell(8, 5, $result1['cod_venta'], 1, 0, 'C', 0);
    $pdf->Cell(17, 5, $result1['usuario'], 1, 0, 'C', 0);
    $pdf->Cell(25, 5, $result1['nombres'], 1, 0, 'C', 0);
    $pdf->Cell(25, 5, $result1['apellidos'], 1, 0, 'C', 0);
    $pdf->Cell(15, 5, $result1['dni'], 1, 0, 'C', 0);
    $pdf->Cell(35, 5, $result1['email'], 1, 0, 'C', 0);
    $pdf->Cell(52, 5, $result1['direccion'], 1, 0, 'C', 0);
    $pdf->Cell(15, 5, $result1['ciudad'], 1, 0, 'C', 0);
    $pdf->Cell(16, 5, $result1['telefono'], 1, 0, 'C', 0);
    $pdf->Cell(19, 5, $result1['fecha_compra'], 1, 0, 'C', 0);
    $pdf->Cell(16, 5, $result1['estado'], 1, 0, 'C', 0);
    $pdf->Cell(16, 5, $result1['monto_finalD'], 1, 0, 'C', 0);
    $pdf->Cell(16, 5, $result1['monto_finalS'], 1, 1, 'C', 0);
    $pdf->Cell(2, 5, ' ', 0, 0, 'C', 0);
    $pdf->Cell(23, 5, 'Cod. Prod.', 1, 0, 'C', 0);
    $pdf->Cell(25, 5, 'Imagen', 1, 0, 'C', 0);
    $pdf->Cell(127, 5, 'Nombre', 1, 0, 'C', 0);
    $pdf->Cell(15, 5, 'Cant.', 1, 0, 'C', 0);
    $pdf->Cell(16, 5, 'Prec. $', 1, 0, 'C', 0);
    $pdf->Cell(19, 5, 'Prec. S/', 1, 0, 'C', 0);
    $pdf->Cell(16, 5, ' SubTot. $', 1, 0, 'C', 0);
    $pdf->Cell(16, 5, 'SubTot. S/', 1, 0, 'C', 0);
    $pdf->Cell(16, 5, ' ', 0, 1, 'C', 0);
    $sql2 = 'SELECT detalle1_venta.*, productos.imagen, productos.nombre FROM detalle1_venta INNER JOIN productos ON productos.cod_producto = detalle1_venta.cod_producto WHERE cod_venta = ' . $result1['cod_venta'];
    foreach ($connection->query($sql2) as $result2) {
        $pdf->Cell(2, 25, ' ', 0, 0, 'C', 0);
        $pdf->Cell(23, 25, $result2['cod_producto'], 1, 0, 'C', 0);
        $pdf->Cell(25, 25, $pdf->Image('../../imagenes/' . $result2['imagen'], $pdf->GetX(), $pdf->GetY(), 25), 1, 0, 'C', 0);
        $pdf->Cell(127, 25, $result2['nombre'], 1, 0, 'C', 0);
        $pdf->Cell(15, 25, $result2['cantidad'], 1, 0, 'C', 0);
        $pdf->Cell(16, 25, $result2['precio_dolares'], 1, 0, 'C', 0);
        $pdf->Cell(19, 25, $result2['precio_soles'], 1, 0, 'C', 0);
        $pdf->Cell(16, 25, $result2['subtotal_dolares'], 1, 0, 'C', 0);
        $pdf->Cell(16, 25, $result2['subtotal_soles'], 1, 0, 'C', 0);
        $pdf->Cell(16, 25, ' ', 0, 1, 'C', 0);
    }
}

$pdf->Output();
