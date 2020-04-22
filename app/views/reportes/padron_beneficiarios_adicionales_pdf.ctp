<?php 

//debug($datos);
//exit;

App::import('Vendor','listado_pdf');

$PDF = new ListadoPDF();

$PDF->SetTitle("PADRON DE BENEFICIARIOS");
$PDF->SetFontSizeConf(8.5);


$PDF->Open();

$PDF->titulo['titulo3'] = "PADRON DE BENEFICIARIOS";
$PDF->titulo['titulo2'] = "";
$PDF->titulo['titulo1'] = "";

//$PDF->AddPage();

$fontSizeBody = 8;

//$PDF->Reset();	

$fontSizeHeader = 7;
$W1 = array(25,60,50,30,15,10);
$L1 = $PDF->armaAnchoColumnas($W1);	

//$PDF->encabezado[0][0] = array(
//			'posx' => $L1[0],
//			'ancho' => $W1[0],
//			'texto' => 'DOCUMENTO',
//			'borde' => 'LTB',
//			'align' => 'C',
//			'fondo' => 1,
//			'style' => '',
//			'colorf' => '#ccc',
//			'size' => $fontSizeHeader
//	);

$PDF->encabezado[0][0] = array(
			'posx' => $L1[0],
			'ancho' => $W1[0],
			'texto' => "TIPO/DOCUMENTO",
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
			'texto' => "BENEF.",
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
			'texto' => "COND.",
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


	foreach($datos as $dato):

		$style = ($dato['entero_2'] == 1 ? 'B' : '');
		$fondo = ($dato['entero_2'] == 1 ? 1 : 0);
		$colorFondo = '#F5f7f7';
	
		if($dato['entero_2'] == 1) $fontSizeBody = 8;
		else $fontSizeBody = 7;
		
		$PDF->linea[0] = array(
					'posx' => $L1[0],
					'ancho' => $W1[0],
					'texto' => $dato['texto_1'],
					'borde' => '',
					'align' => 'L',
					'fondo' => $fondo,
					'style' => $style,
					'colorf' => $colorFondo,
					'size' => $fontSizeBody
		);
		
		$PDF->linea[1] = array(
					'posx' => $L1[1],
					'ancho' => $W1[1],
					'texto' => $dato['texto_2'],
					'borde' => '',
					'align' => 'L',
					'fondo' => $fondo,
					'style' => $style,
					'colorf' => $colorFondo,
					'size' => $fontSizeBody
		);		
		if($dato['entero_2'] == 1):
			$PDF->linea[2] = array(
						'posx' => $L1[2],
						'ancho' => $W1[2],
						'texto' => substr($dato['texto_3'],0,32),
						'borde' => '',
						'align' => 'L',
						'fondo' => $fondo,
						'style' => $style,
						'colorf' => $colorFondo,
						'size' => $fontSizeBody
			);
	
	
			$PDF->linea[3] = array(
						'posx' => $L1[3],
						'ancho' => $W1[3],
						'texto' => $dato['texto_4'],
						'borde' => '',
						'align' => 'L',
						'fondo' => $fondo,
						'style' => $style,
						'colorf' => $colorFondo,
						'size' => $fontSizeBody
			);		
			$PDF->linea[4] = array(
						'posx' => $L1[4],
						'ancho' => $W1[4],
						'texto' => "#".$dato['texto_19'],
						'borde' => '',
						'align' => 'R',
						'fondo' => $fondo,
						'style' => $style,
						'colorf' => $colorFondo,
						'size' => $fontSizeBody
			);
			$PDF->linea[5] = array(
						'posx' => $L1[5],
						'ancho' => $W1[5],
						'texto' => substr($dato['texto_20'],0,3),
						'borde' => '',
						'align' => 'C',
						'fondo' => $fondo,
						'style' => $style,
						'colorf' => $colorFondo,
						'size' => $fontSizeBody
			);
		else:
			$PDF->linea[2] = array(
						'posx' => $L1[2],
						'ancho' => $W1[2],
						'texto' => $dato['texto_21'],
						'borde' => '',
						'align' => 'L',
						'fondo' => $fondo,
						'style' => $style,
						'colorf' => $colorFondo,
						'size' => $fontSizeBody
			);				
		endif;				
		$PDF->Imprimir_linea();
	
	endforeach;


endif;


$PDF->Output("PADRON_BENEFICIARIOS_".date('Ymd').".pdf");


?>