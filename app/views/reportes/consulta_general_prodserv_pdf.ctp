<?php 
//debug($resumenByBarrio);
//exit;

App::import('Vendor','listado_pdf');

$PDF = new ListadoPDF("L");

$PDF->SetTitle("REPORTE GENERAL DE ORDENES DE PRODUCTOS / SERVICIOS");
$PDF->SetFontSizeConf(8.5);


$PDF->Open();

$PDF->titulo['titulo1'] = (!empty($centro) ? $centro . " | " : "") . (!empty($asincrono['Asincrono']['p1']) ? $util->globalDato($asincrono['Asincrono']['p1']) : "PROD/SERV:TODOS") . " | " . (!empty($asincrono['Asincrono']['p4']) ? $util->globalDato($asincrono['Asincrono']['p4']) : "BARRIO:TODOS");
$PDF->titulo['titulo2'] = "DESDE ".date('d-m-Y' , strtotime($util->armaFecha($asincrono['Asincrono']['p2']))) . " AL " . date('d-m-Y' , strtotime($util->armaFecha($asincrono['Asincrono']['p3'])));
$PDF->titulo['titulo3'] = "ORDENES DE PRODUCTOS / SERVICIOS";

//encabezado columnas
//APAISADO 277

$fontSizeHeader = 6;
$W1 = array(25,50,52,35,15,20,5,20,10,20,25);
$L1 = $PDF->armaAnchoColumnas($W1);	

$PDF->encabezado[0][0] = array(
			'posx' => $L1[0],
			'ancho' => $W1[0],
			'texto' => "DOCUMENTO",
			'borde' => 'TLB',
			'align' => 'C',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#ccc',
			'size' => $fontSizeHeader
);	
$PDF->encabezado[0][1] = array(
			'posx' => $L1[1],
			'ancho' => $W1[1],
			'texto' => "BENEFICIARIO",
			'borde' => 'TB',
			'align' => 'C',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#ccc',
			'size' => $fontSizeHeader
);
$PDF->encabezado[0][2] = array(
			'posx' => $L1[2],
			'ancho' => $W1[2],
			'texto' => "DOMICILIO",
			'borde' => 'TB',
			'align' => 'C',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#ccc',
			'size' => $fontSizeHeader
);

$PDF->encabezado[0][3] = array(
			'posx' => $L1[3],
			'ancho' => $W1[3],
			'texto' => "BARRIO",
			'borde' => 'TB',
			'align' => 'C',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#ccc',
			'size' => $fontSizeHeader
);
$PDF->encabezado[0][4] = array(
			'posx' => $L1[4],
			'ancho' => $W1[4],
			'texto' => "NRO.ORD.",
			'borde' => 'TB',
			'align' => 'C',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#ccc',
			'size' => $fontSizeHeader
);
$PDF->encabezado[0][5] = array(
			'posx' => $L1[5],
			'ancho' => $W1[5],
			'texto' => "FECHA",
			'borde' => 'TB',
			'align' => 'C',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#ccc',
			'size' => $fontSizeHeader
);
$PDF->encabezado[0][6] = array(
			'posx' => $L1[6],
			'ancho' => $W1[6],
			'texto' => "PERM",
			'borde' => 'TB',
			'align' => 'C',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#ccc',
			'size' => $fontSizeHeader
);
$PDF->encabezado[0][7] = array(
			'posx' => $L1[7],
			'ancho' => $W1[7],
			'texto' => "HASTA",
			'borde' => 'TB',
			'align' => 'C',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#ccc',
			'size' => $fontSizeHeader
);
$PDF->encabezado[0][8] = array(
			'posx' => $L1[8],
			'ancho' => $W1[8],
			'texto' => "CANTIDAD",
			'borde' => 'TB',
			'align' => 'C',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#ccc',
			'size' => $fontSizeHeader
);
$PDF->encabezado[0][9] = array(
			'posx' => $L1[9],
			'ancho' => $W1[9],
			'texto' => "IMPORTE",
			'borde' => 'TB',
			'align' => 'C',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#ccc',
			'size' => $fontSizeHeader
);
$PDF->encabezado[0][10] = array(
			'posx' => $L1[10],
			'ancho' => $W1[10],
			'texto' => "CENTRO",
			'borde' => 'TBR',
			'align' => 'C',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#ccc',
			'size' => $fontSizeHeader
);
$PDF->AddPage();
$PDF->Reset();


