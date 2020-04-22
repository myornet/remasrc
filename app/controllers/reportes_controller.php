<?php 

class ReportesController extends AppController{
	
	var $name = "Reportes";
	var $uses = array("Asincrono","AsincronoTemporal");
	
	function index(){
		$this->redirect('consulta_general_prodserv');
	}
	
	
	function consulta_general_prodserv(){
		
		$asincrono = null;
		
		$fecha_desde = date('Y-m-d');
		$fecha_hasta = date('Y-m-d');
		
		if(!empty($this->data)):
			$asincrono = array();
			$asincrono['Asincrono']['proceso'] = 'consulta_general_prodserv';
			$asincrono['Asincrono']['p1'] = $this->data['Reporte']['producto_servicio'];
			$asincrono['Asincrono']['p2'] = $this->Asincrono->armaFechaForm($this->data['Reporte']['fecha_desde']);
			$asincrono['Asincrono']['p3'] = $this->Asincrono->armaFechaForm($this->data['Reporte']['fecha_hasta']);
			$asincrono['Asincrono']['p4'] = $this->data['Reporte']['codigo_barrio'];
			$asincrono['Asincrono']['p5'] = $this->data['Reporte']['tipo_reporte'];
			$asincrono['Asincrono']['p6'] = $this->data['Reporte']['alta_centro_id'];
			$asincrono['Asincrono']['action_do'] = "/reportes/consulta_general_prodserv";
			$asincrono['Asincrono']['target'] = '_blank';
			$asincrono['Asincrono']['titulo'] = 'CONSULTA GENERAL DE PRODUCTOS Y/O SERVICIOS';
			
			$centro = null;
			if(!empty($asincrono['Asincrono']['p6'])):
				$centro = $this->Asincrono->getCentro($asincrono['Asincrono']['p6'],'descripcion');
			endif;			
			
			//armo el subtitulo
			$st = (!empty($centro) ? $centro . " | " : "");
			$st .= (!empty($this->data['Reporte']['producto_servicio']) ? $this->Asincrono->getGlobalDato($this->data['Reporte']['producto_servicio']) : "PROD/SERV:TODOS");
			$st .= " | ". date('d-m-Y' , strtotime($this->Asincrono->armaFechaForm($this->data['Reporte']['fecha_desde'])));
			$st .= " AL " . date('d-m-Y' , strtotime($this->Asincrono->armaFechaForm($this->data['Reporte']['fecha_hasta'])));
			$st .= " | ";
			$st .= (!empty($this->data['Reporte']['codigo_barrio']) ? $this->Asincrono->getGlobalDato($this->data['Reporte']['codigo_barrio']) : "BARRIO:TODOS");
			
			
			$asincrono['Asincrono']['subtitulo'] = $st;
			$asincrono['Asincrono']['id'] = $this->Asincrono->crear($asincrono);
			
			$fecha_desde = $asincrono['Asincrono']['p2'];
			$fecha_hasta = $asincrono['Asincrono']['p3'];			
			

		endif;
		
		$this->set('fecha_desde',$fecha_desde);
		$this->set('fecha_hasta',$fecha_hasta);		
		
		if(isset($this->params['url']['pid'])):
		
			$asincrono = $this->Asincrono->read(null,$this->params['url']['pid']);
			
			if(empty($asincrono)) $this->redirect('consulta_general_prodserv');
			
			//cargo el centro
			$centro = null;
			if(!empty($asincrono['Asincrono']['p6'])):
				$centro = $this->Asincrono->getCentro($asincrono['Asincrono']['p6'],'descripcion');
			endif;
			
			$this->set('centro',$centro);
			$this->set('asincrono',$asincrono);
			
			//saco datos para el resumen
			$sql = "SELECT texto_6,texto_7,entero_1,entero_2,decimal_1 FROM asincrono_temporales as AsincronoTemporal WHERE asincrono_id = ".$this->params['url']['pid']."
					AND clave_1 = 'REPORTE_2'
					GROUP BY texto_6,texto_7";
			if(empty($asincrono['Asincrono']['p1'])) $resumenByBarrio = $this->AsincronoTemporal->query($sql);
			else $resumenByBarrio = null;
			
			$sql = "SELECT texto_6,texto_7,entero_1,entero_2,decimal_1 FROM asincrono_temporales as AsincronoTemporal WHERE asincrono_id = ".$this->params['url']['pid']."
					AND clave_1 = 'REPORTE_3'
					GROUP BY texto_7,texto_6";
			if(empty($asincrono['Asincrono']['p4'])) $resumenByProducto = $this->AsincronoTemporal->query($sql);
			else $resumenByProducto = null;

			$sql = "SELECT texto_10,texto_7,entero_1,entero_2,decimal_1 FROM asincrono_temporales as AsincronoTemporal WHERE asincrono_id = ".$this->params['url']['pid']."
					AND clave_1 = 'REPORTE_4'
					GROUP BY texto_10,texto_7";
			if(empty($asincrono['Asincrono']['p6'])) $resumenByCentro = $this->AsincronoTemporal->query($sql);
			else $resumenByCentro = null;

			if($asincrono['Asincrono']['p5'] == 'XLS'):
				$columnas = array(
									'texto_19' => 'PADRON_BENEFICIARIO_#',
									'texto_13' => 'TITULAR_DOCUMENTO',
									'texto_14' => 'TITULAR_APELLIDO_NOMBRE',
									'texto_15' => 'TITULAR_TELEFONO_FIJO',
									'texto_16' => 'TITULAR_TELEFONO_MOVIL',
									'texto_17' => 'TITULAR_TELEFONO_MENSAJE',
									'texto_18' => 'TITULAR_EMAIL',	
									'texto_3' => 'BENEFICIARIO_DOCUMENTO',
									'texto_4' => 'BENEFICIARIO_APELLIDO_NOMBRE',
									'texto_5' => 'DOMICILIO',
									'texto_6' => 'BARRIO',
									'entero_1' => 'NRO_ORDEN',
									'texto_11' => 'FECHA_ORDEN',	
									'texto_7' => 'PRODUCTO_SERVICIO',
									'texto_8' => 'PERMANENTE',
									'texto_12' => 'FECHA_HASTA',
									'entero_2' => 'CANTIDAD',
									'decimal_1' => 'IMPORTE',
									'texto_9' => 'EMITIO',
									'texto_10' => 'CENTRO',
				);
				$datos = $this->AsincronoTemporal->getDetalleToExcel($this->params['url']['pid'],array('AsincronoTemporal.clave_1' => 'REPORTE_1'),array('AsincronoTemporal.texto_4'),$columnas);			
				$this->set('datos',$datos);
				$this->set('resumenByBarrio',$resumenByBarrio);
				$this->set('resumenByProducto',$resumenByProducto);
				$this->set('resumenByCentro',$resumenByCentro);

				$this->render('consulta_general_prodserv_xls','blank');	
						
			else:
			 
				$datos = $this->AsincronoTemporal->getTemporalByConditions($this->params['url']['pid'],array('AsincronoTemporal.clave_1' => 'REPORTE_1'),array('AsincronoTemporal.texto_7,AsincronoTemporal.texto_4'));
				$this->set('datos',$datos);
				$this->set('resumenByBarrio',$resumenByBarrio);
				$this->set('resumenByProducto',$resumenByProducto);
				$this->set('resumenByCentro',$resumenByCentro);
				$this->render('consulta_general_prodserv_pdf','pdf');
				
			endif;
				
		endif;
		
		$this->set('centros',$this->requestAction('/centros/getTodosList'));
		$this->set('asincrono',$asincrono);
		
	}
	
