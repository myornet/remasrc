<?php 

class AsincronoTemporal extends AppModel{
	
	var $name = "AsincronoTemporal";
	
	function limpiar($asinc_id){
		return $this->deleteAll("AsincronoTemporal.asincrono_id = $asinc_id");
	}
	
	function getTemporalByConditions($asinc_id,$conditions=array(),$order=array(),$fields = array(),$group = array()){
		$conditions['AsincronoTemporal.asincrono_id'] = $asinc_id;
		$datos = $this->find('all',array('conditions' => $conditions,'order' => $order,'fields' => $fields,'group' => $group));
		$datos = Set::extract('{n}.AsincronoTemporal',$datos);
		return $datos;
	}

	function getDetalleToExcel($asinc_id,$conditions=array(),$order=array(),$headers=array()){
		$xls = array();
		$conditions['AsincronoTemporal.asincrono_id'] = $asinc_id;
		$datos = $this->getTemporalByConditions($asinc_id,$conditions,$order);
		foreach($datos as $idx => $registro){
			if(!empty($headers)):
				foreach($headers as $key => $header):
					$xls[$header] = $registro[$key];
				endforeach;
			else:
					$xls = $registro;
			endif;
			$datos[$idx] = $xls;
		}
		return $datos;	
	}	
	
	
}

?>