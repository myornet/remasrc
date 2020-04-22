<?php 
//debug($orden);
//exit;

App::import('Vendor','listado_pdf');

$PDF = new ListadoPDF();

$PDF->SetTitle("ORDEN DE CONSUMO");
$PDF->SetFontSizeConf(8.5);


$PDF->Open();

$PDF->titulo['titulo3'] = "CONSUMO PRODUCTO/SERVICIO ORD.#" . $orden['BeneficiarioBeneficio']['id'];
//$PDF->titulo['titulo2'] = "TITULAR: " . $orden['BeneficiarioBeneficio']['titular'];
//$PDF->titulo['titulo1'] = 'GRUPO FAMILIAR | BENEF.N°' . $orden['BeneficiarioBeneficio']['beneficiario_id'];

$PDF->titulo['titulo2'] = "";
$PDF->titulo['titulo1'] = "";

$PDF->AddPage();

$fontSizeBody = 8;

$PDF->Reset();	

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 25,
			'texto' => "FECHA:",
			'borde' => 'TL',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 35,
			'ancho' => 165,
			'texto' => $orden['BeneficiarioBeneficio']['fecha'],
			'borde' => 'TR',
			'align' => 'L',
			'fondo' => 0,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);
$PDF->Imprimir_linea();	

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 25,
			'texto' => "TITULAR:",
			'borde' => 'L',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 35,
			'ancho' => 165,
			'texto' => $orden['BeneficiarioBeneficio']['titular'],
			'borde' => 'R',
			'align' => 'L',
			'fondo' => 0,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);
$PDF->Imprimir_linea();	


$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 25,
			'texto' => "EMITIDA EN:",
			'borde' => 'L',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 35,
			'ancho' => 165,
			'texto' => $orden['BeneficiarioBeneficio']['centro'],
			'borde' => 'R',
			'align' => 'L',
			'fondo' => 0,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);
$PDF->Imprimir_linea();	

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 25,
			'texto' => "USUARIO:",
			'borde' => 'LB',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 35,
			'ancho' => 165,
			'texto' => $orden['BeneficiarioBeneficio']['user_created']." * " . $orden['BeneficiarioBeneficio']['created'],
			'borde' => 'RB',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);
$PDF->Imprimir_linea();	

$PDF->ln(3);

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 190,
			'texto' => "DETALLE DE LA ORDEN",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => 'B',
			'colorf' => '#ccc',
			'size' => 10
);

$PDF->Imprimir_linea();	

$PDF->ln(3);



