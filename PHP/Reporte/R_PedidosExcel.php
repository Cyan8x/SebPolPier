<?php
//CALL THE AUTOLOAD
require("./vendor/autoload.php");
//LOAD PHPSPREADSHEET CLASS USING NAMESPACE
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//CALL XLSX WRITER CLASS TO MAKE AN XLSX FILE
use PhpOffice\PhpSpreadsheet\IOFactory;
//MAKE A NEW ASPREASHEET OBJECT
$spreadsheet = new Spreadsheet();

//GET CURRENT ACTIVE SHEET (FIRST SHEET)
$date =  date('j-m-y');

$sheet = $spreadsheet->getActiveSheet();

$sheet->mergeCells('D2:K2');
$sheet->setCellValue('D2', 'REPORTE DE PEDIDOS(' . $date . ')');
$styleArray0 = [
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
];
$styleArray1 = [
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        ],
    ],
];
$styleArray2 = [
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => [
            'argb' => 'D1D1D1',
        ],
    ],
];
$sheet->getStyle('D2')->getFont()->setName('Arial')->setBold(true)->setSize(20)->setUnderline(true);
$sheet->getStyle('D2')->applyFromArray($styleArray0);

require("./../Login/includes/connection.php");

$sql1 = 'SELECT ventas.*, detalle2_venta.monto_finalD, detalle2_venta.monto_finalS FROM ventas INNER JOIN detalle2_venta ON ventas.cod_venta = detalle2_venta.cod_venta';
$var = 4;
foreach ($connection->query($sql1) as $result1) {
    $sheet->setCellValue('B' . $var, 'COD.');
    $sheet->setCellValue('C' . $var, 'USUARIO');
    $sheet->setCellValue('D' . $var, 'EMAIL');
    $sheet->setCellValue('E' . $var, 'NOMBRES');
    $sheet->setCellValue('F' . $var, 'APELLIDOS');
    $sheet->setCellValue('G' . $var, 'DNI');
    $sheet->setCellValue('H' . $var, 'DIRECCION');
    $sheet->setCellValue('I' . $var, ' CIUDAD ');
    $sheet->setCellValue('J' . $var, ' TELEFONO ');
    $sheet->setCellValue('K' . $var, 'FECH. COMP.');
    $sheet->setCellValue('L' . $var, 'ESTADO');
    $sheet->setCellValue('M' . $var, 'MONTO F. $');
    $sheet->setCellValue('N' . $var, 'MONTO F. S/');
    $sheet->getStyle('B' . $var . ':N' . $var)->getFont()->setBold(true)->setSize(11);
    $sheet->getStyle('B' . $var . ':N' . $var)->applyFromArray($styleArray2);
    $var++;
    $sheet->setCellValue('B' . $var, $result1['cod_venta']);
    $sheet->setCellValue('C' . $var, $result1['usuario']);
    $sheet->setCellValue('D' . $var, $result1['email']);
    $sheet->setCellValue('E' . $var, $result1['nombres']);
    $sheet->setCellValue('F' . $var, $result1['apellidos']);
    $sheet->setCellValue('G' . $var, $result1['dni']);
    $sheet->setCellValue('H' . $var, $result1['direccion']);
    $sheet->setCellValue('I' . $var, $result1['ciudad']);
    $sheet->setCellValue('J' . $var, $result1['telefono']);
    $sheet->setCellValue('K' . $var, $result1['fecha_compra']);
    $sheet->setCellValue('L' . $var, $result1['estado']);
    $sheet->setCellValue('M' . $var, $result1['monto_finalD']);
    $sheet->setCellValue('N' . $var, $result1['monto_finalS']);
    $sheet->getStyle('B' . $var . ':N' . $var)->getFont()->setSize(10);
    $var++;
    $sheet->setCellValue('C' . $var, 'COD. PROD.');
    $sheet->setCellValue('D' . $var, 'IMAGEN');
    $sheet->mergeCells('E' . $var . ':H' . $var);
    $sheet->setCellValue('E' . $var, 'NOMBRE');
    $sheet->setCellValue('I' . $var, 'CANT.');
    $sheet->setCellValue('J' . $var, 'PREC. $');
    $sheet->setCellValue('K' . $var, 'PREC. S/');
    $sheet->setCellValue('L' . $var, 'SUBTOT. $');
    $sheet->setCellValue('M' . $var, 'SUBTOT. S/');
    $sheet->getStyle('C' . $var . ':M' . $var)->getFont()->setBold(true)->setSize(11);
    $sheet->getStyle('C' . $var . ':M' . $var)->applyFromArray($styleArray2);
    $var++;
    $sql2 = 'SELECT detalle1_venta.*, productos.imagen, productos.nombre FROM detalle1_venta INNER JOIN productos ON productos.cod_producto = detalle1_venta.cod_producto WHERE cod_venta = ' . $result1['cod_venta'];
    foreach ($connection->query($sql2) as $result2) {
        $sheet->setCellValue('C' . $var, $result2['cod_producto']);
        $sheeti = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
        $sheeti->setPath('../../imagenes/' . $result2['imagen']);
        $sheeti->setHeight(100);
        $sheeti->setCoordinates('D' . $var);
        $sheet->getRowDimension($var)->setRowHeight(80);
        $sheeti->setOffsetX(0);
        $sheeti->setOffsetY(0);
        $sheeti->setWorksheet($sheet);
        $sheet->getStyle('C' . $var . ':M' . $var)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('E' . $var . ':H' . $var);
        $sheet->setCellValue('E' . $var, $result2['nombre']);
        $sheet->setCellValue('I' . $var, $result2['cantidad']);
        $sheet->setCellValue('J' . $var, $result2['precio_dolares']);
        $sheet->setCellValue('K' . $var, $result2['precio_soles']);
        $sheet->setCellValue('L' . $var, $result2['subtotal_dolares']);
        $sheet->setCellValue('M' . $var, $result2['subtotal_soles']);
        $sheet->getStyle('B' . $var . ':N' . $var)->getFont()->setSize(10);
        $var++;
    }
}
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);
$sheet->getColumnDimension('G')->setAutoSize(true);
$sheet->getColumnDimension('H')->setAutoSize(true);
$sheet->getColumnDimension('I')->setAutoSize(true);
$sheet->getColumnDimension('J')->setAutoSize(true);
$sheet->getColumnDimension('K')->setAutoSize(true);
$sheet->getColumnDimension('L')->setAutoSize(true);
$sheet->getColumnDimension('M')->setAutoSize(true);
$sheet->getColumnDimension('N')->setAutoSize(true);


$sheet->getStyle('B4:N' . $var - 1)->applyFromArray($styleArray1);
$sheet->getStyle('B4:N' . $var)->getFont()->setName('Arial');

$sheet->setTitle('Reporte de Pedidos(' . $date . ')');

//SET THE HEADER FIRST SO THE RESUTL WILL BE TREATED AS AN XLSX FILE
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
//MAKE IT AN ATTACHMENT SO WE CAN DEFINE FILENAME
header('Content-Disposition: attachment; filename="Reporte de Pedidos(' . $date . ').xlsx"');
//CREATE IOFactory OBJECT
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//SAVE INTO PHP OUTPUT
$writer->save('php://output');
