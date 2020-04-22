<?php
class CentrosController extends AppController{

	var $name = "Centros";
	
	function beforeFilter(){ 
		parent::beforeFilter();  
 	}

 	
	function index(){
		$this->paginate = array('limit' => 30,'order' => array('Centro.descripcion' => 'ASC'));
		$this->set('centros', $this->paginate(null));			
	} 	
 	
	
	function edit($id = null){
		if(empty($id)) parent::noAutorizado();
		$this->Centro->bindModel(array('hasMany' => array('Usuario')));
		$this->Centro->recursive = 2;
		$centro = $this->Centro->read(null,$id);
		$this->set('centro',$centro);
		if (!empty($this->data)) {
			if ($this->Centro->save($this->data)){
				$this->Mensaje->okGuardar();
				$this->redirect(array('action'=>'index'));				
			}else{
				$this->Mensaje->errorGuardar();
			}
		}			
		$this->data = $centro;		
	}
	
	
	function add(){
		if (!empty($this->data)) {
			if ($this->Centro->save($this->data)){
				$this->Mensaje->okGuardar();
				$this->redirect(array('action'=>'index'));				
			}else{
				$this->Mensaje->errorGuardar();
			}
		}		
	}

	
	function del($id = null) {
		if(empty($id)) parent::noAutorizado();
		if ($this->Centro->del($id))$this->Mensaje->okBorrar();
		else $this->Mensaje->errorBorrar();
		$this->redirect(array('action'=>'index'));		
	}		
	
 	
	/**
	 * getList
	 * Metodo para armar un combo
	 * @return unknown
	 */
	function getList(){
		$this->Seguridad->allow('getList');
		$centros = $this->Centro->find('list',array('conditions'=>array('Centro.activo'=> 1),'fields' => array('descripcion'), 'order' => 'descripcion'));
		return $centros;
	} 
		
	function getTodosList(){
		$this->Seguridad->allow('getList');
		$centros = $this->Centro->find('list',array('conditions'=>array(),'fields' => array('descripcion'), 'order' => 'descripcion'));
		return $centros;
	} 	
	
}
?>