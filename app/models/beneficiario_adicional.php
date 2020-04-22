<?php
/**
* 	adrian
* 	20/08/2010
*/



class BeneficiarioAdicional extends AppModel{
	
	var $name = "BeneficiarioAdicional";
	
	var $accionesAdministracion = array(
											1 => '1 - DAR DE BAJA',
											2 => '2 - DAR DE ALTA',
											3 => '2 - ASINGAR COMO TITULAR DE ESTE BENEFICIO',
											4 => '3 - ASINGAR COMO TITULAR DE UN NUEVO BENEFICIO',
											5 => '5 - INCORPORARLO A UN BENEFICIO EXISTENTE'
											
	);
	
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
    					);	
    					
	
    function getBeneficiarioAdicional($id){
    	$beneficiario = $this->read(null,$id);
		App::import('Model','Persona');
		$oPERSONA = new Persona();     	
		$persona = $oPERSONA->getPersona($beneficiario['BeneficiarioAdicional']['persona_id']);
		$beneficiario['Persona'] = $persona['Persona'];    	
    	return $this->armaDatos($beneficiario);
    }

    
    function getBeneficiarioAdicionalByPersonaId($persona_id){
    	$beneficiario = $this->find('all',array('conditions' => array('BeneficiarioAdicional.persona_id' => $persona_id)));
    	if(empty($beneficiario)) return null;
    	return $beneficiario[0];
    }
    

    
    function getByBeneficiario($beneficiario_id){
    	$beneficiarios = $this->find('all',array('conditions' => array('BeneficiarioAdicional.beneficiario_id' => $beneficiario_id,'BeneficiarioAdicional.nuevo_titular_beneficio_id' => 0)));
    	if(empty($beneficiarios)) return null;
		App::import('Model','Persona');
		$oPERSONA = new Persona();     	
    	foreach($beneficiarios as $i => $beneficiario):
    		$persona = $oPERSONA->getPersona($beneficiario['BeneficiarioAdicional']['persona_id']);
    		$beneficiario['Persona'] = $persona['Persona']; 
    		$beneficiarios[$i] = $this->armaDatos($beneficiario);
    	endforeach;
    	return $beneficiarios;
    }
    
    function getPersonasQueEstuvieronEnElGrupo($beneficiario_id){
    	$beneficiarios = $this->find('all',array('conditions' => array('BeneficiarioAdicional.beneficiario_id' => $beneficiario_id,'BeneficiarioAdicional.nuevo_titular_beneficio_id <>' => 0)));
    	if(empty($beneficiarios)) return null;
		App::import('Model','Persona');
		$oPERSONA = new Persona();     	
    	foreach($beneficiarios as $i => $beneficiario):
    		$persona = $oPERSONA->getPersona($beneficiario['BeneficiarioAdicional']['persona_id']);
    		$beneficiario['Persona'] = $persona['Persona']; 
    		$beneficiarios[$i] = $this->armaDatos($beneficiario);
    	endforeach;
    	return $beneficiarios;    	
    }

    function getByBeneficiarioList($beneficiario_id){
    	$lista = array();
    	$beneficiarios = $this->find('all',array('conditions' => array('BeneficiarioAdicional.beneficiario_id' => $beneficiario_id,'BeneficiarioAdicional.nuevo_titular_beneficio_id' => 0)));
    	if(empty($beneficiarios)) return null;
		App::import('Model','Persona');
		$oPERSONA = new Persona();     	
    	foreach($beneficiarios as $i => $beneficiario):
    		$persona = $oPERSONA->getPersona($beneficiario['BeneficiarioAdicional']['persona_id']);
    		$beneficiario['Persona'] = $persona['Persona']; 
    		$beneficiarios[$i] = $this->armaDatos($beneficiario);
    		$lista[$beneficiario['BeneficiarioAdicional']['id']] = $beneficiario['Persona']['tdocndoc'] ." - ". $beneficiario['Persona']['apenom'] .($beneficiario['BeneficiarioAdicional']['estado'] == 0 ? " (** BAJA EL ".$beneficiario['BeneficiarioAdicional']['fecha_baja']." **)" : "");
    	endforeach;
    	return $lista;
    }
    
    
    
    function armaDatos($beneficiario){
    	if(empty($beneficiario)) return $beneficiario;
 		$beneficiario['BeneficiarioAdicional']['tipo_parentezco_d'] = parent::getGlobalDato($beneficiario['BeneficiarioAdicional']['tipo_parentezco'],'concepto_1');
    	$beneficiario['BeneficiarioAdicional']['alta_centro_id_d'] = parent::getCentro($beneficiario['BeneficiarioAdicional']['alta_centro_id'],'descripcion');
    	return $beneficiario;
    }
    
    
    function nuevoAdicional($datos){
 		App::import('Model','Persona');
		$oPERSONA = new Persona();
        if(empty($datos['BeneficiarioAdicional']['id'])){
    		$user = parent::getUserLogon();
    		$datos['BeneficiarioAdicional']['alta_centro_id'] = $user['Usuario']['centro_id'];
    		$datos['Persona']['alta_centro_id'] = $user['Usuario']['centro_id'];
    	}
		if(!$oPERSONA->save($datos)) return false;
		$datos['BeneficiarioAdicional']['persona_id'] = $oPERSONA->getLastInsertID();	
    	return parent::save($datos);
    }

    function modificarAdicional($datos){
 		App::import('Model','Persona');
		$oPERSONA = new Persona();
		if(!$oPERSONA->save($datos)) return false;
    	return parent::save($datos);
    }    
    
    function checkDocumento(){
    	if(empty($this->data['BeneficiarioAdicional']['id'])) return true;
    	$beneficiario = $this->find('all', array('conditions' => array('BeneficiarioAdicional.tipo_documento' => $this->data['BeneficiarioAdicional']['tipo_documento'],'BeneficiarioAdicional.documento' => $this->data['BeneficiarioAdicional']['documento'])));
    	if(!empty($beneficiario)) return false;
    	return true;
    }	

   
    function borrar($id){
		App::import('Model','Persona');
		$oPERSONA = new Persona();     	
		$beneficiario = $this->read(null,$id);
		App::import('Model','BeneficiarioBeneficioDetalle');
		$oRENGLON = new BeneficiarioBeneficioDetalle();
		if(!$oRENGLON->checkConsumosByPersonaId($beneficiario['BeneficiarioAdicional']['persona_id'])) return false;
		if(!parent::del($id)) return false;
		return $oPERSONA->del($beneficiario['BeneficiarioAdicional']['persona_id']);
    }
    
    
    function administrar($id,$accion,$fechaAccion,$incorporaBeneficioId = null,$parentezco=null){
    	$fechaAccion = $fechaAccion['year']."-".$fechaAccion['month']."-".$fechaAccion['day'];
    	$adicional = $this->read(null,$id);
    	if($accion == 1 && $adicional['BeneficiarioAdicional']['estado'] == 1) return $this->bajaAdicional($id,$fechaAccion);
    	if($accion == 2 && $adicional['BeneficiarioAdicional']['estado'] == 0) return $this->altaAdicional($id,$fechaAccion);
    	if($accion == 3 && $adicional['BeneficiarioAdicional']['estado'] == 1) return $this->asignarComoTitularActual($id,$fechaAccion);
    	if($accion == 4 && $adicional['BeneficiarioAdicional']['estado'] == 1) return $this->asignarComoTitularNuevoBeneficio($id,$fechaAccion);
    	if($accion == 5 && $adicional['BeneficiarioAdicional']['estado'] == 1) return $this->incorporaOtroBeneficio($id,$incorporaBeneficioId,$parentezco,$fechaAccion);
    }
    
    private function bajaAdicional($id,$fecha=null,$motivo=null){
    	$adicional = $this->read(null,$id);
    	$adicional['BeneficiarioAdicional']['estado'] = 0;
    	$adicional['BeneficiarioAdicional']['fecha_baja'] = (empty($fecha) ? date('Y-m-d') : (date('Y-m-d', strtotime($fecha))));
		return $this->save($adicional);    	
    }
    private function altaAdicional($id,$fecha=null){
    	$adicional = $this->read(null,$id);
    	$adicional['BeneficiarioAdicional']['estado'] = 1;
    	$adicional['BeneficiarioAdicional']['fecha_alta'] = (empty($fecha) ? date('Y-m-d') : (date('Y-m-d', strtotime($fecha))));
    	$adicional['BeneficiarioAdicional']['fecha_baja'] = null;
 		return $this->save($adicional);    	
    }    
    
    private function asignarComoTitularActual($id,$beneficiarioId,$fecha=null){
    	$fecha = (empty($fecha) ? date('Y-m-d') : (date('Y-m-d', strtotime($fecha))));
    	$adicional = $this->read(null,$id);
    	if(!parent::del($id)) return false;
		App::import('Model','Beneficiario');
		$oTITULAR = new Beneficiario();      	
		$oTITULAR->unbindModel(array('hasMany' => array('BeneficiarioAdicional'),'belongsTo' => array('Persona')));
    	$titularActual = $oTITULAR->read(null,$adicional['BeneficiarioAdicional']['beneficiario_id']);
    	$nuevoAdicional = array();
    	$nuevoAdicional['BeneficiarioAdicional']['id'] = 0;
    	$nuevoAdicional['BeneficiarioAdicional']['beneficiario_id'] = $adicional['BeneficiarioAdicional']['beneficiario_id'];
		$nuevoAdicional['BeneficiarioAdicional']['persona_id'] = $titularActual['Beneficiario']['persona_id'];
		$nuevoAdicional['BeneficiarioAdicional']['fecha_alta'] = $fecha;
		$nuevoAdicional['BeneficiarioAdicional']['tipo_parentezco'] = $adicional['BeneficiarioAdicional']['tipo_parentezco'];
		$nuevoAdicional['BeneficiarioAdicional']['fecha_baja'] = null;
		$nuevoAdicional['BeneficiarioAdicional']['estado'] = 1;
    	$user = parent::getUserLogon();
    	$nuevoAdicional['BeneficiarioAdicional']['alta_centro_id'] = $user['Usuario']['centro_id'];		
    	if(!parent::save($nuevoAdicional)) return false;
    	$titularActual['Beneficiario']['persona_id'] = $adicional['BeneficiarioAdicional']['persona_id'];
    	$titularActual['Beneficiario']['fecha_alta'] = $fecha;
    	return $oTITULAR->save($titularActual);
    }
    
    /**
     * Un Adicional pasa a ser un nuevo titular de un nuevo beneficio.
     * Se lo da de baja y se le carga el id del beneficio del cual es titular
     * @param unknown_type $id
     * @param unknown_type $fecha
     */
    private function asignarComoTitularNuevoBeneficio($id,$fecha=null){
    	$fecha = (empty($fecha) ? date('Y-m-d') : (date('Y-m-d', strtotime($fecha))));
    	$adicional = $this->read(null,$id);
//    	if(!parent::del($id)) return false;
    	$nuevoTitular = array();
    	$nuevoTitular['Beneficiario']['id'] = 0;
    	$nuevoTitular['Beneficiario']['persona_id'] = $adicional['BeneficiarioAdicional']['persona_id'];
    	$nuevoTitular['Beneficiario']['fecha_alta'] = $fecha;
    	$user = parent::getUserLogon();
    	$nuevoTitular['Beneficiario']['alta_centro_id'] = $user['Usuario']['centro_id'];
		App::import('Model','Beneficiario');
		$oTITULAR = new Beneficiario();     	
    	if(!$oTITULAR->save($nuevoTitular)) return false;
    	
    	$adicional['BeneficiarioAdicional']['fecha_baja'] = $fecha;
    	$adicional['BeneficiarioAdicional']['estado'] = 0;
    	$adicional['BeneficiarioAdicional']['nuevo_titular_beneficio_id'] = $oTITULAR->getLastInsertID();
    	$adicional['BeneficiarioAdicional']['observaciones'] = "*** TITULAR BENEFICIO #".$adicional['BeneficiarioAdicional']['nuevo_titular_beneficio_id']." ***";
    	
    	return $this->save($adicional);

    }
    
    
    /**
     * Incorpora el adicional a un beneficio existente y lo da de baja del actual
     * @param $id
     * @param $nuevoBeneficioId
     * @param $fecha
     */
    function incorporaOtroBeneficio($id,$nuevoBeneficioId,$parentezco,$fecha=null){
    	
    	$fecha = (empty($fecha) ? date('Y-m-d') : (date('Y-m-d', strtotime($fecha))));
    	
    	$adicional = $this->read(null,$id); 
    	//borro el adicional del beneficio actual
    	
//    	if(!$this->bajaAdicional($id,$fecha,"*** ASIGNADO AL BENEFICIO #$nuevoBeneficioId ***")) return false;
    	
    	//cargo un nuevo adicional para el nuevo beneficio id
    	$nuevoAdicional = array();
    	$nuevoAdicional['BeneficiarioAdicional']['id'] = 0;
    	$nuevoAdicional['BeneficiarioAdicional']['beneficiario_id'] = $nuevoBeneficioId;
		$nuevoAdicional['BeneficiarioAdicional']['persona_id'] = $adicional['BeneficiarioAdicional']['persona_id'];
		$nuevoAdicional['BeneficiarioAdicional']['fecha_alta'] = $fecha;
		$nuevoAdicional['BeneficiarioAdicional']['tipo_parentezco'] = $parentezco;
		$nuevoAdicional['BeneficiarioAdicional']['fecha_baja'] = null;
		$nuevoAdicional['BeneficiarioAdicional']['estado'] = 1;
    	$user = parent::getUserLogon();
    	$nuevoAdicional['BeneficiarioAdicional']['alta_centro_id'] = $user['Usuario']['centro_id'];	
    	if(!parent::save($nuevoAdicional)) return false;
		
    	if(!parent::del($id)) return false;
    	
    	return true;
    }
    
    
    function getNroBeneficioAdicional($persona_id){
    	$this->unbindModel(array('belongsTo' => array('Persona','Beneficiario')));
    	$beneficio = $this->find('all',array('conditions' => array('BeneficiarioAdicional.persona_id' => $persona_id,'BeneficiarioAdicional.estado' => 1)));
    	if(!empty($beneficio)) return $beneficio[0]['BeneficiarioAdicional']['beneficiario_id'];
    	else return 0;
    }

    
}

?>