if(!empty($datos)):

	$fontSize = 8;
	$primero = true;
	$prodActual = null;
	
	$ACU_CANTIDAD = 0;
	$ACU_IMPORTE = 0;
	$ACU_ORDENES = 0;
	
	$ACU_CANTIDAD_TOTAL = 0;
	$ACU_IMPORTE_TOTAL = 0;	
	
	foreach($datos as $dato):
	
	
		if($prodActual != $dato['texto_1']):
			
			
			if($primero):
			
				$primero = false;
			
			else:
				//$W1 = array(25,50,52,35,15,20,5,20,10,20,25);
				$PDF->linea[0] = array(
							'posx' => $L1[0],
							'ancho' => 222,
							'texto' => "TOTAL " . $util->globalDato($prodActual),
							'borde' => 'T',
							'align' => 'R',
							'fondo' => 0,
							'style' => 'B',
							'colorf' => '#ccc',
							'size' => $fontSize
				);
				$PDF->linea[8] = array(
							'posx' => $L1[8],
							'ancho' => $W1[8],
							'texto' => $ACU_CANTIDAD,
							'borde' => 'T',
							'align' => 'R',
							'fondo' => 0,
							'style' => 'B',
							'colorf' => '#ccc',
							'size' => $fontSize
				);
				$PDF->linea[9] = array(
							'posx' => $L1[9],
							'ancho' => $W1[9],
							'texto' => $util->nf($ACU_IMPORTE),
							'borde' => 'T',
							'align' => 'R',
							'fondo' => 0,
							'style' => 'B',
							'colorf' => '#ccc',
							'size' => $fontSize
				);
				$PDF->linea[10] = array(
							'posx' => $L1[10],
							'ancho' => $W1[10],
							'texto' => "",
							'borde' => 'T',
							'align' => 'R',
							'fondo' => 0,
							'style' => 'B',
							'colorf' => '#ccc',
							'size' => $fontSize
				);								
				$PDF->Imprimir_linea();	
				$ACU_CANTIDAD = 0;
				$ACU_IMPORTE = 0;
				
							
			endif;
			
			$prodActual = $dato['texto_1'];
			
			
			$PDF->linea[0] = array(
						'posx' => $L1[0],
						'ancho' => $W1[0],
						'texto' => $dato['texto_7'],
						'borde' => '',
						'align' => 'L',
						'fondo' => 0,
						'style' => 'B',
						'colorf' => '#ccc',
						'size' => 12
			);
			$PDF->ln(5);
			$PDF->Imprimir_linea();				
		
		endif;
		
		$ACU_CANTIDAD += $dato['entero_2'];
		$ACU_IMPORTE += $dato['decimal_1'];
		
		$ACU_CANTIDAD_TOTAL += $dato['entero_2'];
		$ACU_IMPORTE_TOTAL += $dato['decimal_1'];	

		$ACU_ORDENES++;
		
		$PDF->linea[0] = array(
					'posx' => $L1[0],
					'ancho' => $W1[0],
					'texto' => $dato['texto_3'],
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSize
		);		
		$PDF->linea[1] = array(
					'posx' => $L1[1],
					'ancho' => $W1[1],
					'texto' => substr($dato['texto_4'],0,27),
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSize
		);
		$PDF->linea[2] = array(
					'posx' => $L1[2],
					'ancho' => $W1[2],
					'texto' => substr($dato['texto_5'],0,30),
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSize
		);	
		$PDF->linea[3] = array(
					'posx' => $L1[3],
					'ancho' => $W1[3],
					'texto' => substr($dato['texto_6'],0,20),
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSize
		);	

		$PDF->linea[4] = array(
					'posx' => $L1[4],
					'ancho' => $W1[4],
					'texto' => "#".$dato['entero_1'],
					'borde' => '',
					'align' => 'R',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSize
		);		
		$PDF->linea[5] = array(
					'posx' => $L1[5],
					'ancho' => $W1[5],
					'texto' => $dato['texto_11'],
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSize
		);
		$PDF->linea[6] = array(
					'posx' => $L1[6],
					'ancho' => $W1[6],
					'texto' => $dato['texto_8'],
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSize
		);
		$PDF->linea[7] = array(
					'posx' => $L1[7],
					'ancho' => $W1[7],
					'texto' => $dato['texto_12'],
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSize
		);
		$PDF->linea[8] = array(
					'posx' => $L1[8],
					'ancho' => $W1[8],
					'texto' => $dato['entero_2'],
					'borde' => '',
					'align' => 'R',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSize
		);
		$PDF->linea[9] = array(
					'posx' => $L1[9],
					'ancho' => $W1[9],
					'texto' => $util->nf($dato['decimal_1']),
					'borde' => '',
					'align' => 'R',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSize
		);

		$PDF->linea[10] = array(
					'posx' => $L1[10],
					'ancho' => $W1[10],
					'texto' => substr($dato['texto_10'],0,14),
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSize
		);		
		
		$PDF->Imprimir_linea();
	
	
	endforeach;
	
	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => 222,
				'texto' => "TOTAL " . $util->globalDato($prodActual),
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSize
	);
	$PDF->linea[8] = array(
				'posx' => $L1[8],
				'ancho' => $W1[8],
				'texto' => $ACU_CANTIDAD,
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSize
	);
	$PDF->linea[9] = array(
				'posx' => $L1[9],
				'ancho' => $W1[9],
				'texto' => $util->nf($ACU_IMPORTE),
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSize
	);
	$PDF->linea[10] = array(
				'posx' => $L1[10],
				'ancho' => $W1[10],
				'texto' => "",
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSize
	);								
	$PDF->Imprimir_linea();	
	
	$PDF->ln(3);
	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => 222,
				'texto' => "TOTAL GENERAL (SOBRE $ACU_ORDENES ORDENES EMITIDAS)",
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSize
	);
	$PDF->linea[8] = array(
				'posx' => $L1[8],
				'ancho' => $W1[8],
				'texto' => $ACU_CANTIDAD_TOTAL,
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSize
	);
	$PDF->linea[9] = array(
				'posx' => $L1[9],
				'ancho' => $W1[9],
				'texto' => $util->nf($ACU_IMPORTE_TOTAL),
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSize
	);
	$PDF->linea[10] = array(
				'posx' => $L1[10],
				'ancho' => $W1[10],
				'texto' => "",
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSize
	);								
	$PDF->Imprimir_linea();		

