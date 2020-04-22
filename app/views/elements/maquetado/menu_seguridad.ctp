<?php 
$tabs = array(
				0 => array('url' => '/usuarios/index','label' => 'USUARIOS', 'icon' => 'controles/user.png','atributos' => array(), 'confirm' => null),
				1 => array('url' => '/centros/index','label' => 'CENTROS DE ATENCION', 'icon' => 'controles/folder_home.png','atributos' => array(), 'confirm' => null),
				2 => array('url' => '/backups/index','label' => 'BACKUP DE DATOS', 'icon' => 'controles/database_save.png','atributos' => array(), 'confirm' => null),
				3 => array('url' => '/conexiones/index','label' => 'CONEXIONES A MUNICIPIOS', 'icon' => 'controles/page_world.png','atributos' => array(), 'confirm' => null),
			);
echo $cssMenu->menuTabs2($tabs,false);	
?>