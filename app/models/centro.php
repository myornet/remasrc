<?php
class Centro extends AppModel{
	
	var $name = "Centro";
	
    var $validate = array(
						'descripcion' => array( 
    										'descripcion_R1' => array('rule' => VALID_NOT_EMPTY,'message' => 'Requerido','last' => true),
    										'descripcion_R2' => array('rule' => 'isUnique','message' => 'Ya existe un Centro con esta descripcion',),
    									)
    					);	
	
    					
	/**
	 * Sobrecarga metodo delete para chequear que no se pueda borrar un centro que tiene usuarios
	 * (non-PHPdoc)
	 * @see cake/libs/model/Model#del($id, $cascade)
	 */
	function del($id){
		$this->bindModel(array('hasMany' => array('Usuario')));
		$centro = $this->read(null,$id);
		if(!empty($centro['Usuario'])) return false;
		return parent::del($id);
	}
	
	
}