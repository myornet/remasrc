<?php

/**
 * 
 * @author ADRIAN TORRES
 *
 */
class UsuariosController extends AppController{
	
	var $name = "Usuarios";
	
	function beforeFilter(){ 
		parent::beforeFilter();  
 	}	
	
 	function index(){
 		$this->perfil = 4;
		$condiciones = array('Usuario.usuario <>' => "ADMIN");
		$this->paginate = array('limit' => 30,'order' => array('Usuario.usuario' => 'ASC'));
		$this->set('usuarios', $this->paginate(null,$condiciones));	
		$this->set('perfiles', $this->Usuario->perfiles); 		
 	}
 	
	/**
	 * 
	 * @return unknown_type
	 */
	function login(){
		$this->layout = "remas_login";
		$this->set('hashKey',parent::getHashKey());
		$this->render('login_ajax');
	}
	
	/**
	 * 
	 * @return unknown_type
	 */
	function logout(){
		$this->Session->destroy();  
//		$this->redirect($this->Seguridad->logout()); 
		$this->redirect('login'); 
	}
	
	function verify(){
		parent::unSetUserLogon();
		$render = "login_ajax";
		$ajax = false;
		$error = null;
		if(!$this->RequestHandler->isAjax()) $this->redirect('login');
		if(!isset($this->params['url']['h'])) $this->redirect('login');
		$hashKey = $this->params['url']['h'];
		$this->layout = 'adminLogin';
		if($hashKey != parent::getHashKey()){
			$this->set('hashKey',parent::getHashKey());	
			$error = null;
			$render = 'login_ajax_failure';
			$ajax = true;		
		}else if (!empty($this->data) && $this->RequestHandler->isAjax()){
			$this->set('hashKey',parent::getHashKey());
			$conditions = array();
			$conditions['Usuario.usuario'] = $this->data['Usuario']['usuario'];
			$conditions['Usuario.password'] = Security::hash($this->data['Usuario']['password'], null, true);
			$usuario = $this->Usuario->find('all',array('conditions' => $conditions));
			if(!empty($usuario)):
				$usuario = $usuario[0];
				if(isset($usuario['Usuario']['activo']) && $usuario['Usuario']['activo'] == 0):
					$error = "La cuenta del Usuario " . $usuario['Usuario']['nombre'] . " NO ESTA ACTIVA.";
					$render = 'login_ajax_failure';
					$ajax = true;
				else:
					parent::setUserLogon($usuario);
					$render = 'login_ajax_sucess';
					$ajax = true;					
				endif;
			else:
				$error = "Usuario o Contraseña Incorrecto";
				$render = 'login_ajax_failure';
				$ajax = true;
			endif;
		}
		$this->set('error',$error);
		$this->render($render,($ajax ? 'ajax' : 'adminLogin'));
	}	
	
	
	function ingreso($hashKey = null){
		$this->layout = 'remas_login';
		if($hashKey != parent::getHashKey()) $this->redirect('login');
		else $this->redirect('/personas');
	}	
	
	
	function password(){
		
		$user = parent::getUserLogon();
//		$user = $this->Usuario->read(null,$user['Usuario']['id']);
		
		if(!empty($this->data)):
			$pws = $user['Usuario']['password'];
			$pwsActual = Security::hash($this->data['Usuario']['old_password'], null, true);
			if($pws == $pwsActual):
				$pwsNew = Security::hash($this->data['Usuario']['new_password'], null, true);
				$pwsNewConf = Security::hash($this->data['Usuario']['new_password_confirm'], null, true);
				if($pwsNew == $pwsNewConf):
					$this->Usuario->id = $user['Usuario']['id'];
					$this->Usuario->saveField("password",$pwsNew);
					$this->Mensaje->ok("Contraseña cambiada correctamente!. Deberá salir del sistema e ingresar de nuevo con la nueva contraseña.");
				else:
					$this->Mensaje->error("Verifique la nueva contraseña!");	
					$this->Usuario->invalidate('new_password',false);
				endif;
			else:
				$this->Usuario->invalidate('old_password',false);
				$this->Mensaje->error("La contraseña actual no es correcta!");					
			endif;
		endif;
		
		$this->set('user',$user);
		
	}
	
	function reset_pws($id=null){
		$this->perfil = 4;
		if(empty($id)) parent::noAutorizado();
		$this->Usuario->id = $id;
		$this->Usuario->resetPassword();
		$this->Mensaje->ok('La clave fue reseteada correctamente!');
		$this->redirect(array('action'=>'index'));				
	}	
	
	function del($id = null) {
		$this->perfil = 4;
		if(empty($id)) parent::noAutorizado();
		if ($this->Usuario->del($id))$this->Mensaje->okBorrar();
		else $this->Mensaje->errorBorrar();
		$this->redirect(array('action'=>'index'));		
	}

	function edit($id = null){
		$this->perfil = 4;
		if(empty($id)) parent::noAutorizado();
		$this->Usuario->recursive = 0;
		$user = $this->Usuario->read(null,$id);
		$this->set('user',$user);
		
		if (!empty($this->data)) {
			if ($this->Usuario->save($this->data)){
//				$this->Usuario->resetPassword($this->data['Usuario']['id']);
				$this->Mensaje->okGuardar();
				$this->redirect(array('action'=>'index'));				
			}else{
				$this->Mensaje->errorGuardar();
			}
		}		
		$this->set('grupos',$this->requestAction('/grupos/getList'));
		$this->set('centros',$this->requestAction('/centros/getList'));
		$this->set('perfiles', $this->Usuario->perfiles);
		$this->data = $user;
	}
	

	function add(){
		$this->perfil = 4;
		if (!empty($this->data)) {
			if ($this->Usuario->save($this->data)){
				$this->Usuario->resetPassword($this->Usuario->getLastInsertID());
				$this->Mensaje->okGuardar();
				$this->redirect(array('action'=>'index'));				
			}else{
				$this->Mensaje->errorGuardar();
			}
		}		
		$this->set('grupos',$this->requestAction('/grupos/getList'));
		$this->set('centros',$this->requestAction('/centros/getList'));
		$this->set('perfiles', $this->Usuario->perfiles);
	}
	
	
	function setActivoOnOff($field,$id,$option){
		if(!parent::isAdministrador()){
			echo ($option == 1 ? 0 : 1);
			exit;			
		}
		Configure::write('debug',0);
		$usuario = $this->Usuario->read(null, $id);
		$usuario['Usuario'][$field] = $option;
		$this->Usuario->save($usuario);
		echo $option;
		exit;
	}
	
	
	function no_autorizado(){Configure::write('debug',0);}
	function no_disponible(){Configure::write('debug',0);}	
	

}