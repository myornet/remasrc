<?php 

class Conexion extends AppModel{
	
	var $name = 'Conexion';
	var $service = "service/wsdl/remas";

    var $validate = array(
						'municipalidad' => array( 
    										'municipalidad_R1' => array('rule' => VALID_NOT_EMPTY,'message' => 'Requerido','last' => true),
    										'municipalidad_R2' => array('rule' => 'isUnique','message' => 'Ya existe una conexion para ese Municipio',),
    									),
						'app_remas_remoto' => array( 
    										'web_service_R1' => array('rule' => VALID_NOT_EMPTY,'message' => 'Requerido','last' => true),
    										'web_service_R2' => array('rule' => 'validateURL','message' => 'La URL es incorrecta (http://xxx.xxx.xxx.xxx./remasXX) o esta fuera de Servicio',),
    									)
    									
    					);	
	
	function save($datos){
		if(empty($datos['Conexion']['id']))$datos['Conexion']['pin_local'] = $this->generatePIN();
		return parent::save($datos);
	}
	
	
	function validateURL($value){
		return $this->checkConexion($value['app_remas_remoto']);
	}
	
	/**
	 * Regenera el PIN de acceso local
	 * @param unknown_type $id
	 */
	function regenerarPIN($id){
		$conexion = $this->getConexionByID($id);
		if(empty($conexion)) return false;
		$conexion['Conexion']['pin_local'] = $this->generatePIN();
		if(!parent::save($conexion)) return false;
		return $conexion['Conexion']['pin_local'];
	}
	

	/**
	 * Genera un PIN aleatorio de longitud pasada por parametro
	 * @param $len
	 */
	function generatePIN($len = 15){
		$key = substr( str_shuffle( 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789' ) , 0 , $len );
    	return $key;		
	}
	
	/**
	 * Valida que el pin exista para alguna conexion
	 * @param $pin
	 */
	function validatePIN($pin){
		$conn = $this->find('count',array('conditions' => array('Conexion.pin_local' => $pin)));
		if(!empty($conn)) return true;
		else return false;
	}
	
	/**
	 * Devuelve una conexion en base a un PIN
	 * @param $pin
	 */
	function getConexionNameByPIN($pin){
		$conn = $this->find('all',array('conditions' => array('Conexion.pin_local' => $pin)));
		return (!empty($conn) ? $conn[0]['Conexion'] : null);
	}
	
	/**
	 * Devuelve las conexiones activas
	 */
	function getActivas(){
		return $this->find('all',array('conditions' => array('Conexion.activo' => 1),'order' => array('Conexion.municipalidad')));
	}

	/**
	 * Devuelve una conexion en base al ID
	 * @param unknown_type $id
	 */
	function getConexionByID($id){
		return $this->read(null,$id);
	}


	/**
	 * SOAP Invoca a un metodo remoto
	 * @param $idConn
	 * @param $metodoRemoto
	 * @param $argumentos
	 * @return object Instancia del objeto remoto
	 */
	function getRemoteObject($idConn,$metodoRemoto,$argumentos=array()){
		$conexion = $this->getConexionByID($idConn);
		if($this->checkConexion($conexion['Conexion']['app_remas_remoto'])):
			$params = array_values($argumentos);
			array_push($params,$conexion['Conexion']['pin_remoto']);
			$client = new SoapClient($conexion['Conexion']['app_remas_remoto']. "/" .$this->service);
			$SOAP = call_user_func_array(array(&$client, $metodoRemoto), $params);
			$SOAP = json_decode($SOAP);
			if($SOAP->error == 1 && empty($SOAP->client)):
				$SOAP->client = $conexion['Conexion']['municipalidad'];
			endif;
		else:
    		$SOAP = new stdClass();
    		$SOAP->client = $conexion['Conexion']['municipalidad'];
    		$SOAP->error = 1;
    		$SOAP->msg_error = "*** SIN CONEXION ***";
		endif;
		return $SOAP;
	}
	
	/**
	 * Verifica el estado de una conexion
	 * @param unknown_type $url
	 * @return boolean TRUE = CONECTADO | FALSE = ERROR DE CONEXION
	 */
	function checkConexion($url){
		if(empty($url)) return false;
		$parseURL = explode("/",$url);
		$HOSTNAME = explode(":",$parseURL[2]);
		$HOST = $HOSTNAME[0];
		$PORT = (!empty($HOSTNAME[1]) ? $HOSTNAME[1] : "8080");
		if(empty($HOST)) return false;
		$timeout = 30;
		$attempts = 0;
		$timeout *= 10;
		$connected = false;
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
		if ($socket === false) return false;
		socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array("sec" => 5, "usec" => 0));
		while (!($connected = @socket_connect($socket, $HOST, $PORT)) && $attempts++ > $timeout){
			$error = socket_last_error(); 
			if ($error != SOCKET_EINPROGRESS && $error != SOCKET_EALREADY) {
				socket_close($socket);
				return false;
			}
			usleep(5); 
		}
		socket_close($socket);		
		return $connected;
	}	
	
	
}

?>