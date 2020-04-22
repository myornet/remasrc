<?php echo $this->renderElement('beneficiarios/menu_padron',array('beneficiario_id' => $beneficiario_id))?>

<div class="areaDatoForm">
	<h3>MODIFICAR DATOS DEL TITULAR</h3>
	<?php echo $frm->create(null,array('action' => 'modificar_datos_titular'));?>
	<?php echo $this->renderElement('personas/form_datos_titular',array('edit' => true))?>
	<?php echo $frm->hidden('id');?>
	<?php echo $frm->hidden('persona_id');?>
	<?php if($user['Usuario']['perfil'] == 3 && $beneficiario['Beneficiario']['estado'] == 1) echo $frm->submit("ACTUALIZAR DATOS")?>
	<?php echo $frm->end();?>
</div>