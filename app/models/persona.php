<?php
/**
*	24/08/2010
*	adrian
*
*/

class Persona extends AppModel{
	
	var $name = "Persona";
	
//    var $hasOne = array(
//				        'Beneficiario' => array(
//				            'className'  => 'Beneficiario',
//				            'conditions' => "",
//				            'order'      => ''
//				        ),    
//				        'BeneficiarioAdicional' => array(
//				            'className'  => 'BeneficiarioAdicional',
//				            'conditions' => "",
//				            'order'      => ''
//				        )
//    );	
	
    var $validate = array(
						'documento' => array( 
    										'R1' => array('rule' => VALID_NOT_EMPTY,'message' => ' ! '),
    										'Documento Existente' => array('rule' => "checkDocumento")
    									),
						'apellido' => array( 
    										'R1' => array('rule' => VALID_NOT_EMPTY,'message' => ' ! ')
    									),   
						'nombre' => array( 
    										'R1' => array('rule' => VALID_NOT_EMPTY,'message' => ' ! ')
    									),    									 									    
						'calle' => array( 
    										'R1' => array('rule' => VALID_NOT_EMPTY,'message' => ' ! ')
    									),
    					);


    function save($datos){
    	if(isset($datos['Persona']['documento'])) $datos['Persona']['documento'] = parent::fill(trim($datos['Persona']['documento']),8);
    	$persona = $this->getPersonaByTdocNdoc($datos['Persona']['tipo_documento'],$datos['Persona']['documento']);
    	if(!empty($persona)) return false;
    	$datos['Persona']['apellido'] = trim($datos['Persona']['apellido']);
    	$datos['Persona']['nombre'] = trim($datos['Persona']['nombre']);
    	$datos['Persona']['calle'] = trim($datos['Persona']['calle']);
    	$datos['Persona']['institucion'] = trim($datos['Persona']['institucion']);
    	$datos['Persona']['email'] = trim($datos['Persona']['email']);
    	return parent::save($datos);
    }					
    					
    function altaDeTitular($datos){
    	
    	$datos['Persona']['localidad'] = LOCALIDAD;
    	$datos['Persona']['codigo_postal'] = CP;
    	$datos['Persona']['provincia'] = PROVINCIA;
    	
    	//saco los datos del usuario que lo carga
    	$user = parent::getUserLogon();
    	$datos['Persona']['alta_centro_id'] = $user['Usuario']['centro_id'];

    	if(!$this->save($datos)) return 0;

		App::import('Model','Beneficiario');
		$oBENEFICIARIO = new Beneficiario();     	
    	
		$beneficiario = array();
		$beneficiario['Beneficiario'] = array(
			'id' => 0,
			'persona_id' => parent::getLastInsertID(),
			'fecha_alta' => $datos['Persona']['fecha_alta'],
			'alta_centro_id' => $user['Usuario']['centro_id'],
		);
		
		if(!$oBENEFICIARIO->save($beneficiario)) return 0;
		
		return $oBENEFICIARIO->getLastInsertID();
		
    }
    					
    function checkDocumento($datos){
    	debug($datos);
    	debug($this->data);
    	if(empty($this->data['Persona']['id'])) return true;
    	$persona = $this->find('all', array('conditions' => array('Persona.tipo_documento' => $this->data['Persona']['tipo_documento'],'Persona.documento' => $this->data['Persona']['documento'])));
    	if(!empty($persona)) return false;
    	return true;
    }	

    
    function getPersona($id){
    	$persona = $this->read(null,$id);
    	return $this->armaDatos($persona);
    }					

