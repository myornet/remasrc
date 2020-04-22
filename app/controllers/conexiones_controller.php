<?php
class ConexionesController extends AppController {

	var $name = 'Conexiones';
	
	function index(){
		$this->paginate = array('limit' => 30,'order' => array('Conexion.municipalidad' => 'ASC'));
		$this->set('conexiones', $this->paginate(null));		
	}
	
	function edit($id = null){
		if(empty($id)) parent::noAutorizado();
		if (!empty($this->data)) {
			if ($this->Conexion->save($this->data)){
				$this->Mensaje->okGuardar();
				$this->redirect(array('action'=>'index'));				
			}else{
				$this->Mensaje->errorGuardar();
			}
		}			
		$this->data = $this->Conexion->read(null,$id);;		
	}	
	
	function add(){
		if (!empty($this->data)) {
			if ($this->Conexion->save($this->data)){
				$this->Mensaje->okGuardar();
				$this->redirect(array('action'=>'index'));				
			}else{
				$this->Mensaje->errorGuardar();
			}
		}		
	}
	
	function del($id = null) {
		if(empty($id)) parent::noAutorizado();
		if ($this->Conexion->del($id))$this->Mensaje->okBorrar();
		else $this->Mensaje->errorBorrar();
		$this->redirect(array('action'=>'index'));		
	}	
	
	function setActivoOnOff($field,$id,$option){
		if(!parent::isAdministrador()){
			echo ($option == 1 ? 0 : 1);
			exit;			
		}
		Configure::write('debug',0);
		$conex = $this->Conexion->read(null, $id);
		$conex['Conexion'][$field] = $option;
		$this->Conexion->save($conex);
		echo $option;
		exit;
	}	
	
	
	function reset_pin_local($conexion_id,$pinActual){
		Configure::write('debug',0);
		if(!parent::isAdministrador()){
			echo $pinActual;
			exit;			
		}
		$newPIN  = $this->Conexion->regenerarPIN($conexion_id);
		echo $newPIN;
		exit;
//		$this->redirect(array('action'=>'index'));
	}
	
}
?>
