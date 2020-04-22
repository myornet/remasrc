<?php 

//debug($beneficiario);
//exit;

App::import('Vendor','listado_pdf');

$PDF = new ListadoPDF();

$PDF->SetTitle("FICHA BENEFICIARIO");
$PDF->SetFontSizeConf(8.5);


$PDF->Open();

$PDF->titulo['titulo3'] = 'FICHA GRUPO FAMILIAR | BENEFICIO N° ' . $beneficiario['Beneficiario']['id'];
$PDF->titulo['titulo2'] = $beneficiario['Persona']['tdocndoc']." ".$beneficiario['Persona']['apenom']." ";
$PDF->titulo['titulo1'] = "FECHA ALTA: ". $beneficiario['Beneficiario']['fecha_alta'] ." - " . $beneficiario['Beneficiario']['alta_centro_id_d'];

$W1 = array(35,155);
$L1 = $PDF->armaAnchoColumnas($W1);


$PDF->AddPage();
$PDF->Reset();
$fontSizeBody = 8;

$PDF->linea[0] = array(
			'posx' => $L1[0],
			'ancho' => 190,
			'texto' => "DATOS DEL TITULAR",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => 'B',
			'colorf' => '#ccc',
			'size' => 10
);

$PDF->Imprimir_linea();	

