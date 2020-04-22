<?php
class GruposController extends AppController{
	
	var $name = "Grupos";
	
	
	function beforeFilter(){ 
		parent::beforeFilter();  
 	}	
	
	function index(){
		$this->paginate = array('limit' => 30,'order' => array('Grupo.nombre' => 'ASC'));
		$this->set('grupos', $this->paginate(null));			
	}
	
	
	function edit($id=null){
		if(empty($id)) parent::noAutorizado();
		$this->Grupo->bindModel(array('hasMany' => array('Usuario')));
		$this->Grupo->Usuario->bindModel(array('belongsTo' => array('Centro')));
		$this->Grupo->recursive = 2;
		$grupo = $this->Grupo->read(null,$id);
		$this->set('grupo',$grupo);
		
		if (!empty($this->data)) {
			if ($this->Grupo->save($this->data)){
				$this->Mensaje->okGuardar();
				$this->redirect(array('action'=>'index'));				
			}else{
				$this->Mensaje->errorGuardar();
			}
		}			
		
		$this->data = $grupo;		
	}
	
	
	function add(){
		if (!empty($this->data)) {
			if ($this->Grupo->save($this->data)){
				$this->Mensaje->okGuardar();
				$this->redirect(array('action'=>'index'));				
			}else{
				$this->Mensaje->errorGuardar();
			}
		}		
	}
	
	
	function del($id = null) {
		if(empty($id)) parent::noAutorizado();
		if ($this->Grupo->del($id))$this->Mensaje->okBorrar();
		else $this->Mensaje->error("No se puede eliminar el Grupo porque tiene Usuarios asignados.");
		$this->redirect(array('action'=>'index'));		
	}
	
	
	function permisos($id=null){
 		if(empty($id)) parent::noAutorizado();
 		$grupo = $this->Grupo->read(null,$id);
 		$this->set('grupo',$grupo);	
 		
 		App::import('Model','Permiso');
 		$oPERMISO = new Permiso(); 	
 		
 		if(!empty($this->data)){
 			
 			if(!empty($this->data['Permiso'])):
 			
 				$permiso = array();
 				$permiso['Permiso'] = array();
 				$tmp = array();
 				
 				//borro todos los permisos actuales del grupo
 				$oPERMISO->deleteAll("Permiso.grupo_id = " . $this->data['Grupo']['grupo_id']);
 				
	 			foreach($this->data['Permiso'] as $menuId => $url):
	 				$tmp['id'] = 0;
	 				$tmp['grupo_id'] = $this->data['Grupo']['grupo_id'];
	 				$tmp['menu_id'] = $menuId;
	 				$tmp['url'] = $url;
	 				array_push($permiso['Permiso'],$tmp);
	 			endforeach;
 			endif;
 			if(!empty($permiso)) $oPERMISO->saveAll($permiso['Permiso']);
 		}

 		$permisosAsignados = $oPERMISO->find('list',array('conditions'=>array('Permiso.grupo_id'=> $id),'fields' => array('menu_id'), 'order' => 'menu_id'));
		$this->set('permisosAsignados',$permisosAsignados);
 		
 		
	}
	
	
	/**
	 * getList
	 * Metodo para armar un combo
	 * @return unknown
	 */
	function getList(){
		$this->Seguridad->allow('getList');
		$grupos = $this->Grupo->find('list',array('conditions'=>array('Grupo.activo'=>'=1'),'fields' => array('nombre'), 'order' => 'nombre'));
		return $grupos;
	}	
	
}
?>