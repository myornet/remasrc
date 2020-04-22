<?php
/**
* 	adrian
* 	20/08/2010
*/



class BeneficiariosController extends AppController{
	
	var $name = "Beneficiarios";
	
	
	function beforeFilter(){ 
		parent::beforeFilter();  
 	}	
	
	function index(){
		$this->redirect('/personas');
	}
	
	
	function modificar_datos_titular($id=null){
		if(empty($id)) $this->redirect('index');
		if(!empty($this->data)){
			if($this->Beneficiario->guardar($this->data)):
				$this->Mensaje->ok("DATOS ACTUALIZADOS CORRECTAMENTE.");
			else:
				$this->Mensaje->error("VERIFICAR LOS DATOS");
			endif;
		}		
		$this->data = $this->Beneficiario->getBeneficiario($id);
		$this->set('beneficiario_id',$id);
		$this->set('beneficiario',$this->data);
	}
	
	function ficha($persona_id = null,$toPDF=0){
		if(empty($persona_id)) $this->redirect('index');
		//cargo la persona
		App::import('Model','Persona');
		$oPERSONA = new Persona(); 		
		$persona = $oPERSONA->getPersona($persona_id);
		
		App::import('Model','Beneficiario');
		$oBeneficiario = new Beneficiario(); 		


		$benficiario = $oBeneficiario->getBeneficiarioByPersonaId($persona_id);
		$beneficiario_id = null;
		
		
		
		if(!empty($benficiario)):
			$beneficiario_id = $benficiario['Beneficiario']['id'];
		else:
			
			App::import('Model','BeneficiarioAdicional');
			$oBeneficiarioAdicional = new BeneficiarioAdicional();	
		
			$benficiario = $oBeneficiarioAdicional->getBeneficiarioAdicionalByPersonaId($persona_id);
			if(empty($benficiario)){
				$this->Mensaje->error("ERROR: LA PERSONA NO ESTA VINCULADA A NINGUN BENEFICIO");
				$this->redirect('index');
			}
			$beneficiario_id = $benficiario['BeneficiarioAdicional']['beneficiario_id'];
			
			
		endif;
		if(empty($beneficiario_id)):
			$this->Mensaje->error("ERROR DE APLICACION: BeneficiariosController (68)");
			$this->redirect('index');
		endif;			
		
		if(empty($persona)) $this->redirect('index');
//		if(!empty($persona['Beneficiario']['id'])) $beneficiario_id = $persona['Beneficiario']['id'];
//		elseif(!empty($persona['BeneficiarioAdicional']['beneficiario_id'])) $beneficiario_id = $persona['BeneficiarioAdicional']['beneficiario_id']; 
		$beneficiario = $this->Beneficiario->getBeneficiario($beneficiario_id);
		if(empty($beneficiario)) $this->redirect('index');

		//CARGO LOS CONSUMOS
		if($toPDF == 0):
		
			App::import('Model','BeneficiarioBeneficioDetalle');
			$oRENGLON = new BeneficiarioBeneficioDetalle();		
			
			$beneficiario['BeneficiosPermanentes'] = $oRENGLON->getRenglonesByBeneficiario($beneficiario_id,true);
			$beneficiario['Beneficios'] = $oRENGLON->getRenglonesByBeneficiario($beneficiario_id,false);		
			
		else:
		
			$beneficiario['BeneficiosPermanentes'] = null;
			$beneficiario['Beneficios'] = null;
			
			
		endif;
		
		$this->set('beneficiario',$beneficiario);
		$this->set('beneficiario_id',$beneficiario_id);		
		
		if($toPDF == 1) $this->render('nueva_ficha_pdf','pdf');
		else $this->render();
	}
	
	function autocomplete(){
		Configure::write('debug',0);
		$this->Beneficiario->unbindModel(array('hasMany' => array('BeneficiarioAdicional')));
		$beneficiarios = null;
		$conditions = array();
		$conditions['Beneficiario.estado'] = 1;
		$conditions['Persona.apellido LIKE'] = $this->data['BeneficiarioAdicional']['beneficiarioAproxima'] . '%';
		$beneficiarios = $this->Beneficiario->find('all',array('conditions' => $conditions));	
		$this->set('beneficiarios',$beneficiarios);
		$this->render(null,'ajax');
	}
	
