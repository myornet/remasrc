<?php
/**
* 	adrian
* 	21/08/2010
*/


class BeneficiarioBeneficiosController extends AppController {

	var $name = 'BeneficiarioBeneficios';
	
	function index($beneficiario_id = null){
		if(empty($beneficiario_id)) $this->redirect('/beneficiarios/index');
		App::import('Model','Beneficiario');
		$oBEN = new Beneficiario();
		$beneficiario = $oBEN->getBeneficiario($beneficiario_id);
		if(empty($beneficiario)) $this->redirect('index');
		$this->set('beneficiario',$beneficiario);
		$this->set('beneficiario_id',$beneficiario_id);

		App::import('Model','BeneficiarioBeneficioDetalle');
		$oRENGLON = new BeneficiarioBeneficioDetalle();		
		
		$this->set('renglones',$oRENGLON->getRenglonesByBeneficiario($beneficiario_id,false));
		$this->set('renglonesPermanentes',$oRENGLON->getRenglonesByBeneficiario($beneficiario_id,true));
		
					
	}
	

	function aprobar_orden(){
		if(!empty($this->data)){
			$renglones = $this->Session->read('grilla_renglones');
			if(!empty($renglones) && $this->BeneficiarioBeneficio->generarOrden($this->data['BeneficiarioBeneficio']['cabecera'],$renglones)){
				$this->redirect('ficha/'.$this->BeneficiarioBeneficio->getLastInsertID());
			}else{
				$this->Mensaje->error("SE PRODUJO UN ERROR AL GENERAR LA ORDEN");
				$this->redirect('cargar_consumo/'.$this->data['BeneficiarioBeneficio']['beneficiario_id']);
			}
			
		}
		exit;
	}
	
	function ficha($ordenId,$toPDF=0){
		$orden = $this->BeneficiarioBeneficio->getOrden($ordenId);
		App::import('Model','Beneficiario');
		$oBENEFICIARIO = new Beneficiario(); 	
		$beneficiario = $oBENEFICIARIO->getBeneficiario($orden['BeneficiarioBeneficio']['beneficiario_id']);
		$this->set('beneficiario',$beneficiario);
		$this->set('beneficiario_id',$orden['BeneficiarioBeneficio']['beneficiario_id']);
		$this->set('orden',$orden);
		if($toPDF == 1) $this->render('ficha_sorted_pdf','pdf');
		else $this->render();		
	}
	
	
	function cargar_consumo($beneficiario_id = null){
		if(empty($beneficiario_id)) $this->redirect('/beneficiarios/index');
		$this->set('mostrar_detalle',"0");
		$this->set('persona_id',"0");
		$this->set('beneficiario_id',"0");
		
		$fechaNovedad = date('Y-m-d');
		
		$this->Session->del('grilla_renglones');
		
		if(!empty($this->data)){
			$this->set('mostrar_detalle',"1");
			$this->set('beneficiario_id',$this->data['BeneficiarioBeneficio']['beneficiario_id']);
			$fechaNovedad = date('Y-m-d',strtotime($this->BeneficiarioBeneficio->armaFechaForm($this->data['BeneficiarioBeneficio']['fecha'])));
		}		
		App::import('Model','Beneficiario');
		$oBEN = new Beneficiario();
		$beneficiario = $oBEN->getBeneficiario($beneficiario_id);
		if(empty($beneficiario)) $this->redirect('index');
		$this->set('beneficiario',$beneficiario);
		$this->set('beneficiario_id',$beneficiario_id);	
		$adicionales = $oBEN->getListMiembrosGrupoFliar($beneficiario_id);;
		$this->set('adicionales',$adicionales);	
		
		$this->set('fechaNovedad',$fechaNovedad);
		
		$this->render('cargar_consumo_nomenclador');
		
	}
	
	
	function cargar_renglones($beneficiario_id = null){

		if(empty($beneficiario_id)) parent::noAutorizado();
		$renglones = array();
		$ERROR = null;
		
		if(!$this->Session->check('grilla_renglones'))$this->Session->write('grilla_renglones',$renglones);
		else $renglones = $this->Session->read('grilla_renglones');		
		if(!empty($this->data)):
			if(!empty($this->data['BeneficiarioBeneficioDetalle']['codigo_producto'])):
				App::import('Model','Persona');
				$oPERSONA = new Persona();		
				$this->data['BeneficiarioBeneficioDetalle']['persona'] = $oPERSONA->getPersonaString($this->data['BeneficiarioBeneficioDetalle']['persona_id']);
				
				$existe = false;
				if(!empty($renglones)):
				
					foreach($renglones as $renglon):
					
						if($renglon['BeneficiarioBeneficioDetalle']['codigo_producto'] == $this->data['BeneficiarioBeneficioDetalle']['codigo_producto'] && $renglon['BeneficiarioBeneficioDetalle']['persona_id'] == $this->data['BeneficiarioBeneficioDetalle']['persona_id']):
							$existe = true;
						endif;	
										
					endforeach;
					
					if(!$existe)array_push($renglones,$this->data);
					else $ERROR = "EL PRODUCTO / SERVICIO SELECCIONADO YA EXISTE PARA EL BENEFICIARIO";

									
				else:
				
					array_push($renglones,$this->data);
				
				endif;
				
				
				$this->Session->write('grilla_renglones',$renglones);
				
				
			else:
				$ERROR = "DEBE INDICAR EL PRODUCTO / SERVICIO"; 	
			endif;
		endif;
		$this->set('ERROR',$ERROR);	
		$this->set('renglones',$renglones);	
		
		$this->render('cargar_renglones','ajax');
	}
	
	
	function cargar_renglones_remover($key){
		Configure::write('debug',0);
		$renglones = $this->Session->read('grilla_renglones');
		if(!empty($renglones)):
	    	array_splice($renglones,$key,1);
	    	if(count($renglones) == 0)$this->Session->del('grilla_renglones');
	    	else $this->Session->write('grilla_renglones',$renglones);
    	endif;
    	$this->set('renglones',$renglones);
    	$this->set('remove',true);
		$this->render('cargar_renglones','ajax');
	}	
	
	
	function autocomplete(){
		Configure::write('debug',0);
		App::import('Model', 'Global.GlobalDato');
		$oGLB = new GlobalDato(null);
		$datos = $oGLB->find('all',array('conditions' => array('GlobalDato.id LIKE ' => 'PYSE%','LENGTH(GlobalDato.id) >' => 8,'GlobalDato.concepto_1 LIKE ' => $this->data['BeneficiarioBeneficioDetalle']['productoAproxima'] . '%'),'order' => array('GlobalDato.concepto_1')));
		$this->set('productos',$datos);
		$this->render(null,'ajax');
	}
	
	
	function borrar_consumo($id=null){
		if(empty($id)) parent::noAutorizado();
		$ben = $this->BeneficiarioBeneficio->read(null,$id);
		if(empty($ben)) parent::noAutorizado();
	
		$creado = date('Ymd',strtotime($ben['BeneficiarioBeneficio']['created']));
		$hoy = date('Ymd');
		
		if($creado != $hoy){
			$this->Mensaje->error("NO SE PUDO BORRAR LA ORDEN PORQUE FUE EMITIDA EN OTRA FECHA DISTINTA A LA DE HOY");
			$this->redirect('index/'.$ben['BeneficiarioBeneficio']['beneficiario_id']);
		}

		
		if($this->BeneficiarioBeneficio->borrar($id)){
			$this->Mensaje->ok("BORRADO CORRECTAMENTE");
		}else{
			$this->Mensaje->error("NO SE PUDO BORRAR EL REGISTRO");
		}
		$this->redirect('index/'.$ben['BeneficiarioBeneficio']['beneficiario_id']);
		
	}
	
	
	
