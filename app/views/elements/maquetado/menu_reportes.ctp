<h2 class="modulo">REPORTES</h2>
<?php 
$tabs = array(
				0 => array('url' => '/reportes/consulta_general_prodserv','label' => 'REPORTE GENERAL DE PRODUCTOS Y/O SERVICIOS', 'icon' => 'controles/printer.png','atributos' => array(), 'confirm' => null),
				1 => array('url' => '/reportes/padron_beneficiarios','label' => 'PADRON DE BENEFICIARIOS', 'icon' => 'controles/printer.png','atributos' => array(), 'confirm' => null),
			);
echo $cssMenu->menuTabs2($tabs,false);	
?>