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

$sheet->mergeCells('D2:J2');
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

require("./../Login/includes_login/connection.php");

$sql1 = 'SELECT ventas.*, usuarios.* FROM ventas INNER JOIN usuarios ON usuarios.id_user = ventas.id_user';
$var = 4;
foreach ($connection->query($sql1) as $result1) {
    $sheet->setCellValue('B' . $var, 'COD.');
    $sheet->setCellValue('C' . $var, 'ID_USUARIO');
    $sheet->setCellValue('D' . $var, 'APELLIDOS');
    $sheet->setCellValue('E' . $var, 'DNI');
    $sheet->setCellValue('F' . $var, 'DIRECCION');
    $sheet->setCellValue('G' . $var, ' CIUDAD ');
    $sheet->setCellValue('H' . $var, ' TELEFONO ');
    $sheet->setCellValue('I' . $var, 'FECH. COMP.');
    $sheet->setCellValue('J' . $var, 'ESTADO');
    $sheet->setCellValue('K' . $var, 'MONTO FINAL');
    $sheet->getStyle('B' . $var . ':K' . $var)->getFont()->setBold(true)->setSize(11);
    $sheet->getStyle('B' . $var . ':K' . $var)->applyFromArray($styleArray2);
    $var++;
    $sheet->setCellValue('B' . $var, $result1['id_venta']);
    $sheet->setCellValue('C' . $var, $result1['id_user']);
    $sheet->setCellValue('D' . $var, $result1['apellidos']);
    $sheet->setCellValue('E' . $var, $result1['dni']);
    $sheet->setCellValue('F' . $var, $result1['direccion']);
    $sheet->setCellValue('G' . $var, $result1['ciudad']);
    $sheet->setCellValue('H' . $var, $result1['telefono']);
    $sheet->setCellValue('I' . $var, $result1['fecha_compra']);
    $sheet->setCellValue('J' . $var, $result1['estado']);
    $sheet->setCellValue('K' . $var, '$ '.$result1['montoFinal']);
    $sheet->getStyle('B' . $var . ':K' . $var)->getFont()->setSize(10);
    $var++;
    $sheet->setCellValue('C' . $var, 'COD. PROD.');
    $sheet->setCellValue('D' . $var, 'IMAGEN');
    $sheet->mergeCells('E' . $var . ':H' . $var);
    $sheet->setCellValue('E' . $var, 'NOMBRE');
    $sheet->setCellValue('I' . $var, 'CANT.');
    $sheet->setCellValue('J' . $var, 'PRECIO');
    $sheet->setCellValue('K' . $var, 'SUBTOTOTAL');
    $sheet->getStyle('C' . $var . ':K' . $var)->getFont()->setBold(true)->setSize(11);
    $sheet->getStyle('C' . $var . ':K' . $var)->applyFromArray($styleArray2);
    $var++;
    $sql2 = 'SELECT det_venta.*, productos.* FROM det_venta INNER JOIN productos ON productos.cod_producto = det_venta.cod_producto WHERE id_venta = '.$result1['id_venta'];
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
        $sheet->getStyle('C' . $var . ':K' . $var)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $sheet->mergeCells('E' . $var . ':H' . $var);
        $sheet->setCellValue('E' . $var, $result2['nombre']);
        $sheet->setCellValue('I' . $var, $result2['cantidad']);
        $sheet->setCellValue('J' . $var, '$ '.$result2['precio']);
        $sheet->setCellValue('K' . $var, '$ '.$result2['subtotal']);
        $sheet->getStyle('B' . $var . ':K' . $var)->getFont()->setSize(10);
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


$sheet->getStyle('B4:K' . $var - 1)->applyFromArray($styleArray1);
$sheet->getStyle('B4:K' . $var)->getFont()->setName('Arial');

$sheet->setTitle('Reporte de Pedidos(' . $date . ')');

//SET THE HEADER FIRST SO THE RESUTL WILL BE TREATED AS AN XLSX FILE
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
//MAKE IT AN ATTACHMENT SO WE CAN DEFINE FILENAME
header('Content-Disposition: attachment; filename="Reporte de Pedidos(' . $date . ').xlsx"');
//CREATE IOFactory OBJECT
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//SAVE INTO PHP OUTPUT
$writer->save('php://output');
