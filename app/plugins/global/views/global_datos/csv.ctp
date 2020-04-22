<?php 
ob_start();
header("Content-type: text/plain");
header("Content-Disposition: attachment; filename=global_datos.csv");
$fields[0] = 'codigo'; 
echo implode(",",$fields)."\n";
$datos = Set::extract("{n}.GlobalDato",$datos);
if(!empty($datos)):
	foreach($datos as $id => $dato):
		foreach($dato as $i => $value):
			$dato[$i] = str_replace(",",";",$value);
		endforeach;
		echo implode(",",$dato)."\n";
	endforeach;
endif;
?>