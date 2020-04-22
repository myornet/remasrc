<?php
/**
* 	adrian
* 	21/08/2010
*/


class BeneficiarioAdicionalesController extends AppController {

	var $name = 'BeneficiarioAdicionales';
	
	function index($beneficiario_id = null){
		if(empty($beneficiario_id)) $this->redirect('/beneficiarios/index');
		App::import('Model','Beneficiario');
		$oBEN = new Beneficiario();
		$beneficiario = $oBEN->getBeneficiario($beneficiario_id);
		if(empty($beneficiario)) $this->redirect('index');
		$this->set('beneficiario',$beneficiario);
		$this->set('beneficiario_id',$beneficiario_id);
		$this->set('adicionales',$this->BeneficiarioAdicional->getByBeneficiario($beneficiario_id));
		$this->set('estuvieron',$this->BeneficiarioAdicional->getPersonasQueEstuvieronEnElGrupo($beneficiario_id));		
	}
	
	function alta_adicional($beneficiario_id = null){
		if(empty($beneficiario_id)) $this->redirect('/beneficiarios/index');
		if(!empty($this->data)){
			$this->data['Persona']['documento'] = $this->BeneficiarioAdicional->fill(trim($this->data['Persona']['documento']),8);
			if($this->BeneficiarioAdicional->nuevoAdicional($this->data)):
				$this->redirect('index/'.$this->data['BeneficiarioAdicional']['beneficiario_id']);
			else:
				$this->Mensaje->error("COMPLETAR LOS DATOS OBLIGATORIOS (*). EN CASO DE QUE EL DOCUMENTO YA EXISTA NO SE PROCESARA EL FORMULARIO.");
			endif;
		}		
		
		App::import('Model','Beneficiario');
		$oBEN = new Beneficiario();
		$beneficiario = $oBEN->getBeneficiario($beneficiario_id);
		if(empty($beneficiario)) $this->redirect('index');
		$this->set('beneficiario',$beneficiario);
		$this->set('beneficiario_id',$beneficiario_id);		
	}
	
	
	function modificar_datos_adicional($id = null){
		if(empty($id)) $this->redirect('/beneficiarios/index');
		
		if(!empty($this->data)){
			if($this->BeneficiarioAdicional->modificarAdicional($this->data)):
				$this->redirect('index/'.$this->data['BeneficiarioAdicional']['beneficiario_id']);
			else:
				$this->Mensaje->error("COMPLETAR LOS DATOS OBLIGATORIOS. EN CASO DE QUE EL DOCUMENTO YA EXISTA NO SE PROCESARA EL FORMULARIO.");
			endif;
		}		
		
		$this->data = $this->BeneficiarioAdicional->read(null,$id);
		App::import('Model','Beneficiario');
		$oBEN = new Beneficiario();
		$beneficiario = $oBEN->getBeneficiario($this->data['BeneficiarioAdicional']['beneficiario_id']);
		if(empty($beneficiario)) $this->redirect('index');
		$this->set('beneficiario',$beneficiario);
		$this->set('beneficiario_id',$beneficiario['Beneficiario']['id']);		
	}
	
	
	function borrar_adicional($id = null){
		if(empty($id)) $this->redirect('/beneficiarios/index');
		$adicional = $this->BeneficiarioAdicional->read(null,$id);
		if(!$this->BeneficiarioAdicional->borrar($id)):
			$this->Mensaje->error("NO SE PUDO BORRAR EL ADICIONAL PORQUE TIENE CONSUMOS ASOCIADOS!");
		endif;		
		$this->redirect('index/'.$adicional['BeneficiarioAdicional']['beneficiario_id']);
	}

	function administrar($beneficiario_id = null){
		if(empty($beneficiario_id)) $this->redirect('/beneficiarios/index');
		if(!empty($this->data)){
			if($this->BeneficiarioAdicional->administrar($this->data['BeneficiarioAdicional']['id'],$this->data['BeneficiarioAdicional']['accion'],$this->data['BeneficiarioAdicional']['fecha_accion'],(isset($this->data['BeneficiarioAdicional']['nuevo_beneficiario_id']) ? $this->data['BeneficiarioAdicional']['nuevo_beneficiario_id'] : null),(isset($this->data['BeneficiarioAdicional']['tipo_parentezco']) ? $this->data['BeneficiarioAdicional']['tipo_parentezco'] : null))){
				$this->redirect('index/'.$beneficiario_id);
			}else{
				$this->Mensaje->error("SE PRODUJO UN ERROR AL PROCESAR LOS DATOS");
			}
		}
		App::import('Model','Beneficiario');
		$oBEN = new Beneficiario();
		$beneficiario = $oBEN->getBeneficiario($beneficiario_id);
		if(empty($beneficiario)) $this->redirect('index');
		$this->set('beneficiario',$beneficiario);
		$this->set('beneficiario_id',$beneficiario_id);
		$adicionales = $this->BeneficiarioAdicional->getByBeneficiarioList($beneficiario_id);
		if(empty($adicionales)){
			$this->Mensaje->error("NO POSEE INTEGRANTES EL GRUPO FAMILIAR ACTUAL");
			$this->redirect('/beneficiario_adicionales/index/' . $beneficiario_id);
		}
		$this->set('adicionales',$adicionales);
		$this->set('acciones',$this->BeneficiarioAdicional->accionesAdministracion);		
	}
	
	
	function revertir($adicional_id,$newBeneficioId){
		//INTENTO BORRAR EL NUEVO BENEFICIO
		App::import('Model','Beneficiario');
		$oBEN = new Beneficiario();	
		if(!$oBEN->eliminarBeneficio($newBeneficioId)){
			$this->Mensaje->error("NO SE PUDO REINCORPORAR. VERIFIQUE QUE EL BENEFICIO #$newBeneficioId NO TENGA ADICIONALES Y/O ORDENES EMITIDAS");
			$this->redirect('/beneficiario_adicionales/index/' . $oldBeneficioId);			
		}
		//SI SE BORRO EL NUEVO BENEFICIO VUELVO LA PERSONA AL BENEFICIO ANTERIOR
		$adicional = $this->BeneficiarioAdicional->read(null,$adicional_id); 
		$adicional['BeneficiarioAdicional']['estado'] = 1;
		$adicional['BeneficiarioAdicional']['fecha_baja'] = null;
		$adicional['BeneficiarioAdicional']['observaciones'] = null;
		$adicional['BeneficiarioAdicional']['nuevo_titular_beneficio_id'] = 0;
		if($this->BeneficiarioAdicional->save($adicional)){
			$this->Mensaje->ok("REINCORPORACION EFECTUADA CORRECTAMENTE. SE ELIMINO CORRECTAMENTE EL BENEFICIO #$newBeneficioId");
		}else{
			$this->Mensaje->error("SE PRODUJO UN ERROR AL INTENTAR PROCESAR LA REINCORPORACION");
		}
		$this->redirect('/beneficiario_adicionales/index/' . $adicional['BeneficiarioAdicional']['beneficiario_id']);
	}
	
	
}


?>