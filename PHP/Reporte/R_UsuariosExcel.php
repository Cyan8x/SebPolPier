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

$sheet->mergeCells('C2:D2');
$sheet->setCellValue('C2', 'REPORTE DE USUARIOS('.$date.')');
$styleArray0 = [
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
];
$sheet->getStyle('C2')->getFont()->setName('Arial')->setBold(true)->setSize(15)->setUnderline(true);
$sheet->getStyle('C2')->applyFromArray($styleArray0);

$sheet->setCellValue('B4', 'ID');
$sheet->setCellValue('C4', 'EMAIL');
$sheet->setCellValue('D4', 'NOMBRES');
$sheet->setCellValue('E4', 'APELLIDOS');
$sheet->getStyle('B4:E4')->getFont()->setBold(true)->setSize(11);
$sheet->getColumnDimension('B')->setAutoSize(true);
$sheet->getColumnDimension('C')->setAutoSize(true);
$sheet->getColumnDimension('D')->setAutoSize(true);
$sheet->getColumnDimension('E')->setAutoSize(true);

require("./../Login/includes_login/connection.php");

$sql = 'SELECT * FROM usuarios';
$var = 4;
foreach ($connection->query($sql) as $result) {
    $var++;
    $sheet->setCellValue('B'.$var, $result['id_user']);
    $sheet->setCellValue('C'.$var, $result['email']);
    $sheet->setCellValue('D'.$var, $result['nombres']);
    $sheet->setCellValue('E'.$var, $result['apellidos']);
}

$sheet->getStyle('B5:E'.$var)->getFont()->setSize(10);
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
$sheet->getStyle('B4:E'.$var)->applyFromArray($styleArray1);
$sheet->getStyle('B4:E'.$var)->getFont()->setName('Arial');
$styleArray2 = [
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => [
            'argb' => 'D1D1D1',
        ],
    ],
];
$sheet->getStyle('B4:E4')->applyFromArray($styleArray2);
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