if(!empty($orden['BeneficiarioBeneficioDetalle'])):

	$fontSizeHeader = 6;
	$fontSizeBody = 8;
	$W1 = array(70,10,15,20,20,55);
	$L1 = $PDF->armaAnchoColumnas($W1);	
	
	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => 190,
				'texto' => "PRODUCTO / SERVICIO",
				'borde' => 'LTR',
				'align' => 'L',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeHeader
	);	
	$PDF->Imprimir_linea();	
	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => $W1[0],
				'texto' => "BENEFICIARIO",
				'borde' => 'LB',
				'align' => 'L',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeHeader
	);
	$PDF->linea[1] = array(
				'posx' => $L1[1],
				'ancho' => $W1[1],
				'texto' => "PERM",
				'borde' => 'B',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeHeader
	);		
	$PDF->linea[2] = array(
				'posx' => $L1[2],
				'ancho' => $W1[2],
				'texto' => "HASTA",
				'borde' => 'B',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeHeader
	);
	$PDF->linea[3] = array(
				'posx' => $L1[3],
				'ancho' => $W1[3],
				'texto' => "CANTIDAD",
				'borde' => 'B',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeHeader
	);	
	$PDF->linea[4] = array(
				'posx' => $L1[4],
				'ancho' => $W1[4],
				'texto' => "IMPORTE",
				'borde' => 'B',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeHeader
	);
	$PDF->linea[5] = array(
				'posx' => $L1[5],
				'ancho' => $W1[5],
				'texto' => "OBSERVACIONES",
				'borde' => 'BR',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeHeader
	);			
	$PDF->Imprimir_linea();		
	
	$actual = null;
	$colorCelda = "#F5f7f7";
	$ACU_TOTAL = 0;
	$ACU_CANTIDAD = 0;

	foreach($orden['BeneficiarioBeneficioDetalle'] as $renglon):

		if($actual != $renglon['codigo_producto']):
			$PDF->ln(1);
			$PDF->linea[0] = array(
						'posx' => $L1[0],
						'ancho' => 190,
						'texto' => $renglon['producto_str'],
						'borde' => 'LTBR',
						'align' => 'L',
						'fondo' => 1,
						'style' => 'B',
						'colorf' => $colorCelda,
						'size' => $fontSizeBody
			);		
			$PDF->Imprimir_linea();
			$PDF->ln(1);
			$actual = $renglon['codigo_producto'];
		
		endif;
	
		$PDF->linea[0] = array(
					'posx' => $L1[0],
					'ancho' => $W1[0],
					'texto' => substr($renglon['solicitante_str'],0,40),
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);
		$PDF->linea[1] = array(
					'posx' => $L1[1],
					'ancho' => $W1[1],
					'texto' => ($renglon['permanente'] == 1 ? "SI" : ""),
					'borde' => '',
					'align' => 'C',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);
		$PDF->linea[2] = array(
					'posx' => $L1[2],
					'ancho' => $W1[2],
					'texto' => ($renglon['permanente'] == 1 ? $util->armaFecha($renglon['fecha_hasta']) : ""),
					'borde' => '',
					'align' => 'C',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);
		$PDF->linea[3] = array(
					'posx' => $L1[3],
					'ancho' => $W1[3],
					'texto' => $renglon['cantidad'],
					'borde' => '',
					'align' => 'C',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);	
		$PDF->linea[4] = array(
					'posx' => $L1[4],
					'ancho' => $W1[4],
					'texto' => $util->nf($renglon['importe']),
					'borde' => '',
					'align' => 'R',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);	
		$PDF->linea[5] = array(
					'posx' => $L1[5],
					'ancho' => $W1[5],
					'texto' => substr($renglon['observaciones'],0,50),
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody - 3
		);											
		$PDF->Imprimir_linea();	
		
		$ACU_TOTAL += $renglon['importe'];
		$ACU_CANTIDAD += $renglon['cantidad'];		
	
	endforeach;
	$PDF->ln(2);
	$PDF->linea[6] = array(
				'posx' => 10,
				'ancho' => 95,
				'texto' => "TOTAL DE LA ORDEN",
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	$PDF->linea[3] = array(
				'posx' => $L1[3],
				'ancho' => $W1[3],
				'texto' => $ACU_CANTIDAD,
				'borde' => 'T',
				'align' => 'C',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);	
	$PDF->linea[4] = array(
				'posx' => $L1[4],
				'ancho' => $W1[4],
				'texto' => $util->nf($ACU_TOTAL),
				'borde' => 'T',
				'align' => 'R',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	$PDF->linea[5] = array(
				'posx' => $L1[5],
				'ancho' => $W1[5],
				'texto' => "",
				'borde' => 'T',
				'align' => 'L',
				'fondo' => 0,
				'style' => '',
				'colorf' => '#ccc',
				'size' => $fontSizeBody - 3
	);														
	$PDF->Imprimir_linea();	

	
	

endif;

$PDF->ln(20);

$PDF->linea[6] = array(
			'posx' => 20,
			'ancho' => 40,
			'texto' => "Firma Empleado Autorizado",
			'borde' => 'T',
			'align' => 'C',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);											
$PDF->Imprimir_linea();

$PDF->linea[6] = array(
			'posx' => 140,
			'ancho' => 40,
			'texto' => "Firma Beneficiario",
			'borde' => 'T',
			'align' => 'C',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);											
$PDF->Imprimir_linea();

$PDF->Output("orden_consumo_".$orden['BeneficiarioBeneficio']['id'].".pdf");

?>