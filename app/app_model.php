<?php
/**
 * 
 * @author ADRIAN TORRES
 *
 */
class AppModel extends Model{
	
	var $auditable = true;
	
	/**
	 * (non-PHPdoc)
	 * @see cake/libs/model/Model#beforeSave($options)
	 */
	function beforeSave(){
		$user = $this->getUserLogon();
		foreach($this->_schema as $field => $schema){
			if($schema['type'] == 'date'){
				if(!empty($this->data[$this->name][$field]))$fecha = date('Y-m-d',strtotime($this->data[$this->name][$field]));
				else $fecha = null;
				$this->data[$this->name][$field] = $fecha;
			}
			if($schema['type'] == 'text'){
				App::import('Sanitize');
				if(isset($this->data[$this->name][$field]))$this->data[$this->name][$field] =  Sanitize::html($this->data[$this->name][$field],true);
			}
			if($schema['type'] == 'string'){
				App::import('Sanitize');
				if(isset($this->data[$this->name][$field]))$this->data[$this->name][$field] =  Sanitize::html($this->data[$this->name][$field],true);
			}
		}		
		
		if(array_key_exists('user_created',$this->_schema) && empty($this->data[$this->name]['id'])){
			if(!empty($user))$this->data[$this->name]['user_created'] = $user['Usuario']['usuario'];
		}
		if(array_key_exists('user_modified',$this->_schema) && !empty($this->data[$this->name]['id']) ){
			if(!empty($user))$this->data[$this->name]['user_modified'] = $user['Usuario']['usuario'];
		}
		
		if(array_key_exists('alta_centro_id',$this->_schema) && empty($this->data[$this->name]['id']) ){
			
			if(!empty($user))$this->data[$this->name]['alta_centro_id'] = $user['Usuario']['centro_id'];
		}
		if($this->auditable)$this->auditar();		
		return parent::beforeSave();
	}
	
	
	function beforeDelete(){
		if($this->auditable)$this->auditar();
		return parent::beforeDelete();
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param $data
	 */
	function armaFechaForm($data){
		return $data['year'].'-'.$data['month'] .'-'. $data['day'];
	}	
	
	
	/**
	 * 
	 * Enter description here ...
	 * @param $fecha1
	 * @param $fecha2
	 */
	function dias($fecha1,$fecha2){
		$mkt1 = mktime(0,0,0,date('m',strtotime($fecha1)),date('d',strtotime($fecha1)),date('Y',strtotime($fecha1)));
		$mkt2 = mktime(0,0,0,date('m',strtotime($fecha2)),date('d',strtotime($fecha2)),date('Y',strtotime($fecha2)));
		$sDiff = $mkt1 - $mkt2;
		$dDiff = floor($sDiff / (60 * 60 * 24));
		return $dDiff;
	}
	
	
	/**
	 * Devuelve un dato global o un registro de la global
	 * de acuerdo al parametro pasado como $field
	 * @param $id
	 * @param $field
	 * @return unknown_type
	 */
	function getGlobalDato($id,$field='concepto_1'){
		App::import('Model', 'Global.GlobalDato');
		$oGLB = new GlobalDato(null);
		$dato = $oGLB->read($field,$id);	
		return (!empty($field) ? utf8_encode($dato['GlobalDato'][$field]) : $dato);
	}
	
	
	/**
	 * 
	 * Enter description here ...
	 * @param $prefix
	 */
	function getGlobalDatos($prefix=null){
		App::import('Model', 'Global.GlobalDato');
		$oGLB = new GlobalDato(null);
		return $oGLB->find('all',array('conditions' => array('GlobalDato.id LIKE ' => $prefix . '%', 'GlobalDato.id <> ' => $prefix),'order' => array('GlobalDato.concepto_1')));		
	}
	

	/**
	 * 
	 * Enter description here ...
	 */
	function getUserLogon(){
		$user = (isset($_SESSION['USER_LOGON']) ? $_SESSION['USER_LOGON'] : NULL);
		return $user;
	}
	
	/**
	 * 
	 * Enter description here ...
	 * @param $id
	 * @param $field
	 */
	function getCentro($id,$field=null){
    	App::import('Model','Centro');
    	$oCENTRO = new Centro();
    	$centro = $oCENTRO->read($field,$id);
    	return (!empty($field) ? $centro['Centro'][$field] : $centro['Centro']);
		
	}
	
	
	function auditar(){
		$backTrace = debug_backtrace();
		$audita = array();
//		$audita['file'] = $backTrace[2]['file'];
		$audita['line'] = $backTrace[2]['line'];
		$audita['function'] = $backTrace[2]['function'];
		$audita['object'] = $backTrace[2]['object']->name;
		$audita['data'] = $backTrace[2]['object']->data;
		$encode = json_encode($audita);
		if(isset($_SESSION['USER_LOGON']) && isset($_SERVER['REMOTE_ADDR'])){
			if(!empty($_SESSION['USER_LOGON'])){
				$user = $_SESSION['USER_LOGON'];
				$user = up($user['Usuario']['usuario']);
			}else{
				$user = "REMASAPP";
			}
			$message = $user.'|'.date('d-m-y H:i:s').'|'.$_SERVER['REMOTE_ADDR'].'|'.$encode;
		}else{
			$user = "REMASAPP";
			$message = $user.'|'.date('d-m-y H:i:s').'|0.0.0.0|'.$encode;
		}
		if (!class_exists('File')) {
			require LIBS . 'file.php';
		}
		$fileLogName = WWW_ROOT . DS . "logs" . DS . "auditoria" . DS . $user ."_".date("Ymd").".log";
		$log = new File($fileLogName, true);
		$message .= "\r\n"; 
		$log->append($message);		
	}
	
	
	/**
	 * rellena un valor con un caracter a la izquierda o derecha
	 * @param $valor
	 * @param $cantidad
	 * @param $string
	 * @param $orientacion
	 * @return string
	 */
	function fill($valor,$longitud,$relleno="0",$orientacion='L'){
		if($orientacion=='L')return str_pad($valor,$longitud,$relleno,STR_PAD_LEFT);
		else if($orientacion=='R')return str_pad($valor,$longitud,$relleno,STR_PAD_RIGHT);
		else return $valor;
	}	
	
}
?>