else:

	$PDF->linea[1] = array(
				'posx' => $L1[1],
				'ancho' => $W1[1],
				'texto' => "*** NO EXISTEN DATOS PARA EL CRITERIO INDICADO ***",
				'borde' => '',
				'align' => 'L',
				'fondo' => 0,
				'style' => '',
				'colorf' => '#ccc',
				'size' => $fontSize
	);
	$PDF->Imprimir_linea();

endif;

if(!empty($resumenByBarrio)):

	$PDF->AddPage();
	$PDF->Reset();
	
	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => $W1[0],
				'texto' => "RESUMEN GENERAL POR BARRIO",
				'borde' => '',
				'align' => 'L',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 12
	);
	$PDF->ln(5);
	$PDF->Imprimir_linea();	
	//$W1 = array(25,50,52,35,15,20,5,20,10,20,25);
	$p = array(10,110,150,190);
	$w1 = 100;
	$w2 = 40;
	$PDF->linea[0] = array(
				'posx' => $p[0],
				'ancho' => $w1,
				'texto' => "",
				'borde' => 'LTB',
				'align' => 'L',
				'fondo' => 0,
				'style' => '',
				'colorf' => '#ccc',
				'size' => 10
	);
	$PDF->linea[1] = array(
				'posx' => $p[1],
				'ancho' => $w2,
				'texto' => "ORDENES",
				'borde' => 'TB',
				'align' => 'R',
				'fondo' => 0,
				'style' => '',
				'colorf' => '#ccc',
				'size' => 10
	);		
	$PDF->linea[2] = array(
				'posx' => $p[2],
				'ancho' => $w2,
				'texto' => "CANTIDAD",
				'borde' => 'TB',
				'align' => 'R',
				'fondo' => 0,
				'style' => '',
				'colorf' => '#ccc',
				'size' => 10
	);	
	$PDF->linea[3] = array(
				'posx' => $p[3],
				'ancho' => $w2,
				'texto' => "IMPORTE",
				'borde' => 'TBR',
				'align' => 'R',
				'fondo' => 0,
				'style' => '',
				'colorf' => '#ccc',
				'size' => 10
	);					
	$PDF->Imprimir_linea();		
	
	$actual = null;

	$ACU_ORDENES = 0;
	$ACU_CANTIDAD = 0;
	$ACU_IMPORTE = 0;	
	
	$ACU_ORDENES_TOTAL = 0;
	$ACU_CANTIDAD_TOTAL = 0;
	$ACU_IMPORTE_TOTAL = 0;	
	
	$primero = true;
	
	foreach($resumenByBarrio as $dato):
	
	
		if($actual != $dato['AsincronoTemporal']['texto_6']):
		
		
			if($primero):
				
				$primero = false;
				
			else:
			
				$PDF->linea[0] = array(
							'posx' => $L1[0],
							'ancho' => $w1,
							'texto' => "TOTAL",
							'borde' => 'T',
							'align' => 'L',
							'fondo' => 0,
							'style' => 'B',
							'colorf' => '#ccc',
							'size' => 10
				);
				$PDF->linea[1] = array(
							'posx' => $p[1],
							'ancho' => $w2,
							'texto' => $ACU_ORDENES,
							'borde' => 'T',
							'align' => 'R',
							'fondo' => 0,
							'style' => 'B',
							'colorf' => '#ccc',
							'size' => 10
				);		
				$PDF->linea[2] = array(
							'posx' => $p[2],
							'ancho' => $w2,
							'texto' => $ACU_CANTIDAD,
							'borde' => 'T',
							'align' => 'R',
							'fondo' => 0,
							'style' => 'B',
							'colorf' => '#ccc',
							'size' => 10
				);	
				$PDF->linea[3] = array(
							'posx' => $p[3],
							'ancho' => $w2,
							'texto' => $util->nf($ACU_IMPORTE),
							'borde' => 'T',
							'align' => 'R',
							'fondo' => 0,
							'style' => 'B',
							'colorf' => '#ccc',
							'size' => 10
				);			
				$PDF->Imprimir_linea();	
				$ACU_ORDENES = 0;
				$ACU_CANTIDAD = 0;
				$ACU_IMPORTE = 0;						

			endif;
		
		
			$actual = $dato['AsincronoTemporal']['texto_6'];
			$PDF->linea[0] = array(
						'posx' => $L1[0],
						'ancho' => $W1[0] + $W1[1] + 60,
						'texto' => $dato['AsincronoTemporal']['texto_6'],
						'borde' => '',
						'align' => 'L',
						'fondo' => 0,
						'style' => 'B',
						'colorf' => '#ccc',
						'size' => 12
			);
			$PDF->ln(3);			
			$PDF->Imprimir_linea();	
		endif;
		$PDF->linea[0] = array(
					'posx' => $L1[0],
					'ancho' => $p[0],
					'texto' => $dato['AsincronoTemporal']['texto_7'],
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => 10
		);
		$PDF->linea[1] = array(
					'posx' => $p[1],
					'ancho' => $w2,
					'texto' => $dato['AsincronoTemporal']['entero_1'],
					'borde' => '',
					'align' => 'R',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => 10
		);		
		$PDF->linea[2] = array(
					'posx' => $p[2],
					'ancho' => $w2,
					'texto' => $dato['AsincronoTemporal']['entero_2'],
					'borde' => '',
					'align' => 'R',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => 10
		);	
		$PDF->linea[3] = array(
					'posx' => $p[3],
					'ancho' => $w2,
					'texto' => $util->nf($dato['AsincronoTemporal']['decimal_1']),
					'borde' => '',
					'align' => 'R',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => 10
		);			
		$PDF->Imprimir_linea();	
		
		$ACU_ORDENES += $dato['AsincronoTemporal']['entero_1'];
		$ACU_CANTIDAD += $dato['AsincronoTemporal']['entero_2'];
		$ACU_IMPORTE += $dato['AsincronoTemporal']['decimal_1'];

		$ACU_ORDENES_TOTAL += $dato['AsincronoTemporal']['entero_1'];
		$ACU_CANTIDAD_TOTAL += $dato['AsincronoTemporal']['entero_2'];
		$ACU_IMPORTE_TOTAL += $dato['AsincronoTemporal']['decimal_1'];			
		
	
	endforeach;
	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => $w1,
				'texto' => "TOTAL",
				'borde' => 'T',
				'align' => 'L',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);
	$PDF->linea[1] = array(
				'posx' => $p[1],
				'ancho' => $w2,
				'texto' => $ACU_ORDENES,
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);		
	$PDF->linea[2] = array(
				'posx' => $p[2],
				'ancho' => $w2,
				'texto' => $ACU_CANTIDAD,
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);	
	$PDF->linea[3] = array(
				'posx' => $p[3],
				'ancho' => $w2,
				'texto' => $util->nf($ACU_IMPORTE),
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);			
	$PDF->Imprimir_linea();

	
	$PDF->ln(3);
	
	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => $w1,
				'texto' => "TOTAL GENERAL POR BARRIO",
				'borde' => 'T',
				'align' => 'L',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);
	$PDF->linea[1] = array(
				'posx' => $p[1],
				'ancho' => $w2,
				'texto' => $ACU_ORDENES_TOTAL,
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);		
	$PDF->linea[2] = array(
				'posx' => $p[2],
				'ancho' => $w2,
				'texto' => $ACU_CANTIDAD_TOTAL,
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);	
	$PDF->linea[3] = array(
				'posx' => $p[3],
				'ancho' => $w2,
				'texto' => $util->nf($ACU_IMPORTE_TOTAL),
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);			
	$PDF->Imprimir_linea();	

