<?php
/**
*	24/08/2010
*	adrian
*
*/

class PersonasController extends AppController{
	
	var $name = "Personas";
	
	function beforeFilter(){ 
		parent::beforeFilter();  
 	}	
	
	function index(){
		$condiciones = null;		
//		$this->Beneficiario->recursive = 2;
		$this->Persona->unbindModel(array('hasOne' => array('Beneficiario','BeneficiarioAdicional')));
		$search = null;
		
		if(!empty($this->data)){
			$this->Session->del($this->name.'.search');
			$search = $this->data;
		}else if($this->Session->check($this->name.'.search')){
			$search = $this->Session->read($this->name.'.search');
			$this->data = $search;
		}

		if(!empty($this->data)):
		
			$search = $this->data;
			$condiciones = array(
								'Persona.tipo_documento  LIKE ' => $search['Persona']['tipo_documento'] ."%",
								'Persona.documento LIKE ' => $search['Persona']['documento']."%",
								'Persona.apellido LIKE ' => $search['Persona']['apellido']."%",
								'Persona.nombre LIKE ' => $search['Persona']['nombre']."%",	
							);					
	//		$this->Session->write($this->name.'.search', $search);
			$this->paginate = array(
									'limit' => 30,
									'order' => array('Persona.apellido' => 'ASC', 'Persona.nombre' => 'ASC')
									);
			$this->set('personas', $this->paginate(null,$condiciones));
		else:
			$this->set('personas', null);
		endif;
		
		$this->Session->write($this->name.'.search', $search);
	
	}
	
	
	function alta_titular(){
		if(!empty($this->data)){
			$this->data['Persona']['documento'] = $this->Persona->fill(trim($this->data['Persona']['documento']),8);
			$beneficiario_id = $this->Persona->altaDeTitular($this->data);
			if($beneficiario_id != 0):
				$this->redirect('/beneficiarios/ficha/'.$this->Persona->getLastInsertID());
			else:
				$this->Mensaje->error("COMPLETAR LOS DATOS OBLIGATORIOS. EN CASO DE QUE EL DOCUMENTO YA EXISTA NO SE PROCESARA EL FORMULARIO.");
			endif;
		}		
	}
	
	function alta_adicional($titular_id = null){
		if(empty($titular_id)) $this->redirect('index');
		
	}
	
	
	function ficha($id = null){
		if(!$id) $this->redirect('index');
		$persona = $this->Persona->getPersona($id);
		$datosRed = $this->Persona->getDatosRed($id);
		$this->set('persona',$persona);
		$this->set('datosRed',$datosRed);
		//cargo los consumos
		App::import('Model','BeneficiarioBeneficioDetalle');
		$oRENGLON = new BeneficiarioBeneficioDetalle();	

		$consumos = $oRENGLON->getRenglonesByPersonaIdSorted($id);
		$this->set('consumos',$consumos);
//		$this->render('nueva_ficha');
		
	}

	
	function ficha_remota($connID,$persID){
		$fichaRemota = $this->Persona->getFichaRemota($connID,$persID);
		$oPersonaRemota = null;
		$this->set('muniRemota',$fichaRemota['municipio']);
		if(is_object($fichaRemota['response'])):
			$oResponse = $fichaRemota['response'];
			if(is_object($oResponse->result)) $oPersonaRemota = $oResponse->result;
		endif;
		$this->set('oPersonaRemota',$oPersonaRemota);
//		$this->render(null,'ficha_remota');
	}
	
	
	function datosRemotos(){
		
	}
	

}

?>