	function modificar_estado($id=null){
		if(empty($id)) $this->redirect('index');
		if(!empty($this->data)):
			$beneficiario = $this->Beneficiario->read(null,$this->data['Beneficiario']['id']);
		
			if($this->data['Beneficiario']['estado'] == 0):
				$beneficiario['Beneficiario']['estado'] = 0;
				$beneficiario['Beneficiario']['fecha_baja'] = date('Y-m-d');
			
			else:
				$beneficiario['Beneficiario']['estado'] = 1;
				$beneficiario['Beneficiario']['fecha_baja'] = null;			
			endif;

			if($this->Beneficiario->save($beneficiario)):
				$this->Mensaje->ok("DATOS ACTUALIZADOS CORRECTAMENTE");
			else:
				$this->Mensaje->error("NO SE PUDO ACTUALIZAR EL ESTADO");
			endif;
			
			
		endif;
		$beneficiario = $this->Beneficiario->getBeneficiario($id);
		if(empty($beneficiario)) $this->redirect('index');		
		$this->set('beneficiario',$beneficiario);		
		$this->set('beneficiario_id',$id);
		
	}
	
	
	function unificar($id = null){
		if(empty($id)) $this->redirect('index');
		$beneficiario = $this->Beneficiario->getBeneficiario($id);
		if(empty($beneficiario)) $this->redirect('index');
		$this->set('beneficiario',$beneficiario);		
		$this->set('beneficiario_id',$id);
		
		if(!empty($this->data)):
		
			if($this->Beneficiario->unificar($this->data['Beneficiario']['beneficiario_id_actual'],$this->data['Beneficiario']['nuevo_beneficiario_id'],$this->data['Beneficiario']['tipo_parentezco'])):
				$this->Mensaje->ok("UNIDICACION EFECTUADA CORRECTAMENTE");
				$beneficiario = $this->Beneficiario->read('persona_id',$this->data['Beneficiario']['nuevo_beneficiario_id']);
				$this->redirect('ficha/' . $beneficiario['Beneficiario']['persona_id']);
			else:
				$this->Mensaje->error("NO SE PUDO UNIFICAR EL BENEFICIO");
			endif;
		
		endif;
	}
	
	
	function novedades($id = null){
		if(empty($id)) $this->redirect('index');
		$beneficiario = $this->Beneficiario->getBeneficiario($id);
		if(empty($beneficiario)) $this->redirect('index');
		$this->set('beneficiario',$beneficiario);		
		$this->set('beneficiario_id',$id);
		
		$oNOVEDAD = ClassRegistry::init('BeneficiarioNovedad');
		
		$novedades = $oNOVEDAD->find('all',array('conditions' => array('BeneficiarioNovedad.beneficiario_id' => $id),'order' => array('BeneficiarioNovedad.created DESC')));
		$this->set('novedades',$novedades);
		
	}
	
	function borrar_novedad($idNovedad = null){
		if(empty($idNovedad)) $this->redirect('index');
		$oNOVEDAD = ClassRegistry::init('BeneficiarioNovedad');
		$novedad = $oNOVEDAD->read(null,$idNovedad);
		if(empty($novedad)) $this->redirect('index');
		if($oNOVEDAD->del($idNovedad)){
			if(file_exists(WWW_ROOT . 'novedades' . DS .$novedad['BeneficiarioNovedad']['adjunto'])) unlink(WWW_ROOT . 'novedades' . DS .$novedad['BeneficiarioNovedad']['adjunto']);
		}
		$this->redirect('novedades/' . $novedad['BeneficiarioNovedad']['beneficiario_id']);
	}
	
	function nueva_novedad($id = null){
		if(empty($id)) $this->redirect('index');
		$beneficiario = $this->Beneficiario->getBeneficiario($id);
		if(empty($beneficiario)) $this->redirect('index');
		$this->set('beneficiario',$beneficiario);		
		$this->set('beneficiario_id',$id);
		if(!empty($this->data)):
			$oNOVEDAD = ClassRegistry::init('BeneficiarioNovedad');
			$file = $this->data['BeneficiarioNovedad']['fileUp'];
			$this->data['BeneficiarioNovedad']['adjunto'] = null;
			if($oNOVEDAD->save($this->data)) :
				if(!empty($file) && $file['error'] != 4):
					$novedad = $oNOVEDAD->read(null,$oNOVEDAD->getLastInsertID());
					$extUp = strtolower(trim(substr($file['name'],strrpos($file['name'],".") + 1, strlen($file['name']))));
					if($extUp == 'jpg'):
						if($file['size'] <= 512000){
							$fileName = $oNOVEDAD->table."_".$novedad['BeneficiarioNovedad']['id'].".$extUp";
							$path = WWW_ROOT . 'novedades' . DS . $fileName;
							if(move_uploaded_file($file['tmp_name'], $path)){
								$novedad['BeneficiarioNovedad']['adjunto'] = $fileName;
								$oNOVEDAD->save($novedad);
								$this->redirect('novedades/' . $this->data['BeneficiarioNovedad']['beneficiario_id']);
							}
						}else{
							$this->Mensaje->error("EL ARCHIVO SUPERA EL TAMAÑO MAXIMO PERMITIDO DE 500 Kb");
						}
					else:
						$this->Mensaje->error("SOLAMENTE SE PUEDEN ENVIAR ARCHIVOS CON EXTENSION .jpg");	
					endif;
				else:
					$this->redirect('novedades/' . $this->data['BeneficiarioNovedad']['beneficiario_id']);
				endif;
			endif;
		endif;
	}	
	
	
}

?>