<?php
/**
* 	adrian
* 	20/08/2010
*/



class BeneficiarioBeneficioDetalle extends AppModel{
	
	var $name = "BeneficiarioBeneficioDetalle";
    var $belongsTo = array('Persona' =>
			                           array('className'  => 'Persona',
			                                 'conditions' => '',
			                                 'order'      => '',
			                                 'foreignKey' => 'persona_id'
			                           ),
			                'BeneficiarioBeneficio'  =>    
			                           array('className'  => 'BeneficiarioBeneficio',
			                                 'conditions' => '',
			                                 'order'      => '',
			                                 'foreignKey' => 'beneficiario_beneficio_id'
			                           ),			                                 
    );	
	
	
    function checkConsumosByPersonaId($persona_id){
    	$consumos = $this->find('count',array('conditions' => array('BeneficiarioBeneficioDetalle.persona_id' => $persona_id)));
    	if(!empty($consumos)) return false;
    	else return true;
    }
    
	function getRenglonesByOrden($ordenId){
		$renglones = $this->find('all',array('conditions' => array('BeneficiarioBeneficioDetalle.beneficiario_beneficio_id' => $ordenId)));
		$renglones = Set::extract("{n}.BeneficiarioBeneficioDetalle",$renglones);
		if(empty($renglones)) return $renglones;
		foreach($renglones as $idx => $renglon):
			$renglones[$idx] = $this->setDatos($renglon);		
		endforeach;
		return $renglones;
	}
	
	
	function getRenglonesByOrderSorted($ordenId){
		$renglones = array();
		$sql = "	SELECT 
					`BeneficiarioBeneficioDetalle`.`id`, `BeneficiarioBeneficioDetalle`.`persona_id`, 
					`BeneficiarioBeneficioDetalle`.`beneficiario_beneficio_id`, 
					`BeneficiarioBeneficioDetalle`.`codigo_producto`, 
					`BeneficiarioBeneficioDetalle`.`cantidad`, 
					`BeneficiarioBeneficioDetalle`.`importe`, 
					`BeneficiarioBeneficioDetalle`.`observaciones`, 
					`BeneficiarioBeneficioDetalle`.`permanente`, 
					`BeneficiarioBeneficioDetalle`.`fecha_hasta`, 
					`BeneficiarioBeneficioDetalle`.`user_created`, 
					`BeneficiarioBeneficioDetalle`.`user_modified`, 
					`BeneficiarioBeneficioDetalle`.`created`, 
					`BeneficiarioBeneficioDetalle`.`modified`, 
					`Persona`.`id`, 
					`Persona`.`tipo_documento`, 
					`Persona`.`documento`, 
					`Persona`.`apellido`, 
					`Persona`.`nombre`,
					`GlobalDato`.`concepto_1`
					FROM `beneficiario_beneficio_detalles` AS `BeneficiarioBeneficioDetalle` 
					INNER JOIN `personas` AS `Persona` ON (`BeneficiarioBeneficioDetalle`.`persona_id` = `Persona`.`id`) 
					INNER JOIN `beneficiario_beneficios` AS `BeneficiarioBeneficio` ON (`BeneficiarioBeneficioDetalle`.`beneficiario_beneficio_id` = `BeneficiarioBeneficio`.`id`)
					INNER JOIN `global_datos` AS `GlobalDato` ON (`BeneficiarioBeneficioDetalle`.`codigo_producto` = `GlobalDato`.`id`) 
					WHERE `BeneficiarioBeneficioDetalle`.`beneficiario_beneficio_id` = $ordenId
					ORDER BY `GlobalDato`.`concepto_1`,`Persona`.`apellido`,`Persona`.`nombre`;";
		$datos = $this->query($sql);
		if(empty($datos)) return null;
		$renglones = Set::extract("{n}.BeneficiarioBeneficioDetalle",$datos);
		foreach($renglones as $idx => $renglon):
			$renglones[$idx] = $this->setDatos($renglon);		
		endforeach;		
    	return $renglones;
	}
	
	
	