	function padron_beneficiarios(){
		
		$asincrono = null;
		
		if(!empty($this->data)):
			
//			debug($this->data);
			$asincrono = array();
			$asincrono['Asincrono']['proceso'] = 'padron_beneficiarios';
			$asincrono['Asincrono']['p1'] = $this->data['Reporte']['alta_centro_id'];
			$asincrono['Asincrono']['p2'] = $this->data['Reporte']['barrio'];
			$asincrono['Asincrono']['p3'] = $this->data['Reporte']['tipo_nivel_instruccion'];
			$asincrono['Asincrono']['p4'] = $this->data['Reporte']['tipo_discapacidad'];
			$asincrono['Asincrono']['p5'] = $this->data['Reporte']['tipo_ocupacion_oficio'];
			$asincrono['Asincrono']['p6'] = $this->data['Reporte']['tipo_ocupacion_oficio_actual'];
			$asincrono['Asincrono']['p7'] = $this->data['Reporte']['tipo_cobertura_medica'];
			$asincrono['Asincrono']['p8'] = $this->data['Reporte']['tipo_vivienda'];
			$asincrono['Asincrono']['p9'] = $this->data['Reporte']['tipo_condicion_vivienda'];
			$asincrono['Asincrono']['p10'] = $this->data['Reporte']['tipo_electricidad'];
			$asincrono['Asincrono']['p11'] = $this->data['Reporte']['tipo_agua'];
			$asincrono['Asincrono']['p12'] = $this->data['Reporte']['tipo_conexion_agua'];
			$asincrono['Asincrono']['p13'] = $this->data['Reporte']['tipo_banio'];
			$asincrono['Asincrono']['p14'] = $this->data['Reporte']['tipo_techo'];
			$asincrono['Asincrono']['p15'] = $this->data['Reporte']['tipo_piso'];
			$asincrono['Asincrono']['p16'] = $this->data['Reporte']['tipo_reporte'];
			$asincrono['Asincrono']['p17'] = $this->data['Reporte']['filtrado'];
			$asincrono['Asincrono']['p18'] = $this->data['Reporte']['condicion_ocupacion_actual'];
			$asincrono['Asincrono']['p19'] = (isset($this->data['Reporte']['vivienda_precaria']) ? 1:0);
			$asincrono['Asincrono']['p20'] = (isset($this->data['Reporte']['nbi']) ? 1:0);
			
			$asincrono['Asincrono']['action_do'] = "/reportes/padron_beneficiarios";
			$asincrono['Asincrono']['target'] = '_blank';
			$asincrono['Asincrono']['titulo'] = 'PADRON DE BENEFICIARIOS';
			
			$centro = null;
			if(!empty($asincrono['Asincrono']['p1'])):
				$centro = $this->Asincrono->getCentro($asincrono['Asincrono']['p1'],'descripcion');
			endif;			
					
			$asincrono['Asincrono']['subtitulo'] = "";
			$asincrono['Asincrono']['id'] = $this->Asincrono->crear($asincrono);			
		
		endif;
		
		if(isset($this->params['url']['pid'])):
		
			$asincrono = $this->Asincrono->read(null,$this->params['url']['pid']);
			
			if(empty($asincrono)) $this->redirect('consulta_general_prodserv');
			$centro = null;
			if(!empty($asincrono['Asincrono']['p1'])):
				$centro = $this->Asincrono->getCentro($asincrono['Asincrono']['p1'],'descripcion');
			endif;
			
			$this->set('centro',$centro);
			$this->set('asincrono',$asincrono);
			if($asincrono['Asincrono']['p16'] == 'XLS'):
				$columnas = array(
									'texto_19' => 'BENEFICIO_NRO',
									'texto_21' => 'PARENTEZCO',
									'texto_1' => 'TIPO_NRO_DOCUMENTO',
									'texto_22' => 'SEXO',
									'texto_23' => 'FECHA_NACIMIENTO',
									'entero_3' => 'EDAD',
									'texto_2' => 'APELLIDO_NOMBRE',
									'texto_3' => 'DOMICILIO',
									'texto_4' => 'BARRIO',
									'texto_5' => 'NIVEL_INSTRUCCION',
									'texto_6' => 'DISCAPACIDAD',
									'texto_7' => 'OCUP_OFICIO',
									'texto_8' => 'OCUP_OFICIO_ACTUAL',
									'texto_24' => 'CONDICION_LABORAL_ACTUAL',
									'texto_9' => 'COBERTURA_MEDICA',
									'texto_10' => 'VIVIENDA',
									'texto_11' => 'CONDICION_VIVIENDA',
									'texto_12' => 'ELECTRICIDAD',
									'texto_13' => 'AGUA',
									'texto_14' => 'CONEXION_AGUA',
									'texto_15' => 'BAÑO',
									'texto_16' => 'TECHO',
									'texto_17' => 'PISO',
									'texto_25' => 'VIVIENDA_PRECARIA',
									'texto_26' => 'NBI',
									'texto_18' => 'CENTRO',
				);
				$datos = $this->AsincronoTemporal->getDetalleToExcel($this->params['url']['pid'],array('AsincronoTemporal.clave_1' => 'REPORTE_1'),array(),$columnas);			
				$this->set('datos',$datos);

				$this->render('padron_beneficiarios_xls','blank');	
						
			else:
			 
				$datos = $this->AsincronoTemporal->getTemporalByConditions($this->params['url']['pid'],array('AsincronoTemporal.clave_1' => 'REPORTE_1'),array());
				$this->set('datos',$datos);
				if($asincrono['Asincrono']['p17'] == 'TITULARES_ADICIONALES') $this->render('padron_beneficiarios_adicionales_pdf','pdf');
				else $this->render('padron_beneficiarios_pdf','pdf');
				
			endif;			
			
		
		endif;		
		
		$this->set('centros',$this->requestAction('/centros/getTodosList'));
		$this->set('asincrono',$asincrono);
	}
	
	
}

?>