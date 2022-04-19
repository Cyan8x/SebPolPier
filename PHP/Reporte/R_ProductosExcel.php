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

$sheet->mergeCells('D2:G2');
$sheet->setCellValue('D2', 'REPORTE DE PRODUCTOS(' . $date . ')');
$styleArray0 = [
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
];
$sheet->getStyle('D2')->getFont()->setName('Arial')->setBold(true)->setSize(20)->setUnderline(true);
$sheet->getStyle('D2')->applyFromArray($styleArray0);

$sheet->setCellValue('B4', ' CODIGO DE PRODUCTO ');
$sheet->setCellValue('C4', 'MARCA');
$sheet->setCellValue('D4', 'CATEGORIA');
$sheet->setCellValue('E4', 'PROVEEDOR');
$sheet->setCellValue('F4', 'COD. ORIGINAL');
$sheet->setCellValue('G4', '   IMAGEN   ');
$sheet->setCellValue('H4', 'NOMBRE');
$sheet->setCellValue('I4', ' STOCK ');
$sheet->setCellValue('J4', ' PRECIO');
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

$sql = 'SELECT productos.*, marcas.marca AS marc, categorias.categoria AS categ, proveedores.proveedor AS prov FROM productos INNER JOIN marcas ON productos.cod_marca = marcas.cod_marca INNER JOIN categorias ON productos.cod_categoria = categorias.cod_categoria INNER JOIN proveedores ON productos.cod_prov = proveedores.cod_prov';
$var = 4;
foreach ($connection->query($sql) as $result) {
    $var++;
    $sheet->setCellValue('B' . $var, $result['cod_producto']);
    $sheet->setCellValue('C' . $var, $result['marc']);
    $sheet->setCellValue('D' . $var, $result['categ']);
    $sheet->setCellValue('E' . $var, $result['prov']);
    $sheet->setCellValue('F' . $var, $result['cod_orig_prod']);
    $sheeti = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $sheeti->setPath('../../imagenes/' . $result['imagen']);
    $sheeti->setHeight(100);
    $sheeti->setCoordinates('G' . $var);
    $sheet->getRowDimension($var)->setRowHeight(80);
    $sheeti->setOffsetX(0);
    $sheeti->setOffsetY(0);
    $sheeti->setWorksheet($sheet);
    $sheet->getStyle('B' . $var . ':K' . $var)->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    $sheet->setCellValue('H' . $var,$result['nombre']);
    $sheet->setCellValue('I' . $var, $result['stock']);
    $sheet->setCellValue('J' . $var, '$ ' . $result['precio']);
}

$sheet->getStyle('B5:J' . $var)->getFont()->setSize(10);
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
$sheet->getStyle('B4:J' . $var)->applyFromArray($styleArray1);
$sheet->getStyle('B4:J' . $var)->getFont()->setName('Arial');
$styleArray2 = [
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => [
            'argb' => 'D1D1D1',
        ],
    ],
];
$sheet->getStyle('B4:J4')->applyFromArray($styleArray2);
$sheet->setTitle('Reporte de Productos(' . $date . ')');

//SET THE HEADER FIRST SO THE RESUTL WILL BE TREATED AS AN XLSX FILE
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
//MAKE IT AN ATTACHMENT SO WE CAN DEFINE FILENAME
header('Content-Disposition: attachment; filename="Reporte de Productos(' . $date . ').xlsx"');
//CREATE IOFactory OBJECT
$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
//SAVE INTO PHP OUTPUT
$writer->save('php://output');





















// PhpSpreadsheet proporciona una interfaz API rica, puede establecer muchas propiedades de celda y documento, incluidos estilos, imágenes, fechas, funciones y muchas otras aplicaciones, en resumen, qué tipo de tabla de Excel desea, puede hacer PhpSpreadsheet.

//  Al depurar la configuración, asegúrese de que los archivos correctos sean importados y instanciados.

// use PhpOffice\PhpSpreadsheet\Spreadsheet;

// $spreadsheet = new Spreadsheet();
// $worksheet = $spreadsheet->getActiveSheet();
//  Fuente
//  La primera línea de código establece las celdas A7 a B7 en negrita, fuente Arial, tamaño 10; la segunda línea de código establece la celda B1 en negrita.

// $spreadsheet->getActiveSheet()->getStyle('A7:B7')->getFont()->setBold(true)->setName('Arial')
//     ->setSize(10);;
// $spreadsheet->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
//  color 
//  Establece el color del texto en rojo.

