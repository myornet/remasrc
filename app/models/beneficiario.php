<?php
/**
* 	adrian
* 	20/08/2010
*/



class Beneficiario extends AppModel{
	
	/**
	 * 
	 * Enter description here ...
	 * @var unknown_type
	 */
	var $name = "Beneficiario";
	
	/**
	 * 
	 * Enter description here ...
	 * @var unknown_type
	 */
    var $belongsTo = array('Persona' =>
                           array('className'  => 'Persona',
                                 'conditions' => '',
                                 'order'      => '',
                                 'foreignKey' => 'persona_id'
                           )
    );

    /**
     * 
     * Enter description here ...
     * @var unknown_type
     */
    var $hasMany = array(
        'BeneficiarioAdicional' => array(
            'className'  => 'BeneficiarioAdicional',
            'conditions' => 'BeneficiarioAdicional.estado = 1',
            'order'      => ''
        )
    );    
	
    /**
     * 
     * Enter description here ...
     * @var unknown_type
     */
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
	

    /**
     * 
     * Enter description here ...
     * @param $id
     */					
    function getBeneficiario($id){
    	$beneficiario = $this->read(null,$id);
    	if(empty($beneficiario)) return null;
		App::import('Model','Persona');
		$oPERSONA = new Persona();     	
		$persona = $oPERSONA->getPersona($beneficiario['Beneficiario']['persona_id']);
		if(empty($persona)) return null;
		$beneficiario['Persona'] = $persona['Persona'];
    	return $this->armaDatos($beneficiario);
    }					

    
    function getBeneficiarioByPersonaId($persona_id){
    	$beneficiario = $this->find('all',array('conditions' => array('Beneficiario.persona_id' => $persona_id)));
    	if(empty($beneficiario)) return null;
    	return $beneficiario[0];
    }
    
    /**
     * 
     * Enter description here ...
     * @param $id
     */
    function getTitularString($id){
    	$beneficiario = $this->read(null,$id);
    	if(empty($beneficiario)) return null;
		App::import('Model','Persona');
		$oPERSONA = new Persona();     	
    	return $oPERSONA->getPersonaString($beneficiario['Beneficiario']['persona_id']);
    }
    
    /**
     * 
     * Enter description here ...
     * @param unknown_type $beneficiario
     */
    private function armaDatos($beneficiario){
    	if(empty($beneficiario)) return $beneficiario;
    	$beneficiario['Beneficiario']['alta_centro_id_d'] = parent::getCentro($beneficiario['Beneficiario']['alta_centro_id'],'descripcion');
 		App::import('Model','BeneficiarioAdicional');
		$oBEN = new BeneficiarioAdicional(); 
		$beneficiario['adicionales'] = $oBEN->getByBeneficiario($beneficiario['Beneficiario']['id']);
    	return $beneficiario;
    }
    
    /**
     * 
     * Enter description here ...
     * @param $id
     */
    function getListMiembrosGrupoFliar($id){
    	$this->unbindModel(array('belongsTo' => array('Persona')));
    	$this->BeneficiarioAdicional->unbindModel(array('belongsTo' => array('Persona')));
    	$beneficiario = $this->read(null,$id);
    	if(empty($beneficiario)) return null;
		App::import('Model','Persona');
		$oPERSONA = new Persona();   
		$lista = array();
		App::import('Model','Persona');
		$oPERSONA = new Persona();
		$lista[$beneficiario['Beneficiario']['persona_id']] = $oPERSONA->getPersonaString($beneficiario['Beneficiario']['persona_id'])." *** TITULAR ***";
		if(empty($beneficiario['BeneficiarioAdicional'])) return $lista;
		foreach($beneficiario['BeneficiarioAdicional'] as $adicional):
			if($adicional['nuevo_titular_beneficio_id'] == 0)$lista[$adicional['persona_id']] = $oPERSONA->getPersonaString($adicional['persona_id']);
		endforeach;
		return $lista;
    }
    