    /**
     * 
     * Enter description here ...
     * @param unknown_type $persona
     */
    function armaDatos($persona){
    	
    	if(empty($persona)) return $persona;
    	
    	$persona['Persona']['calle'] = utf8_encode($persona['Persona']['calle']);
    	
    	$persona['Persona']['tdoc'] = parent::getGlobalDato($persona['Persona']['tipo_documento'],'concepto_1');
    	$persona['Persona']['tdocndoc'] = $persona['Persona']['tdoc']." ".$persona['Persona']['documento'];
    	$persona['Persona']['apenom'] = utf8_encode($persona['Persona']['apellido'].", ".$persona['Persona']['nombre']);
    	
    	$persona['Persona']['barrio_d'] = parent::getGlobalDato($persona['Persona']['barrio'],'concepto_1');
    	$persona['Persona']['calle_nro'] = utf8_encode($persona['Persona']['calle'])." ".$persona['Persona']['numero'];
    	$persona['Persona']['domicilio'] = $persona['Persona']['calle_nro'] . " ". $persona['Persona']['localidad']." (CP ".$persona['Persona']['codigo_postal'].") ".$persona['Persona']['provincia'];
    	
    	$persona['Persona']['tipo_ocupacion_oficio_d'] = parent::getGlobalDato($persona['Persona']['tipo_ocupacion_oficio'],'concepto_1');
    	$persona['Persona']['tipo_ocupacion_oficio_actual_d'] = parent::getGlobalDato($persona['Persona']['tipo_ocupacion_oficio_actual'],'concepto_1');
    	$persona['Persona']['condicion_ocupacion_actual_d'] = parent::getGlobalDato($persona['Persona']['condicion_ocupacion_actual'],'concepto_1');
    	
    	$persona['Persona']['tipo_cobertura_medica_d'] = parent::getGlobalDato($persona['Persona']['tipo_cobertura_medica'],'concepto_1');
    	$persona['Persona']['tipo_nivel_instruccion_d'] = parent::getGlobalDato($persona['Persona']['tipo_nivel_instruccion'],'concepto_1');
    	$persona['Persona']['tipo_discapacidad_d'] = parent::getGlobalDato($persona['Persona']['tipo_discapacidad'],'concepto_1');
    	$persona['Persona']['tipo_vivienda_d'] = parent::getGlobalDato($persona['Persona']['tipo_vivienda'],'concepto_1');
    	$persona['Persona']['tipo_condicion_vivienda_d'] = parent::getGlobalDato($persona['Persona']['tipo_condicion_vivienda'],'concepto_1');
    	$persona['Persona']['tipo_electricidad_d'] = parent::getGlobalDato($persona['Persona']['tipo_electricidad'],'concepto_1');
    	$persona['Persona']['tipo_agua_d'] = parent::getGlobalDato($persona['Persona']['tipo_agua'],'concepto_1');
    	$persona['Persona']['tipo_banio_d'] = parent::getGlobalDato($persona['Persona']['tipo_banio'],'concepto_1');
    	$persona['Persona']['tipo_techo_d'] = parent::getGlobalDato($persona['Persona']['tipo_techo'],'concepto_1');
    	$persona['Persona']['tipo_piso_d'] = parent::getGlobalDato($persona['Persona']['tipo_piso'],'concepto_1');
    	
    	$persona['Persona']['tipo_conexion_agua_d'] = parent::getGlobalDato($persona['Persona']['tipo_conexion_agua'],'concepto_1');
    	
    	
    	$persona['Persona']['alta_centro_id_d'] = parent::getCentro($persona['Persona']['alta_centro_id'],'descripcion');
    	
    	$persona['Persona']['institucion_anio_grado_d'] = NULL;
    	if(!empty($persona['Persona']['institucion'])):
    	
    		if($persona['Persona']['institucion_anio_grado'] != 0 && !empty($persona['Persona']['institucion_turno'])):
    			$persona['Persona']['institucion_anio_grado_d'] = $persona['Persona']['institucion']." (".$persona['Persona']['institucion_anio_grado']." - " . $persona['Persona']['institucion_turno'] .")";
    		endif;
    		
    	endif;
    	
    	$persona['Persona']['edad'] = $this->edad($persona['Persona']['fecha_nacimiento']);
    	
    	
   	// DEBUG($persona);
    	
		App::import('Model','Beneficiario');
		$oBENEFICIARIO = new Beneficiario(); 
		App::import('Model','BeneficiarioAdicional');
		$oADICIONAL = new BeneficiarioAdicional(); 		

		$beneficioTitular = $oBENEFICIARIO->getNroBeneficioTitular($persona['Persona']['id']);
		$persona['Persona']['nro_beneficio'] = "";
		$persona['Persona']['nro_beneficio_condicion'] = "";
		if($beneficioTitular != 0):
			$persona['Persona']['nro_beneficio'] = $beneficioTitular;
			$persona['Persona']['nro_beneficio_condicion'] = "TITULAR";
		endif;
    	$beneficioAdicional = $oADICIONAL->getNroBeneficioAdicional($persona['Persona']['id']);
		if($beneficioAdicional != 0):
			$persona['Persona']['nro_beneficio'] = $beneficioAdicional;
			$persona['Persona']['nro_beneficio_condicion'] = "ADICIONAL";
		endif;    	
//		debug($persona);
		
//		App::import('Model','BeneficiarioAdicional');
//		$oBEN = new BeneficiarioAdicional(); 
//
//		$beneficiario['BeneficiarioAdicional'] = array();
//		
//		$adicionales = $oBEN->getByBeneficiario($beneficiario['Beneficiario']['id']);
//		if(!empty($adicionales)) $beneficiario['BeneficiarioAdicional'] = Set::extract("{n}.BeneficiarioAdicional",$adicionales);
		
    	return $persona;
    	
    }    

    
    function getPersonaString($id){
    	$persona = $this->read(null,$id);
    	if(empty($persona)) return null;
    	$tdoc = parent::getGlobalDato($persona['Persona']['tipo_documento'],'concepto_1');
    	$str = $tdoc." ".$persona['Persona']['documento'];
    	$str .= " - " . $persona['Persona']['apellido'].", ".$persona['Persona']['nombre'];    	
    	return $str;
    }
    
    
    function getPersonasByConditions($conditions){
		$personas = $this->find('all',array('conditions' => $conditions,'order' => array('Persona.apellido' => 'ASC', 'Persona.nombre' => 'ASC')));
    	return $personas;
    }
    