	function reasignar_consumos($beneficiario_id = null){
		if(empty($beneficiario_id)) $this->redirect('/personas/index');
		App::import('Model','Beneficiario');
		$oBEN = new Beneficiario();
		$beneficiario = $oBEN->getBeneficiario($beneficiario_id);
		if(empty($beneficiario)) $this->redirect('index');
		$this->set('beneficiario',$beneficiario);
		$this->set('beneficiario_id',$beneficiario_id);	
		$adicionales = $oBEN->getListMiembrosGrupoFliar($beneficiario_id);;
		$this->set('adicionales',$adicionales);

		if(!empty($this->data)):
			App::import('Model','BeneficiarioBeneficioDetalle');
			$oRENGLONES = new BeneficiarioBeneficioDetalle();			
			if($oRENGLONES->reasignar($this->data['BeneficiarioBeneficioDetalle']['beneficiario_id'],$this->data['BeneficiarioBeneficioDetalle']['persona_id_from'],$this->data['BeneficiarioBeneficioDetalle']['persona_id_to'])){
				$this->Mensaje->ok("ORDENES REASIGNADAS CORRECTAMENTE");
				$this->redirect('index/'.$this->data['BeneficiarioBeneficioDetalle']['beneficiario_id']);
			}else{
				$this->Mensaje->error("SE PRODUJO UN ERROR AL REASIGNAR LOS CONSUMOS");
			}
		endif;
		
	}
	
	
	function vencimiento_consumo($renglon_id = null){
		
		if(empty($renglon_id)) $this->redirect('/personas/index');
		App::import('Model','BeneficiarioBeneficioDetalle');
		$oRENGLONES = new BeneficiarioBeneficioDetalle();			
		$renglon = $oRENGLONES->read(null,$renglon_id);
		$this->set('renglon',$renglon);
		App::import('Model','Beneficiario');
		$oBEN = new Beneficiario();
		$beneficiario = $oBEN->getBeneficiario($renglon['BeneficiarioBeneficio']['beneficiario_id']);
		if(empty($beneficiario)) $this->redirect('index');
		$this->set('beneficiario',$beneficiario);
		$this->set('beneficiario_id',$renglon['BeneficiarioBeneficio']['beneficiario_id']);	
		
		if(!empty($this->data)):
			$renglon['BeneficiarioBeneficioDetalle']['fecha_hasta'] = $oBEN->armaFechaForm($this->data['BeneficiarioBeneficioDetalle']['fecha_hasta']);
			if($oRENGLONES->save($renglon)) $this->Mensaje->ok("VENCIMIENTO REASIGNADO CORRECTAMENTE");
			else $this->Mensaje->error("SE PRODUJO UN ERROR AL INTENTAR MODIFICAR EL VENCIMIENTO");
			$this->redirect('index/'.$renglon['BeneficiarioBeneficio']['beneficiario_id']);
		endif;
		
	}
	
	
}


?>