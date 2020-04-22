<?php

uses('L10n');

@ob_start ('ob_gzhandler'); 
header('Content-type: text/html; charset: UTF-8'); 
header('Cache-Control: must-revalidate'); 
$offset = -1; 
$ExpStr = "Expires: " .gmdate('D, d M Y H:i:s',time() + $offset) . ' GMT'; 
header($ExpStr);

/**
 * 
 * @author ADRIAN TORRES
 *
 */


define("LOCALIDAD","RIO CEBALLOS");
define("CP","5111");
define("PROVINCIA","CORDOBA");


class AppController extends Controller{
	
	var $components = array('Seguridad','RequestHandler','Mensaje','Util','Mysql','Zip','Upload');
	var $helpers = array('Frm','CssMenu','Controles');
	var $perfil = 7; //publico (perfilusuario 1,2,3)
	var $metodosPublicos = array();
	
	
	function __construct(){
 		$this->layout = "remas";

 		
 		
 		Configure::write('APLICACION',
 							array(
 								'app_nombre'=>'REMAS - Registro Municipal de Autogestión Social',
 								'app_soft'=>'REMAS',
 								'app_version'=>'v1.0',
 								'logo_grande' => 'logos/hacerciudad1.jpg',
 								'logo_chico'=>'logos/hacerciudad1.jpg',
 								'logo_pdf' => 'logos/hacerciudad1.jpg',	
 								'nombre_fantasia' => 'DIRECCION DE PROMOCION HUMANA',
 								'domi_fiscal' => 'PASAJE ANDRES SERRANO 85 - RIO CEBALLOS - CP 5111 - CORDOBA',
 								'telefonos' => '(03543) 458051 / FAX 458052',
 								'email' => 'promhumana@yahoo.com.ar'
 							)
 						); 		
 		
 		
 		parent::__construct();		
	}
	
	/**
	 * (non-PHPdoc)
	 * @see cake/libs/controller/Controller#beforeFilter()
	 */
	function beforeFilter(){
		Configure::write('Config.language', 'spa');
		if($this->action != 'login' && $this->action != 'verify' && $this->name != 'Service'):
			if(!$this->checkUserLogon()):
				$this->redirect('/usuarios/login');
			else:
				$user = $this->getUserLogon();
				if(!$this->getControlNivelAcceso($user['Usuario']['perfil'])){
					$this->noAutorizado();
				}
				$this->set('user',$user);
				
			endif;
		endif;
		parent::beforeFilter();
	}
	
	
	/** 
	* beforeRender 
	*  
	* Application hook which runs after each action but, before the view file is  
	* rendered 
	*  
	* @access public  
	*/  
	function beforeRender(){
		parent::beforeRender();
	} 		
	
	/**
	 * Control Nivel de Acesso
	 * Por defecto puede acceder a todo, aca voy seteando que cosas puede hacer
	 * Nivel 1 = consulta padron
	 * NIvel 2 = consulta padron + emitir ordenes
	 * Nivel 3 = Todo
	 * @param unknown_type $usuarioPerfil
	 */
	function getControlNivelAcceso($usuarioPerfil){
		$URLS = array(
				'usuarios/index' => array(3),
				'usuarios/add' => array(3),
				'usuarios/edit' => array(3),
				'usuarios/del' => array(3),
				'usuarios/reset_pws' => array(3),
				'usuarios/set' => array(3),	 
				'centros/index' => array(3),
				'centros/add' => array(3),
				'centros/edit' => array(3),
				'centros/del' => array(3),
				'backups/index' => array(3),
				'conexiones/index' => array(3),
				'conexiones/add' => array(3),
				'conexiones/edit' => array(3),
				'conexiones/del' => array(3),
				'conexiones/reset_pin_local' => array(3),
				'global_datos/index' => array(3),
				'global_datos/add' => array(3),
				'global_datos/edit' => array(3),
				'global_datos/del' => array(3),
				'global_datos/view' => array(3),
				'personas/alta_titular' => array(2,3),
				'beneficiario_beneficios/cargar_consumo' => array(2,3),
				'beneficiario_adicionales/alta_adicional' => array(3),
				'beneficiario_adicionales/administrar' => array(3),
				'beneficiario_adicionales/modificar_datos_adicional' => array(3),
				'beneficiario_adicionales/borrar_adicional' => array(3),
				'beneficiario_beneficios/reasignar_consumos' => array(3),
				'beneficiario_beneficios/borrar_consumo' => array(3),
				'beneficiarios/modificar_estado' => array(3),
				'beneficiarios/unificar' => array(3),
				'beneficiarios/nueva_novedad' => array(2,3),
				'beneficiarios/borrar_novedad' => array(3),
				'beneficiarios/ficha' => array(3),
				'reportes/consulta_general_prodserv' => array(3),
				'reportes/padron_beneficiarios' => array(3),
				'beneficiarios/modificar_datos_titular' => array(3),
		);

		if(!in_array($this->params['controller']."/".$this->params['action'],$URLS))return true;

		$control = $URLS[$this->params['controller']."/".$this->params['action']];

		if(in_array($usuarioPerfil,$control))return true;
		else return false;
	}
	
	/**
	 * Valida si el usuario actual tiene perfil 3
	 */
	function isAdministrador(){
		$user = $this->getUserLogon();
		if($user['Usuario']['perfil'] == 3) return true;
		else return false;
	}
	
	function getHashKey(){
		if(!$this->Session->check('Secure.hashKey')):
	     	$CAKE_SESSION_STRING =  Configure::read('Security.salt');
	     	$hashKey = sha1($CAKE_SESSION_STRING.mt_rand());
	        $this->Session->write('Secure.hashKey',$hashKey);
	        return $hashKey;
		else:
			return $this->Session->read('Secure.hashKey');
        endif;		
	}
	
	
	function setUserLogon($user){
		$this->Session->write('USER_LOGON',$user);
	}
	
	function getUserLogon(){
		return $this->Session->read('USER_LOGON');
	}
	
	function checkUserLogon(){
		return $this->Session->check('USER_LOGON');
	}
	
	function unSetUserLogon(){
		$this->Session->delete('USER_LOGON');
	}	
	
	/**
	 * despues de filtar el controlador y la accion 
	 * genero la auditoria
	 * @return unknown_type
	 */
	function afterFilter(){
		parent::afterFilter();
	}
	

	
	function noAutorizado(){
		$this->redirect('/usuarios/no_autorizado');
	}	
	
}
?>