    function getPersonaByTdocNdoc($tDoc,$nDoc){
    	$conditions = array();
    	$conditions['Persona.tipo_documento'] = $tDoc;
    	$conditions['Persona.documento'] = $nDoc;
    	$personas = $this->getPersonasByConditions($conditions);
    	if(empty($personas)) return null;
    	foreach($personas as $i => $persona):
    		$personas[$i] = $this->armaDatos($persona);
    	endforeach;
		return $personas;
    }
    
 	/**
 	 * Obtiene los datos de la red de conexiones activas
 	 * @param unknown_type $persona_id
 	 */   
    function getDatosRed($persona_id){
    	$red = array();
    	$oCONN = ClassRegistry::init('Conexion');
    	$conexiones = $oCONN->getActivas();
    	if(empty($conexiones)) return null;
    	$persona = $this->read(null,$persona_id);
    	foreach($conexiones as $conexion):
    		$params = array();
    		$params[0] = substr($persona['Persona']['tipo_documento'],8,4);
    		$params[1] = $persona['Persona']['documento'];
//    		$params[1] = "21838700";
    		$red[$conexion['Conexion']['id']] = $oCONN->getRemoteObject($conexion['Conexion']['id'],'getPersonaByTdocNdoc',$params);
    	endforeach;
		return $red;    	
    }
    
    /**
     * Obtiene los datos de la persona para una conexion especifica
     * @param $connID
     * @param $persID
     */
    function getFichaRemota($connID,$persID){
    	$response = array();
    	$oCONN = ClassRegistry::init('Conexion');
    	$conexion = $oCONN->getConexionByID($connID);
    	if($conexion['Conexion']['activo'] == 0) return null;
    	$response['municipio'] = $conexion['Conexion']['municipalidad'];
    	$response['response'] = $oCONN->getRemoteObject($conexion['Conexion']['id'],'getFichaPersonaById',array($persID));
    	return $response;
    }
    
    
	function edad($edad){
		list($anio,$mes,$dia) = explode("-",$edad);
		$anio_dif = date("Y") - $anio;
		$mes_dif = date("m") - $mes;
		$dia_dif = date("d") - $dia;
		if ($dia_dif < 0 || $mes_dif < 0)
		$anio_dif--;
		return $anio_dif;
	}    
    
	
}

?>