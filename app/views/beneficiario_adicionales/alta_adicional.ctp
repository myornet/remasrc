<?php echo $this->renderElement('beneficiarios/menu_padron',array('beneficiario_id' => $beneficiario_id))?>
<h2>GRUPO FAMILIAR :: INCORPORAR AL GRUPO FAMILIAR</h2>

<div class="areaDatoForm">
	<?php echo $frm->create(null,array('action' => 'alta_adicional/'.$beneficiario_id));?>
	<?php echo $this->renderElement('personas/form_datos_adicional',array('edit' => false))?>		
	<?php echo $frm->input('id');?>	
	<?php echo $frm->hidden('beneficiario_id',array('value' => $beneficiario_id));?>
	<?php echo $frm->hidden('persona_id',array('value' => $beneficiario['Persona']['id']));?>
	<?php echo $frm->btnGuardarCancelar(array('URL' => '/beneficiario_adicionales/index/'.$beneficiario_id))?>	
</div>