<?php 

//DEBUG($datos);

App::import('Vendor','PHPExcel',array('file' => 'excel/PHPExcel.php'));
App::import('Vendor','PHPExcelWriter',array('file' => 'excel/PHPExcel/Writer/Excel5.php'));

$oPHPExcel = new PHPExcel();

$oPHPExcel->getActiveSheet()->setTitle('REPORTE GENERAL');
$oPHPExcel->getActiveSheet()->setCellValue("A1",$asincrono['Asincrono']['titulo']);
$oPHPExcel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);

if(!empty($datos)):
	$offSet = 3;
	$i=0;
	foreach ($datos[0] as $field => $value) {
		$columnName = Inflector::humanize($field);
		$oPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($i++, $offSet, $columnName);
	}
	$oPHPExcel->getActiveSheet()->getStyle("A$offSet")->getFont()->setBold(true);
	$oPHPExcel->getActiveSheet()->getStyle("A$offSet")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
	$oPHPExcel->getActiveSheet()->getStyle("A$offSet")->getFill()->getStartColor()->setRGB('969696');
	$oPHPExcel->getActiveSheet()->duplicateStyle( $oPHPExcel->getActiveSheet()->getStyle("A$offSet"), "B$offSet:".$oPHPExcel->getActiveSheet()->getHighestColumn().$offSet);
	for ($j=1; $j<$i; $j++) {
		$oPHPExcel->getActiveSheet()->getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($j))->setAutoSize(true);
	}
	$i = $offSet + 1;
	foreach ($datos as $row) {
		$j=0;
		$isTitular = false;
		foreach ($row as $field => $value) {
			$oPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j,$i, $value);
			if($j == 1 && $value == 'TITULAR') $isTitular = true;
			$j++;
		}
		if($isTitular && $asincrono['Asincrono']['p17'] == 'TITULARES_ADICIONALES'):
			$oPHPExcel->getActiveSheet()->getStyle("A$i")->getFont()->setBold(true);
			$oPHPExcel->getActiveSheet()->getStyle("A$i")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
			$oPHPExcel->getActiveSheet()->getStyle("A$i")->getFill()->getStartColor()->setRGB('8AAEC6');				
			$oPHPExcel->getActiveSheet()->duplicateStyle( $oPHPExcel->getActiveSheet()->getStyle("A$i"), "B$i:".$oPHPExcel->getActiveSheet()->getHighestColumn()."$i");
		endif;
		$i++;
	}
	
else:

	$oPHPExcel->getActiveSheet()->setCellValue("A7","*** NO EXISTEN DATOS PARA EL CRITERIO INDICADO ***");	
	
endif;

$oPHPExcel->setActiveSheetIndex(0);
header("Content-type: application/vnd.ms-excel"); 
header('Content-Disposition: attachment;filename="padron_beneficiarios.xls"');
header('Cache-Control: max-age=0');
$objWriter = new PHPExcel_Writer_Excel5($oPHPExcel);
$objWriter->setTempDir(TMP);
$objWriter->save('php://output');


?>