endif;

if(!empty($resumenByProducto)):

	$PDF->AddPage();
	$PDF->Reset();
	
	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => $W1[0],
				'texto' => "RESUMEN GENERAL POR PRODUCTO / SERVICIO",
				'borde' => '',
				'align' => 'L',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 12
	);
	$PDF->ln(5);
	$PDF->Imprimir_linea();	
	$p = array(10,110,150,190);
	$w1 = 100;
	$w2 = 40;
	$PDF->linea[0] = array(
				'posx' => $p[0],
				'ancho' => $w1,
				'texto' => "",
				'borde' => 'LTB',
				'align' => 'L',
				'fondo' => 0,
				'style' => '',
				'colorf' => '#ccc',
				'size' => 10
	);
	$PDF->linea[1] = array(
				'posx' => $p[1],
				'ancho' => $w2,
				'texto' => "ORDENES",
				'borde' => 'TB',
				'align' => 'R',
				'fondo' => 0,
				'style' => '',
				'colorf' => '#ccc',
				'size' => 10
	);		
	$PDF->linea[2] = array(
				'posx' => $p[2],
				'ancho' => $w2,
				'texto' => "CANTIDAD",
				'borde' => 'TB',
				'align' => 'R',
				'fondo' => 0,
				'style' => '',
				'colorf' => '#ccc',
				'size' => 10
	);	
	$PDF->linea[3] = array(
				'posx' => $p[3],
				'ancho' => $w2,
				'texto' => "IMPORTE",
				'borde' => 'TBR',
				'align' => 'R',
				'fondo' => 0,
				'style' => '',
				'colorf' => '#ccc',
				'size' => 10
	);					
	$PDF->Imprimir_linea();		
	
	$actual = null;
	
	$ACU_ORDENES = 0;
	$ACU_CANTIDAD = 0;
	$ACU_IMPORTE = 0;	
	
	$ACU_ORDENES_TOTAL = 0;
	$ACU_CANTIDAD_TOTAL = 0;
	$ACU_IMPORTE_TOTAL = 0;	
	
	$primero = true;	
	
	foreach($resumenByProducto as $dato):
	
	
		if($actual != $dato['AsincronoTemporal']['texto_7']):
		
			if($primero):
				
				$primero = false;
				
			else:
			
				$PDF->linea[0] = array(
							'posx' => $L1[0],
							'ancho' => $w1,
							'texto' => "TOTAL",
							'borde' => 'T',
							'align' => 'L',
							'fondo' => 0,
							'style' => 'B',
							'colorf' => '#ccc',
							'size' => 10
				);
				$PDF->linea[1] = array(
							'posx' => $p[1],
							'ancho' => $w2,
							'texto' => $ACU_ORDENES,
							'borde' => 'T',
							'align' => 'R',
							'fondo' => 0,
							'style' => 'B',
							'colorf' => '#ccc',
							'size' => 10
				);		
				$PDF->linea[2] = array(
							'posx' => $p[2],
							'ancho' => $w2,
							'texto' => $ACU_CANTIDAD,
							'borde' => 'T',
							'align' => 'R',
							'fondo' => 0,
							'style' => 'B',
							'colorf' => '#ccc',
							'size' => 10
				);	
				$PDF->linea[3] = array(
							'posx' => $p[3],
							'ancho' => $w2,
							'texto' => $util->nf($ACU_IMPORTE),
							'borde' => 'T',
							'align' => 'R',
							'fondo' => 0,
							'style' => 'B',
							'colorf' => '#ccc',
							'size' => 10
				);			
				$PDF->Imprimir_linea();	
				$ACU_ORDENES = 0;
				$ACU_CANTIDAD = 0;
				$ACU_IMPORTE = 0;						

			endif;		
		
			$actual = $dato['AsincronoTemporal']['texto_7'];
			$PDF->linea[0] = array(
						'posx' => $L1[0],
						'ancho' => $W1[0] + $W1[1] + 60,
						'texto' => $dato['AsincronoTemporal']['texto_7'],
						'borde' => '',
						'align' => 'L',
						'fondo' => 0,
						'style' => 'B',
						'colorf' => '#ccc',
						'size' => 12
			);
			$PDF->ln(3);			
			$PDF->Imprimir_linea();	
		endif;
		$PDF->linea[0] = array(
					'posx' => $L1[0],
					'ancho' => $p[0],
					'texto' => $dato['AsincronoTemporal']['texto_6'],
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => 10
		);
		$PDF->linea[1] = array(
					'posx' => $p[1],
					'ancho' => $w2,
					'texto' => $dato['AsincronoTemporal']['entero_1'],
					'borde' => '',
					'align' => 'R',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => 10
		);		
		$PDF->linea[2] = array(
					'posx' => $p[2],
					'ancho' => $w2,
					'texto' => $dato['AsincronoTemporal']['entero_2'],
					'borde' => '',
					'align' => 'R',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => 10
		);	
		$PDF->linea[3] = array(
					'posx' => $p[3],
					'ancho' => $w2,
					'texto' => $util->nf($dato['AsincronoTemporal']['decimal_1']),
					'borde' => '',
					'align' => 'R',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => 10
		);				
		$PDF->Imprimir_linea();	
		$ACU_ORDENES += $dato['AsincronoTemporal']['entero_1'];
		$ACU_CANTIDAD += $dato['AsincronoTemporal']['entero_2'];
		$ACU_IMPORTE += $dato['AsincronoTemporal']['decimal_1'];	
		$ACU_ORDENES_TOTAL += $dato['AsincronoTemporal']['entero_1'];
		$ACU_CANTIDAD_TOTAL += $dato['AsincronoTemporal']['entero_2'];
		$ACU_IMPORTE_TOTAL += $dato['AsincronoTemporal']['decimal_1'];				
	
	endforeach;
	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => $w1,
				'texto' => "TOTAL",
				'borde' => 'T',
				'align' => 'L',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);
	$PDF->linea[1] = array(
				'posx' => $p[1],
				'ancho' => $w2,
				'texto' => $ACU_ORDENES,
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);		
	$PDF->linea[2] = array(
				'posx' => $p[2],
				'ancho' => $w2,
				'texto' => $ACU_CANTIDAD,
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);	
	$PDF->linea[3] = array(
				'posx' => $p[3],
				'ancho' => $w2,
				'texto' => $util->nf($ACU_IMPORTE),
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);			
	$PDF->Imprimir_linea();		

	$PDF->ln(3);
	
	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => $w1,
				'texto' => "TOTAL GENERAL POR PRODUCTO / SERVICIO",
				'borde' => 'T',
				'align' => 'L',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);
	$PDF->linea[1] = array(
				'posx' => $p[1],
				'ancho' => $w2,
				'texto' => $ACU_ORDENES_TOTAL,
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);		
	$PDF->linea[2] = array(
				'posx' => $p[2],
				'ancho' => $w2,
				'texto' => $ACU_CANTIDAD_TOTAL,
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);	
	$PDF->linea[3] = array(
				'posx' => $p[3],
				'ancho' => $w2,
				'texto' => $util->nf($ACU_IMPORTE_TOTAL),
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);			
	$PDF->Imprimir_linea();		

