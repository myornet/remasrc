<?php

class GlobalAppController extends AppController{
    
    var $helpers = array('Global.Frm');
	
    function __construct(){
    	parent::__construct();
    }
    
	function beforeFilter(){  
		parent::beforeFilter();  
		
	}	
	    
}
?>
