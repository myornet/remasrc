<?php


//App::import(array('Auth'));

/**
 * 
 * @author ADRIAN TORRES
 *
 */
//class SeguridadComponent extends AuthComponent {
class SeguridadComponent extends Object {
	
	function allow($actions=array()){
//		parent::allow($actions);
	}
	function logout(){}
	
	function user(){
//		$user = parent::user();
// 		App::import('Model','Usuario');
// 		$oUSUARIO = new Usuario();  		
//		$user = $oUSUARIO->read(null,$user['Usuario']['id']);
//		return $user;
	}
	
	function permisos(){
//		$user = $this->user();
// 		App::import('Model','Permiso');
// 		$oPERMISO = new Permiso();  
// 		$permisos = $oPERMISO->find('list',array('conditions'=>array('Permiso.grupo_id'=> $user['Usuario']['grupo_id']),'fields' => array('menu_id'), 'order' => 'menu_id'));
//		return $permisos;
	}
	
	function url($permiso_id){
// 		App::import('Model','Permiso');
// 		$oPERMISO = new Permiso();  
// 		$permiso = $oPERMISO->read(null,$permiso_id);
// 		return $permiso['Permiso']['url'];
	}
	
	
	function isHabilitado($path){
		$habilitado = false;
//		$permisos = $this->permisos();
//
//		foreach($permisos as $id => $permiso):
//			$url = $this->url($id);
//			if($path === $url){
//				$habilitado = true;
//				break;
//			}
//		endforeach;
		return $habilitado;
	}
	
	

}
?>