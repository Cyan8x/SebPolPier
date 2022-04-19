<?php
//CALL THE AUTOLOAD
require ("./vendor/autoload.php");
//LOAD PHPSPREADSHEET CLASS USING NAMESPACE
use PhpOffice\PhpSpreadsheet\Spreadsheet;
//CALL XLSX WRITER CLASS TO MAKE AN XLSX FILE
use PhpOffice\PhpSpreadsheet\IOFactory;
//MAKE A NEW ASPREASHEET OBJECT
$spreadsheet = new Spreadsheet();
//GET CURRENT ACTIVE SHEET (FIRST SHEET)
$date =  date('j-m-y');

$sheet = $spreadsheet->getActiveSheet();

$sheet->mergeCells('D2:H2');
$sheet->setCellValue('D2', 'REPORTE DE USUARIOS('.$date.')');
$styleArray0 = [
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
];
$sheet->getStyle('D2')->getFont()->setName('Arial')->setBold(true)->setSize(20)->setUnderline(true);
$sheet->getStyle('D2')->applyFromArray($styleArray0);

$sheet->setCellValue('B4', 'ID');
$sheet->setCellValue('C4', 'USUARIO');
$sheet->setCellValue('D4', 'EMAIL');
$sheet->setCellValue('E4', 'NOMBRES');
$sheet->setCellValue('F4', 'APELLIDOS');
$sheet->setCellValue('G4', 'DNI');
$sheet->setCellValue('H4', 'DIRECCION');
$sheet->setCellValue('I4', ' CIUDAD ');
$sheet->setCellValue('J4', ' TELEFONO ');
$sheet->getStyle('B4:J4')->getFont()->setBold(true)->setSize(11);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);
$sheet->getColumnDimension('F')->setAutoSize(true);
$sheet->getColumnDimension('G')->setAutoSize(true);
$sheet->getColumnDimension('H')->setAutoSize(true);
$sheet->getColumnDimension('I')->setAutoSize(true);
$sheet->getColumnDimension('J')->setAutoSize(true);

require("./../Login/includes_login/connection.php");

$sql = 'SELECT * FROM usuarios';
$var = 4;
foreach ($connection->query($sql) as $result) {
    $var++;
    $sheet->setCellValue('B'.$var, $result['id_user']);
    $sheet->setCellValue('C'.$var, $result['usuario']);
    $sheet->setCellValue('D'.$var, $result['email']);
    $sheet->setCellValue('E'.$var, $result['nombres']);
    $sheet->setCellValue('F'.$var, $result['apellidos']);
    $sheet->setCellValue('G'.$var, $result['dni']);
    $sheet->setCellValue('H'.$var, $result['direccion']);
    $sheet->setCellValue('I'.$var, $result['ciudad']);
    $sheet->setCellValue('J'.$var, $result['telefono']);
}

$sheet->getStyle('B5:J'.$var)->getFont()->setSize(10);
$styleArray1 = [
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            ],
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => [
                'argb' => 'ffffff',
            ],
        ],
];
$sheet->getStyle('B4:J'.$var)->applyFromArray($styleArray1);
$sheet->getStyle('B4:J'.$var)->getFont()->setName('Arial');
$styleArray2 = [
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => [
            'argb' => 'D1D1D1',
        ],
    ],
];
$sheet->getStyle('B4:J4')->applyFromArray($styleArray2);
$sheet->setTitle('Reporte de Usuarios('.$date.')');

//SET THE HEADER FIRST SO THE RESUTL WILL BE TREATED AS AN XLSX FILE
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
//MAKE IT AN ATTACHMENT SO WE CAN DEFINE FILENAME
header('Content-Disposition: attachment; filename="Reporte de Usuarios('.$date.').xlsx"');
//CREATE IOFactory OBJECT
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//SAVE INTO PHP OUTPUT
$writer->save('php://output');
?>