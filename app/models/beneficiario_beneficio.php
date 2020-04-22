<?php
/**
* 	adrian
* 	20/08/2010
*/



class BeneficiarioBeneficio extends AppModel{
	
	var $name = "BeneficiarioBeneficio";
	
	
    var $belongsTo = array('Persona' =>
			                           array('className'  => 'Persona',
			                                 'conditions' => '',
			                                 'order'      => '',
			                                 'foreignKey' => 'persona_id'
			                           ),
			                'Beneficiario'  =>    
			                           array('className'  => 'Beneficiario',
			                                 'conditions' => '',
			                                 'order'      => '',
			                                 'foreignKey' => 'beneficiario_id'
			                           ),			                                 
    );

    var $hasMany = array('BeneficiarioBeneficioDetalle');
    
    function getByBeneficiario($beneficiario_id,$soloPermanentes=false){
    	return null;
    	$datos = array();
    	$conditions = array();
    	$conditions['BeneficiarioBeneficio.beneficiario_id'] = $beneficiario_id;
    	if($soloPermanentes) $conditions['BeneficiarioBeneficio.permanente'] = 1;
    	else $conditions['BeneficiarioBeneficio.permanente'] = 0;
    	
    	$order = array('BeneficiarioBeneficio.fecha DESC, BeneficiarioBeneficio.created DESC');
    	
    	$this->unbindModel(array("belongsTo" => array("Persona","Beneficiario")));
    	$datos = $this->find('all',array('conditions' => $conditions,'order' => $order));
    	
    	if(empty($datos)) return $datos;
    	
    	foreach($datos as $i => $dato):
    		$datos[$i] = $this->setDatosAdicionales($dato);
    	endforeach;
    	
    	return $datos;
    	
    }
    
    
    function getOrdenesByBeneficioId($beneficiario_id){
    	$conditions = array();
    	$conditions['BeneficiarioBeneficio.beneficiario_id'] = $beneficiario_id;    	
    	$this->unbindModel(array("belongsTo" => array("Persona","Beneficiario"), "hasMany" => array('BeneficiarioBeneficioDetalle')));
    	$datos = $this->find('all',array('conditions' => $conditions,'order' => 'BeneficiarioBeneficio.beneficiario_id DESC'));
    	if(empty($datos)) return $datos;
    	foreach($datos as $i => $dato):
    		$datos[$i] = $this->setDatosAdicionales($dato);
    	endforeach;
    	return $datos;
    }
    

    function setDatosAdicionales($dato,$renglones=true){
		
		
		//CARGO LOS DATOS DEL SOLICITANTE
		App::import('Model','Persona');
		$oPERSONA = new Persona();		
		$oPERSONA->unbindModel(array("hasOne" => array("Beneficiario","BeneficiarioAdicional")));
//		$dato['BeneficiarioBeneficio']['solicitante'] = $oPERSONA->getPersonaString($dato['BeneficiarioBeneficio']['persona_id']);

		App::import('Model','Beneficiario');
		$oBENEFICIARIO = new Beneficiario();			
		
		$dato['BeneficiarioBeneficio']['titular'] = $oBENEFICIARIO->getTitularString($dato['BeneficiarioBeneficio']['beneficiario_id']);
		
//		$dato['BeneficiarioBeneficio']['producto'] = parent::getGlobalDato($dato['BeneficiarioBeneficio']['codigo_producto'],"concepto_1");
		
		$dato['BeneficiarioBeneficio']['centro'] = "";
		
		if(!empty($dato['BeneficiarioBeneficio']['alta_centro_id'])) $dato['BeneficiarioBeneficio']['centro'] = parent::getCentro($dato['BeneficiarioBeneficio']['alta_centro_id'],"descripcion");
		
		//cargo los renglones de la orden
		if($renglones):
			App::import('Model','BeneficiarioBeneficioDetalle');
			$oRENGLON = new BeneficiarioBeneficioDetalle();		
			$dato['BeneficiarioBeneficioDetalle'] = array();
//			$dato['BeneficiarioBeneficioDetalle'] = $oRENGLON->getRenglonesByOrden($dato['BeneficiarioBeneficio']['id']);
			$dato['BeneficiarioBeneficioDetalle'] = $oRENGLON->getRenglonesByOrderSorted($dato['BeneficiarioBeneficio']['id']);
		endif;
    	return $dato;
    }
    
    function nuevoBeneficio($datos){
    	if(empty($datos['BeneficiarioBeneficio']['importe'])) $datos['BeneficiarioBeneficio']['importe'] = 0;
    	if(empty($datos['BeneficiarioBeneficio']['cantidad'])) $datos['BeneficiarioBeneficio']['cantidad'] = 0;
    	return parent::save($datos);
    }
    
    
    
    function generarOrden($cabecera,$renglones){
    	
    	$user = parent::getUserLogon();
    	
    	$orden = unserialize(base64_decode($cabecera));
    	$orden['BeneficiarioBeneficio']['alta_centro_id'] = $user['Usuario']['centro_id'];
    	$orden['BeneficiarioBeneficioDetalle'] = array();
		$tmp = array();
		foreach($renglones as $renglon):

			$tmp['persona_id'] = $renglon['BeneficiarioBeneficioDetalle']['persona_id'];
			$tmp['codigo_producto'] = $renglon['BeneficiarioBeneficioDetalle']['codigo_producto'];
			$tmp['cantidad'] = (!empty($renglon['BeneficiarioBeneficioDetalle']['cantidad']) ? $renglon['BeneficiarioBeneficioDetalle']['cantidad'] : 0);
			$tmp['importe'] = (!empty($renglon['BeneficiarioBeneficioDetalle']['importe']) ? $renglon['BeneficiarioBeneficioDetalle']['importe'] : 0);
			$tmp['permanente'] = (isset($renglon['BeneficiarioBeneficioDetalle']['permanente']) ? 1 : 0);
			$tmp['fecha_hasta'] = ($tmp['permanente'] == 1 ? $renglon['BeneficiarioBeneficioDetalle']['fecha_hasta'] : null);
			$tmp['observaciones'] = $renglon['BeneficiarioBeneficioDetalle']['observaciones'];
			array_push($orden['BeneficiarioBeneficioDetalle'],$tmp);
		
		endforeach;

		return parent::saveAll($orden);
    	
    }
    
    
    function getOrden($id){
    	$this->unbindModel(array("belongsTo" => array("Persona","Beneficiario")));
    	$orden = $this->read(null,$id);
    	$orden = $this->setDatosAdicionales($orden);
    	return $orden;
    }
    
	
    function borrar($id){
		App::import('Model','BeneficiarioBeneficioDetalle');
		$oRENGLON = new BeneficiarioBeneficioDetalle();    	
		if(!$oRENGLON->deleteAll("BeneficiarioBeneficioDetalle.beneficiario_beneficio_id = $id")) return false;
		return $this->del($id);
    }
    
    
    
}

?>