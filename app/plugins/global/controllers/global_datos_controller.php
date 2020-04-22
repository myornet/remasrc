<?php
class GlobalDatosController extends GlobalAppController{
	
	var $name = "GlobalDatos";
	
	function __getPrefijo($nivel=1,$prefijo=''){
		
		$res = array();
		
		$res['ln'] = 4;
		$res['pref_niv_act'] = "";
		$res['pref_niv_ant'] = "";
		
		if($nivel == 1):
			$res['ln'] = 4;
			$res['pref_niv_act'] = "";
			$res['pref_niv_ant'] = "";
		elseif($nivel == 2):
			$res['ln'] = 8;
			$res['pref_niv_act'] = substr($prefijo,0,4);
			$res['pref_niv_ant'] = "";			
		elseif($nivel == 3):
			$ln = 12;
			$res['ln'] = 12;
			$res['pref_niv_act'] = substr($prefijo,0,8);
			$res['pref_niv_ant'] = substr($prefijo,0,4);;				
		endif;
		
		$dato = $this->GlobalDato->read('concepto_1',substr($prefijo, 0, 4));
		$res['pref_niv_ant_desc'] = $dato['GlobalDato']['concepto_1'];
		$dato = $this->GlobalDato->read('concepto_1',$prefijo);
		$res['pref_niv_act_desc'] = $dato['GlobalDato']['concepto_1'];
		
		return $res;
				
	}

	
	function index($nivel = 1, $prefijo = ''){
		
		$this->GlobalDato->recursive = 0;
		$prefijos = $this->__getPrefijo($nivel,$prefijo);
		
		$conditions = array();
		$this->set('datos', $this->GlobalDato->find('all',array('conditions' => array('LENGTH(GlobalDato.id)' => $prefijos['ln'], 'GlobalDato.id LIKE' => $prefijos['pref_niv_act'] .'%'),'order' => array('GlobalDato.id'))));	
		$this->set('ln_s',$nivel + 1);
		$this->set('ln_a',$nivel - 1);
		$this->set('pref_s',$prefijos['pref_niv_act']);
		$this->set('pref_a',$prefijos['pref_niv_ant']);
		
		//saco las descripciones
		$this->set('padre',substr($prefijo, 0, 4));
		$this->set('padre_desc',$prefijos['pref_niv_ant_desc']);
		$this->set('prefijo_desc',$prefijos['pref_niv_act_desc']);		
		
		
	}
	
	function add($nivel = 1, $prefijo = ''){
		if (!empty($this->data)) {
			$this->data['GlobalDato']['id'] = $this->data['GlobalDato']['codigo_prefijo'] . str_pad(trim($this->data['GlobalDato']['codigo']),4,'0',STR_PAD_LEFT);
			$this->data['GlobalDato']['id'] = strtoupper($this->data['GlobalDato']['id']); 
			if ($this->GlobalDato->save($this->data)){
				$this->redirect(array('action'=>'index/'.$nivel.'/'.$prefijo));					
			}		
		}
		
		$prefijos = $this->__getPrefijo($nivel,$prefijo);
		
		$this->set('nivel',$nivel - 1);
		$this->set('prefijo',$prefijo);	
		$this->set('padre',substr($prefijo, 0, 4));
		
		$this->set('ln_s',$nivel + 1);
		$this->set('ln_a',$nivel - 1);
		$this->set('pref_s',$prefijos['pref_niv_act']);
		$this->set('pref_a',$prefijos['pref_niv_ant']);
		
		//saco las descripciones
		$this->set('padre',substr($prefijo, 0, 4));
		$this->set('padre_desc',$prefijos['pref_niv_ant_desc']);
		$this->set('prefijo_desc',$prefijos['pref_niv_act_desc']);	
						
	}
	
	function edit($id=null,$nivel = 1, $prefijo = ''){
		if(empty($id)) $this->redirect('index');
		if (!empty($this->data)) {
			if ($this->GlobalDato->save($this->data)){
				$this->redirect(array('action'=>'index/'.$nivel.'/'.$prefijo));				
			}		
		}
		$this->data = $this->GlobalDato->read(null,$id);
		$this->set('nivel',$nivel - 1);
		$this->set('prefijo',$prefijo);	

		$prefijos = $this->__getPrefijo($nivel,$prefijo);
		
		$this->set('padre',substr($prefijo, 0, 4));
		
		$this->set('ln_s',$nivel + 1);
		$this->set('ln_a',$nivel - 1);
		$this->set('pref_s',$prefijos['pref_niv_act']);
		$this->set('pref_a',$prefijos['pref_niv_ant']);
		
		//saco las descripciones
		$this->set('padre',substr($prefijo, 0, 4));
		$this->set('padre_desc',$prefijos['pref_niv_ant_desc']);
		$this->set('prefijo_desc',$prefijos['pref_niv_act_desc']);		
	}
	
	function del($id = null,$nivel = 1, $prefijo = ''){
		if(empty($id)) $this->redirect('index');
		if ($this->GlobalDato->del($id)) {
		}
		$nivel = $nivel - 1;		
		$this->redirect(array('action'=>'index/'.$nivel.'/'.$prefijo));
	}	
	
	
	function valor_global($id,$field='concepto_1',$render=1){
		$dato = $this->GlobalDato->read(null,$id);
		if(!empty($dato)) return $dato['GlobalDato'][$field];
		else return null;
	}

	
	function datos_globales($prefix){
		return $this->GlobalDato->find('all',array('conditions' => array('GlobalDato.id LIKE ' => $prefix . '%', 'GlobalDato.id <> ' => $prefix),'order' => array('GlobalDato.id')));
	}
	
	
	function combo_global($criterio=null,$campos=null,$orden=null){
		$conditions = unserialize(base64_decode($criterio));
		$fields = unserialize(base64_decode($campos));
		$order = unserialize(base64_decode($orden));
		if(empty($fields)) $fields = array('GlobalDato.concepto_1');
		if(empty($order)) $order = 'GlobalDato.concepto_1';
		$values = $this->GlobalDato->find('list',array('conditions'=>$conditions,'fields' => $fields, 'order' => $order));
		return $values;
	}
	
	
	function view($prefijo=null){
		$this->set('prefijo',$prefijo);
		$this->set('datos', $this->GlobalDato->find('all',array('conditions' => array('GlobalDato.id LIKE' => $prefijo .'%'),'order' => array('GlobalDato.id'))));
		if(isset($this->params['url']['to'])):
			$this->set('fields',array_keys($this->GlobalDato->_schema));
			if($this->params['url']['to'] == 'TXT'):
				$this->render("txt",'blank');
			elseif($this->params['url']['to'] == 'CSV'):
				$this->render("csv",'blank');
			else:
				$this->render();
			endif;
		else:
			$this->render();
		endif;
		
	}

	
	function get_barrios(){
		$values = $this->GlobalDato->find('list',array('conditions'=>array('GlobalDato.id LIKE ' => 'PERSBARR%', 'GlobalDato.id <> ' => 'PERSBARR'),'fields' => array('GlobalDato.concepto_1'), 'order' => 'GlobalDato.concepto_1'));
		return $values;
	}	
	
	
	function datos_nomenclador(){
		$datos = $this->GlobalDato->getDatosNomencladorList();
		return $datos;
	}
	
	
	
}
?>
