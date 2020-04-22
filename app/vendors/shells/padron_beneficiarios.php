<?php 

/**
 *
 * PADRON DE BENEFICIARIOS CON FILTRO DE DATOS
 * 
 * @author adrian
 *
 *	/usr/bin/php5 /home/adrian/dev/www/remas/cake/console/cake.php padron_beneficiarios 1 -app /home/adrian/dev/www/remas/app/
 *
 */

class PadronBeneficiariosShell extends Shell{

	var $uses = array('Persona','BeneficiarioAdicional');
	
	function main(){
		
		App::import('Model','Asincrono');
		$oASINC = new Asincrono();
		$oASINC->id = $this->args[0];

		App::import('Model','AsincronoTemporal');
		$oTMP = new AsincronoTemporal();		

		$oTMP->limpiar($oASINC->id);
		
//		$asincrono['Asincrono']['p1'] = $this->data['Reporte']['alta_centro_id'];
//		$asincrono['Asincrono']['p2'] = $this->data['Reporte']['barrio'];
//		$asincrono['Asincrono']['p3'] = $this->data['Reporte']['tipo_nivel_instruccion'];
//		$asincrono['Asincrono']['p4'] = $this->data['Reporte']['tipo_discapacidad'];
//		$asincrono['Asincrono']['p5'] = $this->data['Reporte']['tipo_ocupacion_oficio'];
//		$asincrono['Asincrono']['p6'] = $this->data['Reporte']['tipo_ocupacion_oficio_actual'];
//		$asincrono['Asincrono']['p7'] = $this->data['Reporte']['tipo_cobertura_medica'];
//		$asincrono['Asincrono']['p8'] = $this->data['Reporte']['tipo_vivienda'];
//		$asincrono['Asincrono']['p9'] = $this->data['Reporte']['tipo_condicion_vivienda'];
//		$asincrono['Asincrono']['p10'] = $this->data['Reporte']['tipo_electricidad'];
//		$asincrono['Asincrono']['p11'] = $this->data['Reporte']['tipo_agua'];
//		$asincrono['Asincrono']['p12'] = $this->data['Reporte']['tipo_conexion_agua'];
//		$asincrono['Asincrono']['p13'] = $this->data['Reporte']['tipo_banio'];
//		$asincrono['Asincrono']['p14'] = $this->data['Reporte']['tipo_techo'];
//		$asincrono['Asincrono']['p15'] = $this->data['Reporte']['tipo_piso'];		
		
		$p1 = $oASINC->getParametro('p1');
		$p2 = $oASINC->getParametro('p2');
		$p3 = $oASINC->getParametro('p3');
		$p4 = $oASINC->getParametro('p4');
		$p5 = $oASINC->getParametro('p5');
		$p6 = $oASINC->getParametro('p6');
		$p7 = $oASINC->getParametro('p7');
		$p8 = $oASINC->getParametro('p8');		
		$p9 = $oASINC->getParametro('p9');
		$p10 = $oASINC->getParametro('p10');
		$p11 = $oASINC->getParametro('p11');
		$p12 = $oASINC->getParametro('p12');
		$p13 = $oASINC->getParametro('p13');
		$p14 = $oASINC->getParametro('p14');
		$p15 = $oASINC->getParametro('p15');		
		
		$p18 = $oASINC->getParametro('p18');
		$p19 = $oASINC->getParametro('p19');
		$p20 = $oASINC->getParametro('p20');

		$TIPO_REPORTE = $oASINC->getParametro('p17');

		$oASINC->actualizar(1,100,"ESPERE, INICIANDO PROCESO...");		
		
		$conditions = array();

		if(!empty($p1))$conditions['Persona.alta_centro_id'] = $p1;
		if(!empty($p2))$conditions['Persona.barrio'] = $p2;
		if(!empty($p3))$conditions['Persona.tipo_nivel_instruccion'] = $p3;
		if(!empty($p4))$conditions['Persona.tipo_discapacidad'] = $p4;
		if(!empty($p5))$conditions['Persona.tipo_ocupacion_oficio'] = $p5;
		if(!empty($p6))$conditions['Persona.tipo_ocupacion_oficio_actual'] = $p6;
		if(!empty($p7))$conditions['Persona.tipo_cobertura_medica'] = $p7;
		if(!empty($p8))$conditions['Persona.tipo_vivienda'] = $p8;
		if(!empty($p9))$conditions['Persona.tipo_condicion_vivienda'] = $p9;
		if(!empty($p10))$conditions['Persona.tipo_electricidad'] = $p10;
		if(!empty($p11))$conditions['Persona.tipo_agua'] = $p11;
		if(!empty($p12))$conditions['Persona.tipo_conexion_agua'] = $p12;
		if(!empty($p13))$conditions['Persona.tipo_banio'] = $p13;
		if(!empty($p14))$conditions['Persona.tipo_techo'] = $p14;
		if(!empty($p15))$conditions['Persona.tipo_piso'] = $p15;
		
		if(!empty($p18))$conditions['Persona.condicion_ocupacion_actual'] = $p18;
		if(!empty($p19))$conditions['Persona.vivienda_precaria'] = $p19;
		if(!empty($p20))$conditions['Persona.nbi'] = $p20;
		
//		$datos = $this->Persona->find('all',array('conditions' => $conditions,'order' => array('Persona.apellido' => 'ASC', 'Persona.nombre' => 'ASC')));
		
		$datos = $this->Persona->getPersonasByConditions($conditions);

		if(empty($datos)):
			$oASINC->actualizar(100,100,"NO EXISTEN DATOS PARA PROCESAR");
			$oASINC->fin();		
			return;
		endif;
		
		$temp = array();
		$total = count($datos);
		$oASINC->setTotal($total);
		$i = 0;		
		
		foreach($datos as $dato):
		
			$dato = $this->Persona->armaDatos($dato);
		
//			debug($dato);
		
			$MSG = "PROCESANDO :: " .$dato['Persona']['apellido'].", ".$dato['Persona']['nombre']; 
			
			$oASINC->actualizar($i,$total,$MSG);
			
			$temp['AsincronoTemporal'] = array(
				'id' => 0,
				'asincrono_id' => $oASINC->id,
				'clave_1' => 'REPORTE_1',
				'texto_1' => $dato['Persona']['tdocndoc'],
				'texto_2' => $dato['Persona']['apenom'],
				'texto_3' => $dato['Persona']['calle_nro'],
				'texto_4' => $dato['Persona']['barrio_d'],
				'texto_5' => $dato['Persona']['tipo_nivel_instruccion_d'],
				'texto_6' => $dato['Persona']['tipo_discapacidad_d'],
				'texto_7' => $dato['Persona']['tipo_ocupacion_oficio_d'],
				'texto_8' => $dato['Persona']['tipo_ocupacion_oficio_actual_d'],
				'texto_9' => $dato['Persona']['tipo_cobertura_medica_d'],
				'texto_10' => $dato['Persona']['tipo_vivienda_d'],
				'texto_11' => $dato['Persona']['tipo_condicion_vivienda_d'],
				'texto_12' => $dato['Persona']['tipo_electricidad_d'],
				'texto_13' => $dato['Persona']['tipo_agua_d'],
				'texto_14' => $dato['Persona']['tipo_conexion_agua_d'],
				'texto_15' => $dato['Persona']['tipo_banio_d'],
				'texto_16' => $dato['Persona']['tipo_techo_d'],
				'texto_17' => $dato['Persona']['tipo_piso_d'],
				'texto_18' => $dato['Persona']['alta_centro_id_d'],
				'texto_19' => $dato['Persona']['nro_beneficio'],
				'texto_20' => $dato['Persona']['nro_beneficio_condicion'],
				'texto_21' => $dato['Persona']['nro_beneficio_condicion'],
				'texto_22' => $dato['Persona']['sexo'],	
				'texto_23' => date('d/m/Y',strtotime($dato['Persona']['fecha_nacimiento'])),	
				'texto_24' => $dato['Persona']['condicion_ocupacion_actual_d'],
				'texto_25' => ($dato['Persona']['vivienda_precaria'] == 1 ? "SI":"NO"),
				'texto_26' => ($dato['Persona']['nbi'] == 1 ? "SI":"NO"),			
				'fecha_1' => $dato['Persona']['fecha_nacimiento'],	
				'entero_1' => $dato['Persona']['nro_beneficio'],
				'entero_2' => ($dato['Persona']['nro_beneficio_condicion'] == 'TITULAR' ? 1 : 2),
				'entero_3' => $dato['Persona']['edad'],

					
			);
			if($TIPO_REPORTE == 'GENERAL') $oTMP->save($temp);
			if(($TIPO_REPORTE == 'SOLO_TITULARES' || $TIPO_REPORTE == 'TITULARES_ADICIONALES') && $dato['Persona']['nro_beneficio_condicion'] == 'TITULAR'):
				 $oTMP->save($temp);
				 if($TIPO_REPORTE == 'TITULARES_ADICIONALES'):
				 	//cargar los adicionales
				 	$adicionales = $this->BeneficiarioAdicional->getByBeneficiario(intval($dato['Persona']['nro_beneficio']));
				 	$adicionales = Set::sort($adicionales, '{n}.Persona.apenom', 'asc');
				 	if(!empty($adicionales)):
				 	
				 		foreach($adicionales as $adicional):
							$temp['AsincronoTemporal'] = array(
								'id' => 0,
								'asincrono_id' => $oASINC->id,
								'clave_1' => 'REPORTE_1',
								'texto_1' => $adicional['Persona']['tdocndoc'],
								'texto_2' => $adicional['Persona']['apenom'],
								'texto_3' => $adicional['Persona']['calle_nro'],
								'texto_4' => $adicional['Persona']['barrio_d'],
								'texto_5' => $adicional['Persona']['tipo_nivel_instruccion_d'],
								'texto_6' => $adicional['Persona']['tipo_discapacidad_d'],
								'texto_7' => $adicional['Persona']['tipo_ocupacion_oficio_d'],
								'texto_8' => $adicional['Persona']['tipo_ocupacion_oficio_actual_d'],
								'texto_9' => $adicional['Persona']['tipo_cobertura_medica_d'],
								'texto_10' => $adicional['Persona']['tipo_vivienda_d'],
								'texto_11' => $adicional['Persona']['tipo_condicion_vivienda_d'],
								'texto_12' => $adicional['Persona']['tipo_electricidad_d'],
								'texto_13' => $adicional['Persona']['tipo_agua_d'],
								'texto_14' => $adicional['Persona']['tipo_conexion_agua_d'],
								'texto_15' => $adicional['Persona']['tipo_banio_d'],
								'texto_16' => $adicional['Persona']['tipo_techo_d'],
								'texto_17' => $adicional['Persona']['tipo_piso_d'],
								'texto_18' => $adicional['Persona']['alta_centro_id_d'],
								'texto_19' => $adicional['Persona']['nro_beneficio'],
								'texto_20' => $adicional['Persona']['nro_beneficio_condicion'],
								'texto_21' => $adicional['BeneficiarioAdicional']['tipo_parentezco_d'],
								'texto_22' => $adicional['Persona']['sexo'],	
								'texto_23' => date('d/m/Y',strtotime($adicional['Persona']['fecha_nacimiento'])),								
								'entero_1' => $adicional['Persona']['nro_beneficio'],
								'entero_2' => 2,
								'entero_3' => $adicional['Persona']['edad'],
							);
							$oTMP->save($temp);
						endforeach;				 	
				 	
				 	endif;
				 	
				 endif;
			endif;	 
			$i++;
		
		endforeach;
			
		
		$oASINC->actualizar(99,100,"FINALIZANDO...");
		$oASINC->fin("**** PROCESO FINALIZADO ****");
		
		return;		
		
	}
	
}

?>