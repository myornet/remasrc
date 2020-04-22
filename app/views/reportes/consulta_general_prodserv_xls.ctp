<?php 
//debug($asincrono);
//debug($datos);
//debug($resumenByCentro);
//exit;

App::import('Vendor','PHPExcel',array('file' => 'excel/PHPExcel.php'));
App::import('Vendor','PHPExcelWriter',array('file' => 'excel/PHPExcel/Writer/Excel5.php'));

$oPHPExcel = new PHPExcel();

$oPHPExcel->getActiveSheet()->setTitle('REPORTE GENERAL');

$oPHPExcel->getActiveSheet()->setCellValue("A2",$asincrono['Asincrono']['titulo']);
$oPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);

$oPHPExcel->getActiveSheet()->setCellValue("A3","EMITIDAS DESDE EL " . date('d/m/Y', strtotime($asincrono['Asincrono']['p2'])) ." AL ".date('d/m/Y', strtotime($asincrono['Asincrono']['p3'])));

if(!empty($asincrono['Asincrono']['p1'])):
	$oPHPExcel->getActiveSheet()->setCellValue("A4",(!empty($centro) ? $centro . " | " : "") . $util->globalDato($asincrono['Asincrono']['p1']));
endif;
if(!empty($asincrono['Asincrono']['p4'])):
	$oPHPExcel->getActiveSheet()->setCellValue("A5",$util->globalDato($asincrono['Asincrono']['p4']));
endif;

