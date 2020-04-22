<?php 
ob_start();
header("Content-type: text/plain");
header("Content-Disposition: attachment; filename=global_datos.txt");
echo str_pad("",75,"-",STR_PAD_RIGHT)."\n";
echo str_pad("CODIGO",15," ",STR_PAD_RIGHT);
echo str_pad("CONCEPTO",60," ",STR_PAD_RIGHT);
echo "\n";
echo str_pad("",75,"-",STR_PAD_RIGHT)."\n";
if(!empty($datos)):
	foreach($datos as $id => $dato):
		echo str_pad($dato['GlobalDato']['id'],15," ",STR_PAD_RIGHT);
		echo str_pad($dato['GlobalDato']['concepto_1'],60," ",STR_PAD_RIGHT);
		echo "\n";		
	endforeach;
endif;
?>