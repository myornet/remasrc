<?php 

class Asincrono extends AppModel{
	
	var $name = 'Asincrono';
	
	
	function crear($datos){
		$datos['Asincrono']['propietario'] = (isset($_SESSION['NAME_USER_LOGON']) ? $_SESSION['NAME_USER_LOGON'] : 'SERVER_SHELL');
		$datos['Asincrono']['remote_ip'] = (isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '127.0.0.0');
		if($this->save($datos)):
			return $this->getLastInsertID();
		else:
			return 0;
		endif;
	}
	
	function delay($loop=10000){
		for($j=1;$j<$loop;$j++){}
		return;
	}
	
	function getParametro($paramIdx){
		$asinc = $this->read(null,$this->id);
		return $asinc['Asincrono'][$paramIdx];
	}	
	
	function setTotal($total){
		$asinc['Asincrono']['id'] = $this->id;
		$asinc['Asincrono']['total'] = $total;
		return parent::save($asinc);
	}
	
	function actualizar($value=0,$total=null,$msg=''){
		$asinc = array();
		$asinc['Asincrono']['id'] = $this->id;
		$asinc['Asincrono']['msg'] = $msg;
		$asinc['Asincrono']['contador'] = $value;
		$porcentaje = ($value / $total) * 100;
		if($porcentaje >= 100) $porcentaje = 99;
		$asinc['Asincrono']['porcentaje'] = (!empty($total) ?  $porcentaje : 0);
		return parent::save($asinc);
	}

	function stop($msg=null){
		$asinc = array();
		$asinc['Asincrono']['id'] = $this->id;
		$asinc['Asincrono']['msg'] = (!empty($msg) ? $msg : 'DETENIDO POR EL USUARIO');
		$asinc['Asincrono']['estado'] = "S";
		$asinc['Asincrono']['porcentaje'] += $asinc['Asincrono']['porcentaje'] + 1;
		return parent::save($asinc);
	}
	
	function fin($msg=null){
		$asinc = array();
		$asinc['Asincrono']['id'] = $this->id;
		$asinc['Asincrono']['porcentaje'] = 100;
		$asinc['Asincrono']['final'] = date('Y-m-d H:m:s');
		$asinc['Asincrono']['estado'] = 'F';
		$asinc['Asincrono']['msg'] = (!empty($msg) ? $msg : 'FINALIZADO');
		return parent::save($asinc);
	}
	
	function error($msg=null){
		$asinc['Asincrono']['id'] = $this->id;
		$asinc['Asincrono']['final'] = date('Y-m-d H:m:s');
		$asinc['Asincrono']['porcentaje'] += $asinc['Asincrono']['porcentaje'] + 1;
		$asinc['Asincrono']['estado'] = 'E';
		$asinc['Asincrono']['msg'] = (!empty($msg) ? $msg : 'ERROR EN PROCESO');
		return parent::save($asinc);
	}	
	
	function detenido(){
		$asinc = $this->read(null,$this->id);
		$estado = $asinc['Asincrono']['estado'];
		if($estado == 'S'){
			$this->stop();
			return true;
		}else{
			return false;
		}
	}
	
	function estado(){
		$asinc = $this->read(null,$this->id);
		return $asinc['Asincrono']['estado']; 
	}	
	
	
	
	function limpiarTablas(){
		App::import('Model','AsincronoTemporal');
		$oASINCTMP = new AsincronoTemporal();
		$oASINCTMP->deleteAll("1=1");
		$this->deleteAll("1=1");
	}	
	
	
}

?>