$PDF->ln(3);

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 20,
			'texto' => "DOCUMENTO: ",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 30,
			'ancho' => 30,
			'texto' => $beneficiario['Persona']['tdocndoc'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->linea[2] = array(
			'posx' => 60,
			'ancho' => 35,
			'texto' => "APELLIDO Y NOMBRE:",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[3] = array(
			'posx' => 95,
			'ancho' => 105,
			'texto' => $beneficiario['Persona']['apenom'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->Imprimir_linea();	

$PDF->ln(1);

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 30,
			'texto' => "FECHA NACIMIENTO: ",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 40,
			'ancho' => 20,
			'texto' => $util->armaFecha($beneficiario['Persona']['fecha_nacimiento']),
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);
$PDF->linea[2] = array(
			'posx' => 60,
			'ancho' => 20,
			'texto' => "CUIT/CUIL:",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[3] = array(
			'posx' => 80,
			'ancho' => 22,
			'texto' => $beneficiario['Persona']['cuit_cuil'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);
$PDF->linea[4] = array(
			'posx' => 102,
			'ancho' => 20,
			'texto' => "DIRECCION:",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[5] = array(
			'posx' => 122,
			'ancho' => 78,
			'texto' => $beneficiario['Persona']['calle']." ". $beneficiario['Persona']['numero'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->Imprimir_linea();	

$PDF->ln(1);

$PDF->linea[1] = array(
			'posx' => 10,
			'ancho' => 15,
			'texto' => "BARRIO:",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[2] = array(
			'posx' => 25,
			'ancho' => 60,
			'texto' => $beneficiario['Persona']['barrio_d'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->linea[3] = array(
			'posx' => 85,
			'ancho' => 16,
			'texto' => "LOCALIDAD:",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[4] = array(
			'posx' => 106,
			'ancho' => 94,
			'texto' => LOCALIDAD ." (CP ".CP.") - " . PROVINCIA,
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->Imprimir_linea();

$PDF->ln(1);

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 18,
			'texto' => "TELEFONO: ",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 28,
			'ancho' => 22,
			'texto' => $beneficiario['Persona']['telefono_fijo'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->linea[2] = array(
			'posx' => 50,
			'ancho' => 15,
			'texto' => "CELULAR:",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[3] = array(
			'posx' => 65,
			'ancho' => 40,
			'texto' => (!empty($beneficiario['Persona']['telefono_movil']) ? $beneficiario['Persona']['telefono_movil'] : "S/D"),
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->linea[4] = array(
			'posx' => 105,
			'ancho' => 18,
			'texto' => "MENSAJES:",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[5] = array(
			'posx' => 123,
			'ancho' => 22,
			'texto' => (!empty($beneficiario['Persona']['telefono_mensajes']) ? $beneficiario['Persona']['telefono_mensajes'] : "S/D"),
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);
$PDF->linea[6] = array(
			'posx' => 145,
			'ancho' => 12,
			'texto' => "EMAIL:",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[7] = array(
			'posx' => 157,
			'ancho' => 43,
			'texto' => (!empty($beneficiario['Persona']['email']) ? $beneficiario['Persona']['email'] : "S/D"),
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);


$PDF->Imprimir_linea();


$PDF->ln(1);

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 25,
			'texto' => "DISCAPACIDAD: ",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 35,
			'ancho' => 70,
			'texto' => $beneficiario['Persona']['tipo_discapacidad_d'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->linea[2] = array(
			'posx' => 105,
			'ancho' => 37,
			'texto' => "NIVEL DE INSTRUCCION:",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[3] = array(
			'posx' => 142,
			'ancho' => 58,
			'texto' => $beneficiario['Persona']['tipo_nivel_instruccion_d'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);
$PDF->Imprimir_linea();

$PDF->ln(1);

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 25,
			'texto' => "PROF./OFICIO: ",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 35,
			'ancho' => 165,
			'texto' => $beneficiario['Persona']['tipo_ocupacion_oficio_d'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->Imprimir_linea();

$PDF->ln(1);

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 25,
			'texto' => "OCUP.ACTUAL: ",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 35,
			'ancho' => 120,
			'texto' => $beneficiario['Persona']['tipo_ocupacion_oficio_actual_d'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->linea[2] = array(
			'posx' => 155,
			'ancho' => 20,
			'texto' => "INGRESOS:",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[3] = array(
			'posx' => 175,
			'ancho' => 25,
			'texto' => $util->nf($beneficiario['Persona']['ingresos']),
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->Imprimir_linea();

$PDF->ln(1);

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 25,
			'texto' => "COB. MEDICA: ",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 35,
			'ancho' => 165,
			'texto' => $beneficiario['Persona']['tipo_cobertura_medica_d'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->Imprimir_linea();

$PDF->ln(3);

$PDF->linea[0] = array(
			'posx' => $L1[0],
			'ancho' => 190,
			'texto' => "DATOS HABITACIONALES",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => 'B',
			'colorf' => '#ccc',
			'size' => 10
);

$PDF->Imprimir_linea();	

$PDF->ln(3);

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 30,
			'texto' => "LA VIVIENDA ES: ",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 40,
			'ancho' => 90,
			'texto' => $beneficiario['Persona']['tipo_vivienda_d'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->linea[2] = array(
			'posx' => 130,
			'ancho' => 60,
			'texto' => "HABITACIONES (SIN BAÑO NI COCINA):",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[3] = array(
			'posx' => 190,
			'ancho' => 10,
			'texto' => $beneficiario['Persona']['habitaciones'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->Imprimir_linea();

$PDF->ln(1);

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 30,
			'texto' => "LA FAMILIA ES:",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 40,
			'ancho' => 160,
			'texto' => $beneficiario['Persona']['tipo_condicion_vivienda_d'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->Imprimir_linea();

$PDF->ln(1);

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 30,
			'texto' => "ELECTRICIDAD:",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 40,
			'ancho' => 160,
			'texto' => $beneficiario['Persona']['tipo_electricidad_d'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->Imprimir_linea();

$PDF->ln(1);

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 30,
			'texto' => "AGUA:",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 40,
			'ancho' => 65,
			'texto' => $beneficiario['Persona']['tipo_agua_d'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->linea[2] = array(
			'posx' => 105,
			'ancho' => 20,
			'texto' => "CONEXION:",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);

$PDF->linea[3] = array(
			'posx' => 125,
			'ancho' => 75,
			'texto' => $beneficiario['Persona']['tipo_conexion_agua_d'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->Imprimir_linea();

$PDF->ln(1);

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 30,
			'texto' => "BAÑO:",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 40,
			'ancho' => 160,
			'texto' => $beneficiario['Persona']['tipo_banio_d'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->Imprimir_linea();

$PDF->ln(1);

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 30,
			'texto' => "TECHO:",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 40,
			'ancho' => 160,
			'texto' => $beneficiario['Persona']['tipo_techo_d'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->Imprimir_linea();

$PDF->ln(1);

$PDF->linea[0] = array(
			'posx' => 10,
			'ancho' => 30,
			'texto' => "PISOS:",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => '',
			'colorf' => '#ccc',
			'size' => $fontSizeBody
);
$PDF->linea[1] = array(
			'posx' => 40,
			'ancho' => 160,
			'texto' => $beneficiario['Persona']['tipo_piso_d'],
			'borde' => 'TBLR',
			'align' => 'L',
			'fondo' => 1,
			'style' => 'B',
			'colorf' => '#E9E9E9',
			'size' => $fontSizeBody
);

$PDF->Imprimir_linea();

$PDF->ln(3);

$PDF->linea[0] = array(
			'posx' => $L1[0],
			'ancho' => 190,
			'texto' => "GRUPO FAMILIAR ACTUAL",
			'borde' => '',
			'align' => 'L',
			'fondo' => 0,
			'style' => 'B',
			'colorf' => '#ccc',
			'size' => 10
);

$PDF->Imprimir_linea();	

$PDF->ln(3);

if(!empty($beneficiario['adicionales'])):


	$fontSizeBody = 6;
	
	$W1 = array(40,20,15,25,40,50);
	$L1 = $PDF->armaAnchoColumnas($W1);	

	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => $W1[0],
				'texto' => "APELLIDO Y NOMBRE",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	$PDF->linea[1] = array(
				'posx' => $L1[1],
				'ancho' => $W1[1],
				'texto' => "DOCUMENTO",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	$PDF->linea[2] = array(
				'posx' => $L1[2],
				'ancho' => $W1[2],
				'texto' => "FEC.NAC.",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	$PDF->linea[3] = array(
				'posx' => $L1[3],
				'ancho' => $W1[3],
				'texto' => "PARENTEZCO",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);	
	$PDF->linea[4] = array(
				'posx' => $L1[4],
				'ancho' => $W1[4],
				'texto' => "DISCAPACIDAD",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	$PDF->linea[5] = array(
				'posx' => $L1[5],
				'ancho' => $W1[5],
				'texto' => "OCUPACION ACTUAL",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);		
	$PDF->Imprimir_linea();
	
	foreach($beneficiario['adicionales'] as $adicional):

	
		$PDF->linea[0] = array(
					'posx' => $L1[0],
					'ancho' => $W1[0],
					'texto' => $adicional['Persona']['apenom'],
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
					'texto' => $adicional['Persona']['tdocndoc'],
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
					'texto' => $util->armaFecha($adicional['Persona']['fecha_nacimiento']),
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
					'texto' => $adicional['BeneficiarioAdicional']['tipo_parentezco_d'],
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);
		$PDF->linea[4] = array(
					'posx' => $L1[4],
					'ancho' => $W1[4],
					'texto' => $adicional['Persona']['tipo_discapacidad_d'],
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);
		$PDF->linea[5] = array(
					'posx' => $L1[5],
					'ancho' => $W1[5],
					'texto' => $adicional['Persona']['tipo_ocupacion_oficio_actual_d'],
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);							
		$PDF->Imprimir_linea();	
	
	endforeach;
	
else:


	$PDF->linea[0] = array(
				'posx' => 10,
				'ancho' => 190,
				'texto' => "*** NO POSEE GRUPO FAMILIAR A CARGO ***",
				'borde' => '',
				'align' => 'L',
				'fondo' => 0,
				'style' => '',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	
	$PDF->Imprimir_linea();


endif;

if(!empty($beneficiario['BeneficiosPermanentes'])):

	$PDF->ln(3);
	
	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => 190,
				'texto' => "PRODUCTOS Y/O SERVICIOS PERMANENTES",
				'borde' => '',
				'align' => 'L',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);
	
	$PDF->Imprimir_linea();	
	$fontSizeBody = 6;
	
	$W1 = array(10,15,15,40,50,15,15,30);
	$L1 = $PDF->armaAnchoColumnas($W1);	

	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => $W1[0],
				'texto' => "ORD.",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	$PDF->linea[1] = array(
				'posx' => $L1[1],
				'ancho' => $W1[1],
				'texto' => "FECHA DESDE",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	$PDF->linea[2] = array(
				'posx' => $L1[2],
				'ancho' => $W1[2],
				'texto' => "FECHA HASTA",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	$PDF->linea[3] = array(
				'posx' => $L1[3],
				'ancho' => $W1[3],
				'texto' => "PRODUCTO / SERVICIO",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);	
	$PDF->linea[4] = array(
				'posx' => $L1[4],
				'ancho' => $W1[4],
				'texto' => "BENEFICIARIO",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	$PDF->linea[5] = array(
				'posx' => $L1[5],
				'ancho' => $W1[5],
				'texto' => "CANTIDAD",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	$PDF->linea[6] = array(
				'posx' => $L1[6],
				'ancho' => $W1[6],
				'texto' => "VALOR",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	$PDF->linea[7] = array(
				'posx' => $L1[7],
				'ancho' => $W1[7],
				'texto' => "EMITIDA EN",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);					
	$PDF->Imprimir_linea();	
	
	foreach($beneficiario['BeneficiosPermanentes'] as $beneficio):
	
		$PDF->linea[0] = array(
					'posx' => $L1[0],
					'ancho' => $W1[0],
					'texto' => $beneficio['orden_nro_str'],
					'borde' => '',
					'align' => 'C',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);
		$PDF->linea[1] = array(
					'posx' => $L1[1],
					'ancho' => $W1[1],
					'texto' => $beneficio['orden_fecha_str'],
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
					'texto' => ($beneficio['permanente'] == 1 ? $util->armaFecha($beneficio['fecha_hasta']) : ""),
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
					'texto' => substr($beneficio['producto_str'],0,35),		
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);	
		$PDF->linea[4] = array(
					'posx' => $L1[4],
					'ancho' => $W1[4],
					'texto' => substr($beneficio['solicitante_str'],0,41),
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);
		$PDF->linea[5] = array(
					'posx' => $L1[5],
					'ancho' => $W1[5],
					'texto' => $beneficio['cantidad'],
					'borde' => '',
					'align' => 'C',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);
		$PDF->linea[6] = array(
					'posx' => $L1[6],
					'ancho' => $W1[6],
					'texto' => $util->nf($beneficio['importe']),
					'borde' => '',
					'align' => 'R',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);
		$PDF->linea[7] = array(
					'posx' => $L1[7],
					'ancho' => $W1[7],
					'texto' => $beneficio['orden_emitida_str'],
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);					
		$PDF->Imprimir_linea();	
	
	endforeach;

endif;

if(!empty($beneficiario['Beneficios'])):

	$PDF->ln(3);
	
	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => 190,
				'texto' => "HISTORICO DE PRODUCTOS Y/O SERVICIOS",
				'borde' => '',
				'align' => 'L',
				'fondo' => 0,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => 10
	);
	
	$PDF->Imprimir_linea();	
	$fontSizeBody = 6;
	
	$W1 = array(10,15,55,50,15,15,30);
	$L1 = $PDF->armaAnchoColumnas($W1);	

	$PDF->linea[0] = array(
				'posx' => $L1[0],
				'ancho' => $W1[0],
				'texto' => "ORD.",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	$PDF->linea[1] = array(
				'posx' => $L1[1],
				'ancho' => $W1[1],
				'texto' => "FECHA",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	$PDF->linea[2] = array(
				'posx' => $L1[2],
				'ancho' => $W1[2],
				'texto' => "PRODUCTO / SERVICIO",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);	
	$PDF->linea[3] = array(
				'posx' => $L1[3],
				'ancho' => $W1[3],
				'texto' => "BENEFICIARIO",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	$PDF->linea[4] = array(
				'posx' => $L1[4],
				'ancho' => $W1[4],
				'texto' => "CANTIDAD",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	$PDF->linea[5] = array(
				'posx' => $L1[5],
				'ancho' => $W1[5],
				'texto' => "VALOR",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);
	$PDF->linea[6] = array(
				'posx' => $L1[6],
				'ancho' => $W1[6],
				'texto' => "EMITIDA EN",
				'borde' => '',
				'align' => 'C',
				'fondo' => 1,
				'style' => 'B',
				'colorf' => '#ccc',
				'size' => $fontSizeBody
	);					
	$PDF->Imprimir_linea();	
	
	foreach($beneficiario['Beneficios'] as $beneficio):
	
		$PDF->linea[0] = array(
					'posx' => $L1[0],
					'ancho' => $W1[0],
					'texto' => $beneficio['orden_nro_str'],
					'borde' => '',
					'align' => 'C',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);
		$PDF->linea[1] = array(
					'posx' => $L1[1],
					'ancho' => $W1[1],
					'texto' => $beneficio['orden_fecha_str'],
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
					'texto' => substr($beneficio['producto_str'],0,35),
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);	
		$PDF->linea[3] = array(
					'posx' => $L1[3],
					'ancho' => $W1[3],
					'texto' => substr($beneficio['solicitante_str'],0,41),
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);
		$PDF->linea[4] = array(
					'posx' => $L1[4],
					'ancho' => $W1[4],
					'texto' => $beneficio['cantidad'],
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
					'texto' => $util->nf($beneficio['importe']),
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
					'texto' => $beneficio['orden_emitida_str'],
					'borde' => '',
					'align' => 'L',
					'fondo' => 0,
					'style' => '',
					'colorf' => '#ccc',
					'size' => $fontSizeBody
		);					
		$PDF->Imprimir_linea();	
	
	endforeach;

endif;


$PDF->Output("ficha_beneficiario.pdf");


?>