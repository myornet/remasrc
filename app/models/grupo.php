<?php
class Grupo extends AppModel{
	
	var $name = 'Grupo';
	
    var $validate = array(
						'nombre' => array( 
    										'nombre_R1' => array('rule' => VALID_NOT_EMPTY,'message' => 'Requerido','last' => true),
    										'nombre_R2' => array('rule' => 'isUnique','message' => 'Ya existe un Grupo con este Nombre')
    									)
    					);

    					
    /**
     * (non-PHPdoc)
     * @see cake/libs/model/Model#del($id, $cascade)
     */					
    function del($id){
		$this->bindModel(array('hasMany' => array('Usuario')));
		$grupo = $this->read(null,$id);
		if(!empty($grupo['Usuario'])) return false;
		//borro los permisos
 		App::import('Model','Permiso');
 		$oPERMISO = new Permiso();
 		$oPERMISO->deleteAll("Permiso.grupo_id = $id");		    	
    	return parent::del($id);
    }					
	
}
?>