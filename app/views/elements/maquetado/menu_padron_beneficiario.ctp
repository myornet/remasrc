<?php 
$tabs = array(
				0 => array('url' => '/beneficiarios/ficha/'.$beneficiario['Persona']['id'],'label' => 'FICHA', 'icon' => 'controles/editpaste.png','atributos' => array(), 'confirm' => null),
				1 => array('url' => '/beneficiarios/modificar_datos_titular/'.$beneficiario_id,'label' => 'DATOS DEL TITULAR', 'icon' => 'controles/yast_sysadmin.png','atributos' => array(), 'confirm' => null),				
				2 => array('url' => '/beneficiario_adicionales/index/'.$beneficiario_id,'label' => 'GRUPO FAMILIAR', 'icon' => 'controles/groupevent.png','atributos' => array(), 'confirm' => null),
				3 => array('url' => '/beneficiario_beneficios/index/'.$beneficiario_id,'label' => 'CONSUMOS', 'icon' => 'controles/cart_put.png','atributos' => array(), 'confirm' => null),
				4 => array('url' => '/beneficiarios/novedades/'.$beneficiario_id,'label' => 'NOVEDADES', 'icon' => 'controles/note.png','atributos' => array(), 'confirm' => null),
				7 => array('url' => '/beneficiarios/','label' => 'OTRO', 'icon' => 'controles/reload3.png','atributos' => array(), 'confirm' => null),
			);
if($user['Usuario']['perfil'] == 3):
	$tabs[5] = array('url' => '/beneficiarios/modificar_estado/'.$beneficiario_id,'label' => 'ESTADO', 'icon' => 'controles/encrypted.png','atributos' => array(), 'confirm' => null);		
	$tabs[6] = array('url' => '/beneficiarios/unificar/'.$beneficiario_id,'label' => 'UNIFICAR', 'icon' => 'controles/insertcellcopy.png','atributos' => array(), 'confirm' => null);
endif;			
ksort($tabs);			
echo $cssMenu->menuTabs($tabs,false);	
?>