<?php
class HomeController extends AppController{
	var $name = "Home";
	var $uses = null;
	
	function beforeFilter(){ 
		parent::beforeFilter();  
 	}	
	
	function index(){
		$this->redirect('/usuarios/logout');
	}
	
	function pruebas(){
		
	}
	
	
}
?>