endif;

if(!empty($resumenByCentro)):

	$PDF->AddPage();
	$PDF->Reset();
	
	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => $W1[0],
				'texto' => "RESUMEN GENERAL POR CENTRO DE ATENCION",
				'borde' => '',
				'align' => 'L',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 12
	);
	$PDF->ln(5);
	$PDF->Imprimir_linea();	
	
	$actual = null;
	
	$p = array(10,110,150,190);
	$w1 = 100;
	$w2 = 40;
	$PDF->linea[0] = array(
				'posx' => $p[0],
				'ancho' => $w1,
				'texto' => "",
				'borde' => 'LTB',
				'align' => 'L',
				'fondo' => 0,
				'style' => '',
				'colorf' => '#ccc',
				'size' => 10
	);
	$PDF->linea[1] = array(
				'posx' => $p[1],
				'ancho' => $w2,
				'texto' => "ORDENES",
				'borde' => 'TB',
				'align' => 'R',
				'fondo' => 0,
				'style' => '',
				'colorf' => '#ccc',
				'size' => 10
	);		
	$PDF->linea[2] = array(
				'posx' => $p[2],
				'ancho' => $w2,
				'texto' => "CANTIDAD",
				'borde' => 'TB',
				'align' => 'R',
				'fondo' => 0,
				'style' => '',
				'colorf' => '#ccc',
				'size' => 10
	);	
	$PDF->linea[3] = array(
				'posx' => $p[3],
				'ancho' => $w2,
				'texto' => "IMPORTE",
				'borde' => 'TBR',
				'align' => 'R',
				'fondo' => 0,
				'style' => '',
				'colorf' => '#ccc',
				'size' => 10
	);					
	$PDF->Imprimir_linea();	
	
	$ACU_ORDENES = 0;
	$ACU_CANTIDAD = 0;
	$ACU_IMPORTE = 0;	
	
	$ACU_ORDENES_TOTAL = 0;
	$ACU_CANTIDAD_TOTAL = 0;
	$ACU_IMPORTE_TOTAL = 0;		
	
	$primero = true;
	$actual = null;	
	
	foreach($resumenByCentro as $dato):
	
	
		if($actual != $dato['AsincronoTemporal']['texto_10']):
		
			if($primero):
				
				$primero = false;
				
			else:
			
				$PDF->linea[0] = array(
							'posx' => $L1[0],
							'ancho' => $w1,
							'texto' => "TOTAL",
							'borde' => 'T',
							'align' => 'L',
							'fondo' => 0,
							'style' => 'B',
							'colorf' => '#ccc',
							'size' => 10
				);
				$PDF->linea[1] = array(
							'posx' => $p[1],
							'ancho' => $w2,
							'texto' => $ACU_ORDENES,
							'borde' => 'T',
							'align' => 'R',
							'fondo' => 0,
							'style' => 'B',
							'colorf' => '#ccc',
							'size' => 10
				);		
				$PDF->linea[2] = array(
							'posx' => $p[2],
							'ancho' => $w2,
							'texto' => $ACU_CANTIDAD,
							'borde' => 'T',
							'align' => 'R',
							'fondo' => 0,
							'style' => 'B',
							'colorf' => '#ccc',
							'size' => 10
				);	
				$PDF->linea[3] = array(
							'posx' => $p[3],
							'ancho' => $w2,
							'texto' => $util->nf($ACU_IMPORTE),
							'borde' => 'T',
							'align' => 'R',
							'fondo' => 0,
							'style' => 'B',
							'colorf' => '#ccc',
							'size' => 10
				);			
				$PDF->Imprimir_linea();	
				$ACU_ORDENES = 0;
				$ACU_CANTIDAD = 0;
				$ACU_IMPORTE = 0;						

			endif;		
		
			$actual = $dato['AsincronoTemporal']['texto_10'];
			$PDF->linea[0] = array(
						'posx' => $L1[0],
						'ancho' => $W1[0] + $W1[1] + 60,
						'texto' => $dato['AsincronoTemporal']['texto_10'],
						'borde' => '',
						'align' => 'L',
						'fondo' => 0,
						'style' => 'B',
						'colorf' => '#ccc',
						'size' => 12
			);
			$PDF->ln(3);			
			$PDF->Imprimir_linea();	
		endif;
		$PDF->linea[0] = array(
					'posx' => $L1[0],
					'ancho' => $p[0],
					'texto' => $dato['AsincronoTemporal']['texto_7'],
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => 10
		);
		$PDF->linea[1] = array(
					'posx' => $p[1],
					'ancho' => $w2,
					'texto' => $dato['AsincronoTemporal']['entero_1'],
					'borde' => '',
					'align' => 'R',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => 10
		);		
		$PDF->linea[2] = array(
					'posx' => $p[2],
					'ancho' => $w2,
					'texto' => $dato['AsincronoTemporal']['entero_2'],
					'borde' => '',
					'align' => 'R',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => 10
		);	
		$PDF->linea[3] = array(
					'posx' => $p[3],
					'ancho' => $w2,
					'texto' => $util->nf($dato['AsincronoTemporal']['decimal_1']),
					'borde' => '',
					'align' => 'R',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => 10
		);						
		$PDF->Imprimir_linea();	
		$ACU_ORDENES += $dato['AsincronoTemporal']['entero_1'];
		$ACU_CANTIDAD += $dato['AsincronoTemporal']['entero_2'];
		$ACU_IMPORTE += $dato['AsincronoTemporal']['decimal_1'];

		$ACU_ORDENES_TOTAL += $dato['AsincronoTemporal']['entero_1'];
		$ACU_CANTIDAD_TOTAL += $dato['AsincronoTemporal']['entero_2'];
		$ACU_IMPORTE_TOTAL += $dato['AsincronoTemporal']['decimal_1'];			
	
	endforeach;
	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => $w1,
				'texto' => "TOTAL",
				'borde' => 'T',
				'align' => 'L',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);
	$PDF->linea[1] = array(
				'posx' => $p[1],
				'ancho' => $w2,
				'texto' => $ACU_ORDENES,
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);		
	$PDF->linea[2] = array(
				'posx' => $p[2],
				'ancho' => $w2,
				'texto' => $ACU_CANTIDAD,
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);	
	$PDF->linea[3] = array(
				'posx' => $p[3],
				'ancho' => $w2,
				'texto' => $util->nf($ACU_IMPORTE),
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);			
	$PDF->Imprimir_linea();		

	$PDF->ln(3);
	
	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => $w1,
				'texto' => "TOTAL GENERAL POR CENTRO DE ATENCION",
				'borde' => 'T',
				'align' => 'L',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);
	$PDF->linea[1] = array(
				'posx' => $p[1],
				'ancho' => $w2,
				'texto' => $ACU_ORDENES_TOTAL,
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);		
	$PDF->linea[2] = array(
				'posx' => $p[2],
				'ancho' => $w2,
				'texto' => $ACU_CANTIDAD_TOTAL,
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);	
	$PDF->linea[3] = array(
				'posx' => $p[3],
				'ancho' => $w2,
				'texto' => $util->nf($ACU_IMPORTE_TOTAL),
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);			
	$PDF->Imprimir_linea();		

endif;

$PDF->Output("consulta_general_prodserv_".date('Ymd').".pdf");

?>