	function getRenglonesByBeneficiario($beneficiario_id,$soloPermanentes=false){
    	$conditions = array();
    	$conditions['BeneficiarioBeneficio.beneficiario_id'] = $beneficiario_id;    	
    	
    	if($soloPermanentes) $conditions['BeneficiarioBeneficioDetalle.permanente'] = 1;
    	else $conditions['BeneficiarioBeneficioDetalle.permanente'] = 0;
    	
    	$this->unbindModel(array("belongsTo" => array("Persona")));
    	$renglones = $this->find('all',array('conditions' => $conditions,'order' => 'BeneficiarioBeneficio.fecha DESC'));
    	$renglones = Set::extract("{n}.BeneficiarioBeneficioDetalle",$renglones);
		if(empty($renglones)) return $renglones;
		foreach($renglones as $idx => $renglon):
			$renglones[$idx] = $this->setDatos($renglon);		
		endforeach;		
    	return $renglones;
    	
	}
	
	
    function getOrdenesByBeneficioIdAndPersonaId($beneficiario_id,$persona_id){
    	$conditions = array();
    	$conditions['BeneficiarioBeneficio.beneficiario_id'] = $beneficiario_id;
    	$conditions['BeneficiarioBeneficioDetalle.persona_id'] = $persona_id;     	
		$this->unbindModel(array("belongsTo" => array("Persona")));    	
    	$datos = $this->find('all',array('conditions' => $conditions,'order' => 'BeneficiarioBeneficio.beneficiario_id DESC'));
    	if(empty($datos)) return $datos;
    	$datos = Set::extract("{n}.BeneficiarioBeneficioDetalle",$datos);
    	foreach($datos as $i => $dato):
    		$datos[$i] = $this->setDatos($dato);
    	endforeach;
    	return $datos;
    }	
	
    
    function reasignar($beneficiario_id,$persona_id_from,$persona_id_to){
    	$conditions = array();
    	$conditions['BeneficiarioBeneficio.beneficiario_id'] = $beneficiario_id;
    	$conditions['BeneficiarioBeneficioDetalle.persona_id'] = $persona_id_from;     	
		$this->unbindModel(array("belongsTo" => array("Persona")));    	
    	$datos = $this->find('all',array('conditions' => $conditions,'order' => 'BeneficiarioBeneficio.beneficiario_id DESC'));
    	if(empty($datos)) true; 
    	foreach($datos as $i => $dato):
    		$dato['BeneficiarioBeneficioDetalle']['persona_id'] = $persona_id_to;
    		if(!$this->save($dato)) return false;
    	endforeach;
    	return true;
    }
    
    
	
	function setDatos($renglon){
		App::import('Model','Persona');
		$oPERSONA = new Persona();	
		$renglon['solicitante_str'] = $oPERSONA->getPersonaString($renglon['persona_id']);
		$renglon['producto_str'] = parent::getGlobalDato($renglon['codigo_producto'],"concepto_1");
		$renglon['vencido'] = 0;
    	if($renglon['permanente'] == 1 && intval(date("Ymd",strtotime($renglon['fecha_hasta'])) < intval(date("Ymd")))){
			$renglon['vencido'] = 1;
		}
		//seteo los datos de la cabecera
		App::import('Model','BeneficiarioBeneficio');
		$oCAB = new BeneficiarioBeneficio();	
		$oCAB->unbindModel(array("belongsTo" => array("Persona","Beneficiario"),"hasMany" => array("BeneficiarioBeneficioDetalle")));
		$cabecera = $oCAB->read(null,$renglon['beneficiario_beneficio_id']);
		$cabecera = $oCAB->setDatosAdicionales($cabecera,false);
		
//		debug($cabecera);
		
		$renglon['orden_beneficio_id'] = $cabecera['BeneficiarioBeneficio']['beneficiario_id'];
		$renglon['orden_titular_persona_id'] = $cabecera['BeneficiarioBeneficio']['persona_id'];
		$renglon['orden_nro_str'] = "#".$renglon['beneficiario_beneficio_id'];
		$renglon['orden_fecha_str'] = date("d-m-Y",strtotime($cabecera['BeneficiarioBeneficio']['fecha']));
		$renglon['orden_emitida_str'] = $cabecera['BeneficiarioBeneficio']['centro'];
		$renglon['orden_titular_str'] = $cabecera['BeneficiarioBeneficio']['titular'];
		
		return $renglon;
	}
	
