<?php 
$datos = $this->requestAction('/global/global_datos/'.$metodo);
$empty = (isset($empty) ? $empty : 0);
$selected = (isset($selected) ? $selected : "");
$label = (isset($label) ? $label : "");
$disabled = (isset($disabled) ? $disabled : 0);
$model = (isset($model) ? $model : "GlobalDato.id");

echo $frm->input($model,array('type'=>'select','options'=>$datos,'empty'=>($empty == 0 ? false : true),'selected' => (isset($selected) ? $selected : ''),'label'=>$label,'disabled' => ($disabled == 0 ? '' : 'disabled')));
?>