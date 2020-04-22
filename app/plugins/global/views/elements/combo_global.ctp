<?php 
$conditions = array();

$conditions['GlobalDato.id LIKE'] = $prefix."%";
$conditions['GlobalDato.id <>'] = $prefix;


$conditions = base64_encode(serialize($conditions));

$fields = base64_encode(serialize((isset($campos) ? $campos : null)));
$order = base64_encode(serialize((isset($orden) ? $orden : null)));


$datos = $this->requestAction('/global/global_datos/combo_global/'.$conditions.'/'.$fields.'/'.$order);

$empty = (isset($empty) ? $empty : false);
$selected = (isset($selected) ? $selected : "");
$label = (isset($label) ? $label : "");
$disabled = (isset($disabled) ? $disabled : false);
$model = (isset($model) ? $model : "GlobalDato.id");

echo $frm->input($model,array('type'=>'select','options'=>$datos,'empty'=> $empty,'selected' => (isset($selected) ? $selected : ''),'label'=>$label,'disabled' => (!$disabled ? '' : 'disabled')));
?>