	function getRenglonesByPersonaIdSorted($personaId,$fechaDesde=null,$fechaHasta=null){
		$renglones = array();
		$sql = "	SELECT 
					`BeneficiarioBeneficioDetalle`.`id`, `BeneficiarioBeneficioDetalle`.`persona_id`, 
					`BeneficiarioBeneficioDetalle`.`beneficiario_beneficio_id`, 
					`BeneficiarioBeneficioDetalle`.`codigo_producto`, 
					`BeneficiarioBeneficioDetalle`.`cantidad`, 
					`BeneficiarioBeneficioDetalle`.`importe`, 
					`BeneficiarioBeneficioDetalle`.`observaciones`, 
					`BeneficiarioBeneficioDetalle`.`permanente`, 
					`BeneficiarioBeneficioDetalle`.`fecha_hasta`, 
					`BeneficiarioBeneficioDetalle`.`user_created`, 
					`BeneficiarioBeneficioDetalle`.`user_modified`, 
					`BeneficiarioBeneficioDetalle`.`created`, 
					`BeneficiarioBeneficioDetalle`.`modified`, 
					`Persona`.`id`, 
					`Persona`.`tipo_documento`, 
					`Persona`.`documento`, 
					`Persona`.`apellido`, 
					`Persona`.`nombre`,
					`GlobalDato`.`concepto_1`,
					`BeneficiarioBeneficio`.`id`,	
					`BeneficiarioBeneficio`.`fecha`,
					`BeneficiarioBeneficio`.`alta_centro_id`	
					FROM `beneficiario_beneficio_detalles` AS `BeneficiarioBeneficioDetalle` 
					INNER JOIN `personas` AS `Persona` ON (`BeneficiarioBeneficioDetalle`.`persona_id` = `Persona`.`id`) 
					INNER JOIN `beneficiario_beneficios` AS `BeneficiarioBeneficio` ON (`BeneficiarioBeneficioDetalle`.`beneficiario_beneficio_id` = `BeneficiarioBeneficio`.`id`)
					INNER JOIN `global_datos` AS `GlobalDato` ON (`BeneficiarioBeneficioDetalle`.`codigo_producto` = `GlobalDato`.`id`) 
					WHERE 
						`BeneficiarioBeneficioDetalle`.`persona_id` = $personaId 
						AND `BeneficiarioBeneficio`.`beneficiario_id` <> 0
						".(!empty($fechaDesde) ? "AND `BeneficiarioBeneficio`.`fecha` >= '" . date('Y-m-d',strtotime($fechaDesde))."'" : "")."
						".(!empty($fechaHasta) ? "AND `BeneficiarioBeneficio`.`fecha` <= '" . date('Y-m-d',strtotime($fechaHasta))."'" : "")."
					ORDER BY `BeneficiarioBeneficio`.`created` DESC,`GlobalDato`.`concepto_1`;";
		$datos = $this->query($sql);
		if(empty($datos)) return null;
		$renglones = Set::extract("{n}.BeneficiarioBeneficioDetalle",$datos);
		foreach($renglones as $idx => $renglon):
			$renglones[$idx] = $this->setDatos($renglon);		
		endforeach;		
    	return $renglones;
	}	
	
	
	
}

?>