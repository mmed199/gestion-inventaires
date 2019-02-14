<?php 
App::import('Vendor','Excel',array('file' => 'excel/excel.php'));
App::import('Vendor','PHPExcelWriter',array('file' => 'excel/excel/Writer/Excel5.php'));

// Set document properties
$objExcel->getProperties()->setCreator("Maarten Balliauw")
->setLastModifiedBy("Maarten Balliauw")
->setTitle("Office 2007 XLSX Test Document")
->setSubject("Office 2007 XLSX Test Document")
->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
->setKeywords("office 2007 openxml php")
->setCategory("Test result file");


// Add some data
$objExcel->setActiveSheetIndex(0)
->setCellValue('A1', 'Hello')
->setCellValue('B2', 'world!')
->setCellValue('C1', 'Hello')
->setCellValue('D2', 'world!');

// Miscellaneous glyphs, UTF-8
$objExcel->setActiveSheetIndex(0)
->setCellValue('A4', 'Miscellaneous glyphs')
->setCellValue('A5', 'Miscellaneous glyphs');

// Rename worksheet
$objExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="01simple.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objExcel, 'Excel5');
$objWriter->save('php://output');
exit;

?>