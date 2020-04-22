<?php 
$datos = $this->requestAction('/global/global_datos/datos_nomenclador');
$combo = "<select name='data[$model][$field]' id='GlobalDatoIdComboNomenclador'>";
$selected = (isset($selected) ? $selected : null);

if(!empty($datos)):
	if(isset($empty) && $empty && empty($selected))$combo .= "<option value='' selected='selected'></option>";
	foreach($datos as $dato):
		$combo .= "<optgroup label='".$dato['LABEL']."' >";
		foreach($dato['CHILD'] as $id => $child):
			$combo .= "<option value='".$id."' ".($selected == $id ? " selected='selected' " : "")."  >".$child."</option>";
		endforeach;
	endforeach;
endif;
$combo .= "</select>";
echo $combo;
?>