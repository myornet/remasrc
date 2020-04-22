<?php
/**
 * 
 * @author ADRIAN TORRES
 *
 */
class Usuario extends AppModel{
	
	var $name = "Usuario";
	
	var $belongsTo = array(
			'Centro' => array('className' => 'Centro',
								'foreignKey' => 'centro_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)			
	);	
	
	
    var $validate = array(
						'usuario' => array(
    										'usuario_R1' => array( 
			    										'rule' => VALID_NOT_EMPTY,
			    										'required' => true,
			    										'allowEmpty' => false,
			    										'on' => 'create',
			    										'message' => 'Requerido',
    													'last' => true
    													),    
    										'usuario_R2' => array( 
			    										'rule' => 'isUnique',
			    										'required' => true,
			    										'allowEmpty' => false,
			    										'on' => 'create',
			    										'message' => 'El Usuario ya existe.'
    													),
    									)
    					);	
	
    					
    					
    var $perfiles = array(1 => 'CONSULTA', 2 => 'OPERADOR', 3 => 'ADMINISTRADOR');					
	
	/**
	 * resetPassword
	 * Blanquea la clave del usuario asingando el nombre del usuario como clave inicial
	 */
	function resetPassword($id){
		$this->unbindModel(array('belongsTo' => array('Grupo')));
		$us = $this->read(null,$id);
		$pws = Security::hash($us['Usuario']['usuario'], null, true);
		$us['Usuario']['password'] = $pws;
		return $this->save($us);
	}	
	
	
}