if(!empty($datos)):
	$offSet = 7;
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
		foreach ($row as $field => $value) {
			$oPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($j++,$i, $value);
		}
		$i++;
	}
	
	//proceso el resumen
	if(!empty($resumenByBarrio)):
	
		$oPHPExcel->createSheet(1);
		$oPHPExcel->setActiveSheetIndex(1);
		$oPHPExcel->getActiveSheet()->setTitle('RESUMEN POR BARRIO');
		$oPHPExcel->getActiveSheet()->setCellValue("A2","RESUMEN POR BARRIO - ".$asincrono['Asincrono']['titulo']);
		$oPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);
		$oPHPExcel->getActiveSheet()->setCellValue("A3","EMITIDAS DESDE EL " . date('d/m/Y', strtotime($asincrono['Asincrono']['p2'])) ." AL ".date('d/m/Y', strtotime($asincrono['Asincrono']['p3'])));

		if(!empty($asincrono['Asincrono']['p1'])):
			$oPHPExcel->getActiveSheet()->setCellValue("A4",$util->globalDato($asincrono['Asincrono']['p1']));
		endif;
		if(!empty($asincrono['Asincrono']['p4'])):
			$oPHPExcel->getActiveSheet()->setCellValue("A5",$util->globalDato($asincrono['Asincrono']['p4']));
		endif;		
		
		$oPHPExcel->getActiveSheet()->setCellValue("A7","BARRIO");
		$oPHPExcel->getActiveSheet()->setCellValue("B7","PRODUCTO_SERVICIO");
		$oPHPExcel->getActiveSheet()->setCellValue("C7","ORDENES");
		$oPHPExcel->getActiveSheet()->setCellValue("D7","CANTIDAD");
		$oPHPExcel->getActiveSheet()->setCellValue("E7","IMPORTE");
		
		$oPHPExcel->getActiveSheet()->getStyle("A7")->getFont()->setBold(true);
		$oPHPExcel->getActiveSheet()->getStyle("A7")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$oPHPExcel->getActiveSheet()->getStyle("A7")->getFill()->getStartColor()->setRGB('969696');	

		$oPHPExcel->getActiveSheet()->duplicateStyle( $oPHPExcel->getActiveSheet()->getStyle("A7"), "B7:E7");
		
		$barrioActual = "";
		$row = 8;
		foreach($resumenByBarrio as $dato):
		
			if($dato['AsincronoTemporal']['texto_6'] != $barrioActual):
				$barrioActual = $dato['AsincronoTemporal']['texto_6'];
				$oPHPExcel->getActiveSheet()->setCellValue("A$row",$barrioActual);
				$oPHPExcel->getActiveSheet()->getStyle("A$row")->getFont()->setBold(true);
				$row++;
			endif;
			$oPHPExcel->getActiveSheet()->setCellValue("B$row",$dato['AsincronoTemporal']['texto_7']);
			$oPHPExcel->getActiveSheet()->setCellValue("C$row",$dato['AsincronoTemporal']['entero_1']);
			$oPHPExcel->getActiveSheet()->setCellValue("D$row",$dato['AsincronoTemporal']['entero_2']);
			$oPHPExcel->getActiveSheet()->setCellValue("E$row",$dato['AsincronoTemporal']['decimal_1']);
			$row++;
		
		endforeach;
		
		
	
	endif;
	
	if(!empty($resumenByProducto)):
	
		$oPHPExcel->createSheet(1);
		$oPHPExcel->setActiveSheetIndex(1);
		$oPHPExcel->getActiveSheet()->setTitle('RESUMEN POR PRODUCTO');
		$oPHPExcel->getActiveSheet()->setCellValue("A2","RESUMEN POR PRODUCTO - ".$asincrono['Asincrono']['titulo']);
		$oPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);
		$oPHPExcel->getActiveSheet()->setCellValue("A3","EMITIDAS DESDE EL " . date('d/m/Y', strtotime($asincrono['Asincrono']['p2'])) ." AL ".date('d/m/Y', strtotime($asincrono['Asincrono']['p3'])));

		if(!empty($asincrono['Asincrono']['p1'])):
			$oPHPExcel->getActiveSheet()->setCellValue("A4",$util->globalDato($asincrono['Asincrono']['p1']));
		endif;
		if(!empty($asincrono['Asincrono']['p4'])):
			$oPHPExcel->getActiveSheet()->setCellValue("A5",$util->globalDato($asincrono['Asincrono']['p4']));
		endif;		
		
		$oPHPExcel->getActiveSheet()->setCellValue("A7","PRODUCTO_SERVICIO");
		$oPHPExcel->getActiveSheet()->setCellValue("B7","BARRIO");
		$oPHPExcel->getActiveSheet()->setCellValue("C7","ORDENES");
		$oPHPExcel->getActiveSheet()->setCellValue("D7","CANTIDAD");
		$oPHPExcel->getActiveSheet()->setCellValue("E7","IMPORTE");
		
		$oPHPExcel->getActiveSheet()->getStyle("A7")->getFont()->setBold(true);
		$oPHPExcel->getActiveSheet()->getStyle("A7")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$oPHPExcel->getActiveSheet()->getStyle("A7")->getFill()->getStartColor()->setRGB('969696');	

		$oPHPExcel->getActiveSheet()->duplicateStyle( $oPHPExcel->getActiveSheet()->getStyle("A7"), "B7:E7");
				
		$productoActual = "";
		$row = 8;
		foreach($resumenByProducto as $dato):
		
			if($dato['AsincronoTemporal']['texto_7'] != $productoActual):
				$productoActual = $dato['AsincronoTemporal']['texto_7'];
				$oPHPExcel->getActiveSheet()->setCellValue("A$row",$productoActual);
				$oPHPExcel->getActiveSheet()->getStyle("A$row")->getFont()->setBold(true);
				$row++;
			endif;
			$oPHPExcel->getActiveSheet()->setCellValue("B$row",$dato['AsincronoTemporal']['texto_6']);
			$oPHPExcel->getActiveSheet()->setCellValue("C$row",$dato['AsincronoTemporal']['entero_1']);
			$oPHPExcel->getActiveSheet()->setCellValue("D$row",$dato['AsincronoTemporal']['entero_2']);
			$oPHPExcel->getActiveSheet()->setCellValue("E$row",$dato['AsincronoTemporal']['decimal_1']);
			
			$row++;
		
		endforeach;
		
		
	
	endif;

	if(!empty($resumenByCentro)):
	
		$oPHPExcel->createSheet(1);
		$oPHPExcel->setActiveSheetIndex(1);
		$oPHPExcel->getActiveSheet()->setTitle('RESUMEN POR CENTRO DE ATENCION');
		$oPHPExcel->getActiveSheet()->setCellValue("A2","RESUMEN POR PRODUCTO - ".$asincrono['Asincrono']['titulo']);
		$oPHPExcel->getActiveSheet()->getStyle("A2")->getFont()->setBold(true);
		$oPHPExcel->getActiveSheet()->setCellValue("A3","EMITIDAS DESDE EL " . date('d/m/Y', strtotime($asincrono['Asincrono']['p2'])) ." AL ".date('d/m/Y', strtotime($asincrono['Asincrono']['p3'])));

		if(!empty($asincrono['Asincrono']['p1'])):
			$oPHPExcel->getActiveSheet()->setCellValue("A4",$util->globalDato($asincrono['Asincrono']['p1']));
		endif;
		if(!empty($asincrono['Asincrono']['p4'])):
			$oPHPExcel->getActiveSheet()->setCellValue("A5",$util->globalDato($asincrono['Asincrono']['p4']));
		endif;		
		
		$oPHPExcel->getActiveSheet()->setCellValue("A7","CENTRO");
		$oPHPExcel->getActiveSheet()->setCellValue("B7","PRODUCTO_SERVICIO");
		$oPHPExcel->getActiveSheet()->setCellValue("C7","ORDENES");
		$oPHPExcel->getActiveSheet()->setCellValue("D7","CANTIDAD");
		$oPHPExcel->getActiveSheet()->setCellValue("E7","IMPORTE");
		
		$oPHPExcel->getActiveSheet()->getStyle("A7")->getFont()->setBold(true);
		$oPHPExcel->getActiveSheet()->getStyle("A7")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID);
		$oPHPExcel->getActiveSheet()->getStyle("A7")->getFill()->getStartColor()->setRGB('969696');	

		$oPHPExcel->getActiveSheet()->duplicateStyle( $oPHPExcel->getActiveSheet()->getStyle("A7"), "B7:E7");
				
		$centroActual = "";
		$row = 8;
		foreach($resumenByCentro as $dato):
		
			if($dato['AsincronoTemporal']['texto_10'] != $centroActual):
				$centroActual = $dato['AsincronoTemporal']['texto_10'];
				$oPHPExcel->getActiveSheet()->setCellValue("A$row",$centroActual);
				$oPHPExcel->getActiveSheet()->getStyle("A$row")->getFont()->setBold(true);
				$row++;
			endif;
			$oPHPExcel->getActiveSheet()->setCellValue("B$row",$dato['AsincronoTemporal']['texto_7']);
			$oPHPExcel->getActiveSheet()->setCellValue("C$row",$dato['AsincronoTemporal']['entero_1']);
			$oPHPExcel->getActiveSheet()->setCellValue("D$row",$dato['AsincronoTemporal']['entero_2']);
			$oPHPExcel->getActiveSheet()->setCellValue("E$row",$dato['AsincronoTemporal']['decimal_1']);			
			$row++;
		
		endforeach;
		
		
	
	endif;	
	
	
else:

	$oPHPExcel->getActiveSheet()->setCellValue("A7","*** NO EXISTEN DATOS PARA EL CRITERIO INDICADO ***");

endif;

$oPHPExcel->setActiveSheetIndex(0);
header("Content-type: application/vnd.ms-excel"); 
header('Content-Disposition: attachment;filename="consulta_general_prodserv.xls"');
header('Cache-Control: max-age=0');
$objWriter = new PHPExcel_Writer_Excel5($oPHPExcel);
$objWriter->setTempDir(TMP);
$objWriter->save('php://output');

?>