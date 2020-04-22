<?php 

App::import('Model', 'Persona');
App::import('Model', 'Conexion');

class RemasService extends AppModel{
	
	var $name = 'RemasService';
	var $useTable = false;
	var $error = null;
	var $conexionName = null;
		
	
	/**
	 * Busca una persona en base al tipo y numero de documento
	 * 0DNI = DNI
	 * 00LC = LC
	 * 00LE = LE
	 * @param string $tDoc
	 * @param string $nDoc
	 * @param string $PIN
	 * @return string
	 */
	function getPersonaByTdocNdoc($tDoc,$nDoc,$PIN){
		$response = array();
		if(!$this->validatePIN($PIN)){
			$response['client'] = $this->conexionName;
			$response['error'] = 1;
			$response['msg_error'] = $this->error;
			return json_encode($response);			
		}
		$response['client'] = $this->conexionName;
		$response['error'] = 0;
		$response['msg_error'] = "";
		$nTDoc = "PERSTDOC".$tDoc;
		$oPERSONA = new Persona();
		$personas = $oPERSONA->getPersonaByTdocNdoc($nTDoc,$nDoc);
		if(empty($personas)):
			$response['error'] = 1;
			$response['msg_error'] = "$tDoc $nDoc INEXISTENTE";
		endif;
		$response['find'] = count($personas);
		$response['result'] = array();
		foreach($personas as $i => $persona):
			$response['result'][$i] = $this->setDatosPersona($persona);
		endforeach;
		return json_encode($response);
	}
	
	/**
	 * 
	 * @param integer $identifier
	 * @param string $PIN
	 * @return string
	 */
	function getFichaPersonaById($id,$PIN){
		$response = array();
		if(!$this->validatePIN($PIN)){
			$response['client'] = $this->conexionName;
			$response['error'] = 1;
			$response['msg_error'] = $this->error;
			return json_encode($response);			
		}
		$response['client'] = $this->conexionName;
		$response['error'] = 0;
		$response['msg_error'] = "";
		$oPERSONA = new Persona();
		$persona = $oPERSONA->getPersona($id);
		$response['find'] = 1;
		$response['result'] = $this->setDatosPersona($persona,true);
		return json_encode($response);
		
	}
	
	/**
	 * Valida el PIN
	 * @param unknown_type $PIN
	 */
	private function validatePIN($PIN){
		$oCONEX = new Conexion();
		if(!$oCONEX->validatePIN($PIN)){
			$this->error = "PIN DE ACCESO INCORRECTO";
			return false;
		}else{
			$conn = $oCONEX->getConexionNameByPIN($PIN);
			$this->conexionName = $conn['municipalidad'];
			if($conn['activo'] == 1){
				return true;
			}else{
				$this->error = "EL ACCESO AL SERVICIO NO ESTA ACTIVO PARA ESTE CLIENTE";
				return false;
			}
		}
	}
	
	
	private function setDatosPersona($persona,$cargarConsumos=false){
		$datos = array();
		$datos['id'] = $persona['Persona']['id'];
		$datos['tipo_documento'] = $persona['Persona']['tdoc'];
		$datos['documento'] = $persona['Persona']['documento'];
		$datos['cuit_cuil'] = $persona['Persona']['cuit_cuil'];
		$datos['fecha_nacimiento'] = (!empty($persona['Persona']['fecha_nacimiento']) ? date('d-m-Y',strtotime($persona['Persona']['fecha_nacimiento'])) : "");
		$datos['apenom'] = $persona['Persona']['apenom'];
		$datos['domicilio'] = $persona['Persona']['domicilio'];
		$datos['barrio'] = $persona['Persona']['barrio_d'];
		$datos['telefono_fijo'] = $persona['Persona']['telefono_fijo'];
		$datos['telefono_movil'] = $persona['Persona']['telefono_movil'];
		$datos['telefono_mensajes'] = $persona['Persona']['telefono_mensajes'];
		$datos['email'] = $persona['Persona']['email'];
		$datos['ocupacion_oficio'] = $persona['Persona']['tipo_ocupacion_oficio_d'];
		$datos['ocupacion_oficio_actual'] = $persona['Persona']['tipo_ocupacion_oficio_actual_d'];
		$datos['cobertura_medica'] = $persona['Persona']['tipo_cobertura_medica_d'];
		$datos['nivel_instruccion'] = $persona['Persona']['tipo_nivel_instruccion_d'];
		$datos['discapacidad'] = $persona['Persona']['tipo_discapacidad_d'];
		$datos['vivienda'] = $persona['Persona']['tipo_vivienda_d'];
		$datos['condicion_vivienda'] = $persona['Persona']['tipo_condicion_vivienda_d'];
		$datos['vivienda_electricidad'] = $persona['Persona']['tipo_electricidad_d'];
		$datos['vivienda_servicio_agua'] = $persona['Persona']['tipo_agua_d'];
		$datos['vivienda_banio'] = $persona['Persona']['tipo_banio_d'];
		$datos['vivienda_techo'] = $persona['Persona']['tipo_techo_d'];
		$datos['vivienda_piso'] = $persona['Persona']['tipo_piso_d'];
		$datos['beneficio_nro'] = $persona['Persona']['nro_beneficio'];
		$datos['beneficio_condicion'] = $persona['Persona']['nro_beneficio_condicion'];
		
		if($cargarConsumos):
			App::import('Model','BeneficiarioBeneficioDetalle');
			$oRENGLON = new BeneficiarioBeneficioDetalle();
			$datos['dias_corte_registro_consumos'] = 60;
			$mkTime = 60 * 60 * 24 * $datos['dias_corte_registro_consumos'];
			$mkTimeDay = mktime(0,0,0,date('m'),date('d'),date('Y'));
			$datos['fecha_corte_registro_consumos'] = date('d-m-Y',$mkTimeDay - $mkTime);
			$datos['registro_consumos'] = array();
			$consumos = $oRENGLON->getRenglonesByPersonaIdSorted($persona['Persona']['id'],$datos['fecha_corte_registro_consumos']);
			if(!empty($consumos)):
				foreach($consumos as $id => $consumo):
					$datos['registro_consumos'][$id]['beneficio_nro'] = $consumo['orden_beneficio_id'];
					$datos['registro_consumos'][$id]['titular'] = $consumo['orden_titular_str'];
					$datos['registro_consumos'][$id]['orden_nro'] = $consumo['orden_nro_str'];
					$datos['registro_consumos'][$id]['fecha'] = $consumo['orden_fecha_str'];
					$datos['registro_consumos'][$id]['permanente'] = $consumo['permanente'];
					$datos['registro_consumos'][$id]['vigente_hasta'] = (!empty($consumo['fecha_hasta']) ? date('d-m-Y',strtotime($consumo['fecha_hasta'])) : "");
					$datos['registro_consumos'][$id]['vencido'] = $consumo['vencido'];
					$datos['registro_consumos'][$id]['producto'] = $consumo['producto_str'];
					$datos['registro_consumos'][$id]['cantidad'] = $consumo['cantidad'];
					$datos['registro_consumos'][$id]['importe'] = $consumo['importe'];
				endforeach;
			endif;
		endif;
		return $datos;
	}
	
	
}

?>