// $spreadsheet->getActiveSheet()->getStyle('A4')
//     ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
//  Imágenes
//  Puede cargar imágenes en Excel.

// $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
// $drawing->setName('Logo');
// $drawing->setDescription('Logo');
// $drawing->setPath('./images/officelogo.jpg');
// $drawing->setHeight(36);
//  Ancho de columna
//  Establezca el ancho de la columna A en 30 (caracteres).

// $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(30);
//  Si necesita calcular el ancho de columna automáticamente, puede hacer esto:

// $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
//  Establezca el ancho de columna predeterminado en 12.

// $spreadsheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(12);
//  Altura de la fila
//  Establezca la altura de la línea de 10 a 100pt.

// $spreadsheet->getActiveSheet()->getRowDimension('10')->setRowHeight(100);
//  Establece la altura de línea predeterminada.

// $spreadsheet->getActiveSheet()->getDefaultRowDimension()->setRowHeight(15);
//  Alinear
//  Configure la celda A1 para que se alinee en el centro horizontalmente.

// $styleArray = [
//     'alignment' => [
//         'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
//     ],
// ];
// $worksheet->getStyle('A1')->applyFromArray($styleArray);
//  Unir
//  Combina A18 a E22 en una celda.

// $spreadsheet->getActiveSheet()->mergeCells('A18:E22');
//  División
//  Dividir las celdas combinadas.

// $spreadsheet->getActiveSheet()->unmergeCells('A18:E22');
//  Frontera
//  Agregue un borde rojo al área de B2 a G8.

// $styleArray = [
//     'borders' => [
//         'outline' => [
//             'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
//             'color' => ['argb' => 'FFFF0000'],
//         ],
//     ],
// ];
// $worksheet->getStyle('B2:G8')->applyFromArray($styleArray);
//  Título de la hoja de trabajo
//  Establecer el título actual de la hoja de trabajo.

// $spreadsheet->getActiveSheet()->setTitle('Hello');
//  Fecha y hora
//  Establece el formato de fecha.

// $spreadsheet->getActiveSheet()
//     ->setCellValue('D1', '2018-06-15');

// $spreadsheet->getActiveSheet()->getStyle('D1')
//     ->getNumberFormat()
//     ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_YYYYMMDD2);
//  Salto de línea
//  Use \ n para realizar un salto de línea en la celda, que es equivalente a (ALT + "Enter").

// $spreadsheet->getActiveSheet()->getCell('A4')->setValue("hello\nworld");
// $spreadsheet->getActiveSheet()->getStyle('A4')->getAlignment()->setWrapText(true);
//  Hipervínculo 
//  Establezca la celda en un formulario de hipervínculo.

// $spreadsheet->getActiveSheet()->setCellValue('E6', 'www.helloweba.net');
// $spreadsheet->getActiveSheet()->getCell('E6')->getHyperlink()->setUrl('https://www.helloweba.net');
//  Utilizar la función
//  Use SUM para calcular la suma de celdas de B5 a C5. Lo mismo es cierto para otras funciones: número máximo (MAX), número mínimo (MIN), valor promedio (PROMEDIO).

// $spreadsheet->getActiveSheet()
//     ->setCellValue('B7', '=SUM(B5:C5)');
//  Establecer propiedades del documento
//  Puede establecer las propiedades del documento de Excel.

// $spreadsheet->getProperties()
//          -> setCreator ("Helloweba") // Autor
//          -> setLastModifiedBy ("Yuegg") // Último modificador
//          -> setTitle ("Documento de prueba de Office 2007 XLSX") // Título
//          -> setSubject ("Documento de prueba XLSX de Office 2007") // Subtítulo
//          -> setDescription ("Documento de prueba para Office 2007 XLSX, generado usando clases PHP") // Descripción
//          -> setKeywords ("office 2007 openxml php") // Palabras clave
//          -> setCategory ("Archivo de resultados de prueba"); // Clasificación
//  Además, además de proporcionar una rica interfaz de procesamiento de archivos de Excel, PhpSpreadshee también proporciona una interfaz de procesamiento de archivos CSV, PDF, HTML y XML.

//  Para obtener más configuraciones de uso, consulte el documento oficial del sitio web: https://phpspreadsheet.readthedocs.io/en/stable/.
