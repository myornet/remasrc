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

	$fontSizeHeader = 7;
	$W1 = array(35,45,10,15,20,20,45);
	$L1 = $PDF->armaAnchoColumnas($W1);	

	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => $W1[0],
				'texto' => "PRODUCTO / SERVICIO",
				'borde' => 'TLB',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeHeader
	);	
	$PDF->linea[1] = array(
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
	$PDF->linea[2] = array(
				'posx' => $L1[2],
				'ancho' => $W1[2],
				'texto' => "PERM",
				'borde' => 'TB',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeHeader
	);		
	$PDF->linea[3] = array(
				'posx' => $L1[3],
				'ancho' => $W1[3],
				'texto' => "HASTA",
				'borde' => 'TB',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeHeader
	);
	$PDF->linea[4] = array(
				'posx' => $L1[4],
				'ancho' => $W1[4],
				'texto' => "CANTIDAD",
				'borde' => 'TB',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeHeader
	);	
	$PDF->linea[5] = array(
				'posx' => $L1[5],
				'ancho' => $W1[5],
				'texto' => "IMPORTE",
				'borde' => 'TB',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeHeader
	);
	$PDF->linea[6] = array(
				'posx' => $L1[6],
				'ancho' => $W1[6],
				'texto' => "OBSERVACIONES",
				'borde' => 'TBR',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeHeader
	);			
	$PDF->Imprimir_linea();	
	$fontSizeBody = 6;
	foreach($orden['BeneficiarioBeneficioDetalle'] as $renglon):

		$PDF->linea[0] = array(
					'posx' => $L1[0],
					'ancho' => $W1[0],
					'texto' => substr($renglon['producto_str'],0,25),
					'borde' => 'L',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);
		$PDF->linea[1] = array(
					'posx' => $L1[1],
					'ancho' => $W1[1],
					'texto' => substr($renglon['solicitante_str'],0,35),
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);
		$PDF->linea[2] = array(
					'posx' => $L1[2],
					'ancho' => $W1[2],
					'texto' => ($renglon['permanente'] == 1 ? "SI" : ""),
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
					'texto' => ($renglon['permanente'] == 1 ? $util->armaFecha($renglon['fecha_hasta']) : ""),
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
					'texto' => $renglon['cantidad'],
					'borde' => '',
					'align' => 'C',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);	
		$PDF->linea[5] = array(
					'posx' => $L1[5],
					'ancho' => $W1[5],
					'texto' => $util->nf($renglon['importe']),
					'borde' => '',
					'align' => 'R',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);	
		$PDF->linea[6] = array(
					'posx' => $L1[6],
					'ancho' => $W1[6],
					'texto' => substr($renglon['observaciones'],0,35),
					'borde' => 'R',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);											
		$PDF->Imprimir_linea();	
	
	endforeach;
	
	$PDF->linea[6] = array(
				'posx' => 10,
				'ancho' => 190,
				'texto' => "",
				'borde' => 'T',
				'align' => 'L',
				'fondo' => 0,
				'style' => '',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
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