<?php 

/**
 *
 * CONSULTA GENERAL DE PRODUCTOS Y SERVICIOS
 * 
 * @author adrian
 *
 *	/usr/bin/php5 /home/adrian/dev/www/remas/cake/console/cake.php consulta_general_prodserv 53 -app /home/adrian/dev/www/remas/app/
 *
 */

class ConsultaGeneralProdservShell extends Shell{

	var $uses = array('BeneficiarioBeneficioDetalle','Beneficiario');
	
	function main(){
		
		App::import('Model','Asincrono');
		$oASINC = new Asincrono();
		$oASINC->id = $this->args[0];

		App::import('Model','AsincronoTemporal');
		$oTMP = new AsincronoTemporal();		

		$oTMP->limpiar($oASINC->id);
		
		$producto_servicio = $oASINC->getParametro('p1');
		$fecha_desde = $oASINC->getParametro('p2');
		$fecha_hasta = $oASINC->getParametro('p3');
		$codigo_barrio = $oASINC->getParametro('p4');
		$centro_id = $oASINC->getParametro('p6');

		$oASINC->actualizar(1,100,"ESPERE, INICIANDO PROCESO...");		
		
		$conditions = array();
		if(!empty($producto_servicio))$conditions['BeneficiarioBeneficioDetalle.codigo_producto'] = $producto_servicio;
		$conditions['BeneficiarioBeneficio.fecha >='] = $fecha_desde;
		$conditions['BeneficiarioBeneficio.fecha <='] = $fecha_hasta;
		if(!empty($codigo_barrio))$conditions['Persona.barrio'] = $codigo_barrio;
		if(!empty($centro_id))$conditions['BeneficiarioBeneficio.alta_centro_id'] = $centro_id;
		
		$datos = $this->BeneficiarioBeneficioDetalle->find('all',array('conditions' => $conditions,'order' => array('Persona.apellido,Persona.nombre')));
		
		if(empty($datos)):
			$oASINC->actualizar(100,100,"NO EXISTEN DATOS PARA PROCESAR");
			$oASINC->fin();		
			return;
		endif;
		
		$temp = array();
		$total = count($datos);
		$oASINC->setTotal($total);
		$i = 0;		
		
		foreach($datos as $dato):
		
//			debug($dato);
			
			$titular = $this->Beneficiario->getBeneficiario($dato['BeneficiarioBeneficio']['beneficiario_id']);
			
//			debug($titular['Persona']);
		
			$MSG = "PROCESANDO :: " .$dato['Persona']['apellido'].", ".$dato['Persona']['nombre']; 
			
			$oASINC->actualizar($i,$total,$MSG);
			
			$temp['AsincronoTemporal'] = array(
				'id' => 0,
				'asincrono_id' => $oASINC->id,
				'clave_1' => 'REPORTE_1',
				'texto_1' => $dato['BeneficiarioBeneficioDetalle']['codigo_producto'],
				'texto_2' => $dato['Persona']['barrio'],
				'texto_3' => $oASINC->getGlobalDato($dato['Persona']['tipo_documento']) . " - " . $dato['Persona']['documento'],
				'texto_4' => $dato['Persona']['apellido'].", ".$dato['Persona']['nombre'],
				'texto_5' => $dato['Persona']['calle'] . " " . $dato['Persona']['numero'],
				'texto_6' => $oASINC->getGlobalDato($dato['Persona']['barrio']),
				'texto_7' => $oASINC->getGlobalDato($dato['BeneficiarioBeneficioDetalle']['codigo_producto']),
				'texto_8' => ($dato['BeneficiarioBeneficioDetalle']['permanente'] == 1 ? 'SI' : 'NO'),
				'texto_9' => $dato['BeneficiarioBeneficio']['user_created'],
				'texto_10' => $oASINC->getCentro($dato['BeneficiarioBeneficio']['alta_centro_id'],'descripcion'),
				'texto_13' => $titular['Persona']['tdocndoc'],
				'texto_14' => $titular['Persona']['apenom'],
				'texto_15' => $titular['Persona']['telefono_fijo'],
				'texto_16' => $titular['Persona']['telefono_movil'],
				'texto_17' => $titular['Persona']['telefono_mensajes'],
				'texto_18' => $titular['Persona']['email'],
				'texto_19' => $titular['Beneficiario']['id'],
				'entero_1' => $dato['BeneficiarioBeneficio']['id'],
				'entero_2' => $dato['BeneficiarioBeneficioDetalle']['cantidad'],
				'decimal_1' => $dato['BeneficiarioBeneficioDetalle']['importe'],
				'texto_11' => date('d-m-Y',strtotime($dato['BeneficiarioBeneficio']['fecha'])),
				'texto_12' => (!empty($dato['BeneficiarioBeneficioDetalle']['fecha_hasta']) ? date('d-m-Y',strtotime($dato['BeneficiarioBeneficioDetalle']['fecha_hasta'])) : null),
			);
			
			$oTMP->save($temp);
			
//			$this->out(" $i / $total * ".$MSG);
			
			$i++;
		
		endforeach;
		
		//ARMO LOS RESUMENES
		$oASINC->actualizar(10,100,"GENERANDO RESUMEN DE DATOS");
		
		$oASINC->delay();
		
		//CARGO RESUMEN SEGUN BARRIO
		$sql = "SELECT texto_6,texto_7,COUNT(1) as cantidad ,SUM(entero_2) AS entero_2, SUM(decimal_1) AS decimal_1 FROM asincrono_temporales as AsincronoTemporal 
				WHERE asincrono_id = ".$oASINC->id." and clave_1 = 'REPORTE_1'
				GROUP BY texto_6,texto_7
				ORDER BY texto_6,texto_7";
		$datos = $oTMP->query($sql);
		$total = count($datos);
		$oASINC->setTotal($total);
		$i = 0;			
		if(!empty($datos)):
			$resumen = array();
			foreach($datos as $i => $dato):
				$MSG = "RESUMIENDO POR BARRIO :: " .$dato['AsincronoTemporal']['texto_6']." - ".$dato['AsincronoTemporal']['texto_7']; 
				$oASINC->actualizar($i,$total,$MSG);			
				$dato['AsincronoTemporal']['id'] = 0;
				$dato['AsincronoTemporal']['asincrono_id'] =  $oASINC->id;
				$dato['AsincronoTemporal']['clave_1'] =  'REPORTE_2';
				$dato['AsincronoTemporal']['entero_1'] = $dato[0]['cantidad'];
				$dato['AsincronoTemporal']['entero_2'] = $dato[0]['entero_2'];
				$dato['AsincronoTemporal']['decimal_1'] = $dato[0]['decimal_1'];
//				debug($dato);
				$oTMP->save($dato);
			endforeach;
		endif;
		//RESUMEN POR PRODUCTO
		$sql = "SELECT texto_7,texto_6,COUNT(1) as cantidad,SUM(entero_2) AS entero_2, SUM(decimal_1) AS decimal_1 FROM asincrono_temporales as AsincronoTemporal 
				WHERE asincrono_id = ".$oASINC->id." and clave_1 = 'REPORTE_1'
				GROUP BY texto_7,texto_6
				ORDER BY texto_7,texto_6";
		$datos = $oTMP->query($sql);
		$total = count($datos);
		$oASINC->setTotal($total);
		$i = 0;			
		if(!empty($datos)):
			$resumen = array();
			foreach($datos as $i => $dato):
				$MSG = "RESUMIENDO POR PRODUCTO :: " .$dato['AsincronoTemporal']['texto_7']." - ".$dato['AsincronoTemporal']['texto_6']; 
				$oASINC->actualizar($i,$total,$MSG);			
				$dato['AsincronoTemporal']['id'] = 0;
				$dato['AsincronoTemporal']['asincrono_id'] =  $oASINC->id;
				$dato['AsincronoTemporal']['clave_1'] =  'REPORTE_3';
				$dato['AsincronoTemporal']['entero_1'] = $dato[0]['cantidad'];
				$dato['AsincronoTemporal']['entero_2'] = $dato[0]['entero_2'];
				$dato['AsincronoTemporal']['decimal_1'] = $dato[0]['decimal_1'];				
				$oTMP->save($dato);
			endforeach;
		endif;	

		//RESUMEN POR CENTRO
		$sql = "SELECT texto_10,texto_7,COUNT(1) as cantidad,SUM(entero_2) AS entero_2, SUM(decimal_1) AS decimal_1 FROM asincrono_temporales as AsincronoTemporal 
				WHERE asincrono_id = ".$oASINC->id." and clave_1 = 'REPORTE_1'
				GROUP BY texto_10,texto_7
				ORDER BY texto_10,texto_7";
		$datos = $oTMP->query($sql);
		$total = count($datos);
		$oASINC->setTotal($total);
		$i = 0;			
		if(!empty($datos)):
			$resumen = array();
			foreach($datos as $i => $dato):
				$MSG = "RESUMIENDO POR CENTRO :: " .$dato['AsincronoTemporal']['texto_10']." - ".$dato['AsincronoTemporal']['texto_7']; 
				$oASINC->actualizar($i,$total,$MSG);			
				$dato['AsincronoTemporal']['id'] = 0;
				$dato['AsincronoTemporal']['asincrono_id'] =  $oASINC->id;
				$dato['AsincronoTemporal']['clave_1'] =  'REPORTE_4';
				$dato['AsincronoTemporal']['entero_1'] = $dato[0]['cantidad'];
				$dato['AsincronoTemporal']['entero_2'] = $dato[0]['entero_2'];
				$dato['AsincronoTemporal']['decimal_1'] = $dato[0]['decimal_1'];				
				$oTMP->save($dato);
			endforeach;
		endif;		
		
		$oASINC->actualizar(99,100,"FINALIZANDO...");
		$oASINC->fin("**** PROCESO FINALIZADO ****");
		
		return;		
		
	}
	
}

?>