<?php
class GlobalDato extends GlobalAppModel{
    
	var $name = 'GlobalDato';


	
	function del($id){
		$ret = false;
		$rws = $this->find('count',array('conditions' => array('GlobalDato.id LIKE' => $id . '%', 'GlobalDato.id <>' => $id)));
		if($rws == 0){
			$ret = parent::del($id);	
		}
		return $ret;
	}

	
	function getDatosNomencladorList(){
		$datos = array();
		$padres = $this->find('all',array('conditions' => array('GlobalDato.id LIKE ' => 'PYSE%','LENGTH(GlobalDato.id)' => 8), 'order' => array('GlobalDato.concepto_1')));
		if(empty($padres)) return null;
		foreach($padres as $i => $padre):
//			$datos[$padre['GlobalDato']['id']]['LABEL'] = $padre['GlobalDato']['concepto_1'];
//			$datos[$padre['GlobalDato']['id']]['CHILD'] = array();
			$childs = $this->find('all',array('conditions' => array('GlobalDato.id LIKE ' => $padre['GlobalDato']['id'].'%','LENGTH(GlobalDato.id)' => 12), 'order' => array('GlobalDato.concepto_1')));
			if(!empty($childs)):
				$datos[$padre['GlobalDato']['id']]['LABEL'] = $padre['GlobalDato']['concepto_1'];
				$datos[$padre['GlobalDato']['id']]['CHILD'] = array();
				foreach($childs as $child):
					$datos[$padre['GlobalDato']['id']]['CHILD'][$child['GlobalDato']['id']] = $child['GlobalDato']['concepto_1'];
				endforeach;
			endif;
		endforeach;
		return $datos;
	}
	
	
	
}
?>