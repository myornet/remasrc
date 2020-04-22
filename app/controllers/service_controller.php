<?php
/**
* 	adrian
*	28/09/2010
*
*/
class ServiceController extends AppController{
	
	public $name = 'Service';
	public $uses = array('RemasService');
	public $helpers = array();
	public $components = array('Soap');
	
	
	
	var $autorizar = array(
							'call',
							'wsdl',
							'xmlrpc'
	);
	
//	function beforeFilter(){
//		parent::beforeFilter();  
//	}	

	/**
	 * Handle SOAP calls
	 */
	function call($model){
		$this->autoRender = FALSE;
		$this->Soap->handle($model,'wsdl');
	}

	/**
	 * Provide WSDL for a model
	 */
	function wsdl($model){
		$this->autoRender = FALSE;
		header('Content-type: text/xml; charset=UTF-8');
		echo $this->Soap->getWSDL($model, 'call');
	}
	
	
	function test(){
//		$res = $this->RemasService->getPersonaByTdocNdoc("0DNI","25573046","3353a6cc0d95dd93e2c948ab1c35e4760a296084");
//		debug(json_decode($res));
//		
//		App::import('Model', 'Conexion');
//		$oCONEX = new Conexion();
//		debug($oCONEX->getConexionNameByPIN("3353a6cc0d95dd93e2c948ab1c35e4760a296084"));
		
		exit;
	}	
	
	
}



?>