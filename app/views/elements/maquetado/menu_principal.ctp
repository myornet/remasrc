<ul id="simple-menu"> 
<?php 

if($user['Usuario']['perfil'] == 3):

	echo "<li>".$html->link("SEGURIDAD","/usuarios/index",array('title' => 'Seguridad y Mantenimiento'),false,false)."</li>";
	echo "<li>".$html->link("NOMENCLADORES","/global/global_datos/index",array('title' => 'Configuraciones'),false,false)."</li>";

endif;

echo "<li>".$html->link("PADRON DE BENEFICIARIOS","/personas/index",array('title' => 'Padron de Beneficiarios'),false,false)."</li>";

if($user['Usuario']['perfil'] == 3) echo "<li>".$html->link("REPORTES","/reportes/index",array('title' => 'Reportes'),false,false)."</li>";
?>
</ul> 
 