    /**
     * 
     * Enter description here ...
     * @param $datos
     */
    function guardar($datos){
		App::import('Model','Persona');
		$oPERSONA = new Persona();
		if(!empty($datos['Persona'])) $oPERSONA->save($datos);
    	return parent::save($datos);
    }

    /**
     * 
     * Enter description here ...
     */
    function checkDocumento(){
    	if(empty($this->data['Beneficiario']['id'])) return true;
    	$beneficiario = $this->find('all', array('conditions' => array('Beneficiario.tipo_documento' => $this->data['Beneficiario']['tipo_documento'],'Beneficiario.documento' => $this->data['Beneficiario']['documento'])));
    	if(!empty($beneficiario)) return false;
    	return true;
    }

    function getNroBeneficioTitular($persona_id){
    	$this->unbindModel(array('belongsTo' => array('Persona'),'hasMany' => array('BeneficiarioAdicional')));
    	$beneficio = $this->find('all',array('conditions' => array('Beneficiario.persona_id' => $persona_id,'Beneficiario.estado' => 1)));
    	if(!empty($beneficio)) return $beneficio[0]['Beneficiario']['id'];
    	else return 0;
    }
    
    
    function eliminarBeneficio($beneficio_id){
    	$beneficio = $this->read(null,$beneficio_id);
    	if(empty($beneficio)) return false;
    	if(!empty($beneficio['BeneficiarioAdicional'])) return false;
    	//controlar si tiene consumos
		App::import('Model','BeneficiarioBeneficio');
		$oORDEN = new BeneficiarioBeneficio();
		$ordenes = $oORDEN->getOrdenesByBeneficioId($beneficio_id);
		if(!empty($ordenes)) return false;
    	return $this->del($beneficio_id);
    }
    
    
    function unificar($idActual,$newId,$tipoParentezco){
    	//cargo los consumos y los reasigno
		App::import('Model','BeneficiarioBeneficio');
		$oORDEN = new BeneficiarioBeneficio();
		$ordenes = $oORDEN->getOrdenesByBeneficioId($idActual);
		if(!empty($ordenes)):
	    	foreach($ordenes as $orden):
	    		$orden['BeneficiarioBeneficio']['beneficiario_id'] = $newId;
	    		$oORDEN->save($orden);
	    	endforeach;
    	endif;
    	//cargo los adicionales
 		App::import('Model','BeneficiarioAdicional');
		$oBEN = new BeneficiarioAdicional();
		$adicionales = $oBEN->getByBeneficiario($idActual);
    	if(!empty($adicionales)):
    		foreach($adicionales as $adicional):
    			$adicional['BeneficiarioAdicional']['beneficiario_id'] = $newId;
    			$oBEN->save($adicional);
    		endforeach;
    	endif;
		//paso el titular del beneficio actual como adicional del nuevo
		$beneficioActual = $this->read(null,$idActual);
		
    	$nuevoAdicional = array();
    	$nuevoAdicional['BeneficiarioAdicional']['id'] = 0;
    	$nuevoAdicional['BeneficiarioAdicional']['beneficiario_id'] = $newId;
		$nuevoAdicional['BeneficiarioAdicional']['persona_id'] = $beneficioActual['Beneficiario']['persona_id'];
		$nuevoAdicional['BeneficiarioAdicional']['fecha_alta'] = date('Y-m-d');
		$nuevoAdicional['BeneficiarioAdicional']['tipo_parentezco'] = $tipoParentezco;
		$nuevoAdicional['BeneficiarioAdicional']['fecha_baja'] = null;
		$nuevoAdicional['BeneficiarioAdicional']['estado'] = 1;
    	$user = parent::getUserLogon();
    	$nuevoAdicional['BeneficiarioAdicional']['alta_centro_id'] = $user['Usuario']['centro_id'];	
    	$oBEN->save($nuevoAdicional);
		$this->del($idActual);
    	return true;
    	
    }
    
    
    
}

?>