<?php echo $this->renderElement('beneficiarios/menu_padron',array('beneficiario_id' => $beneficiario_id))?>
<h2>GRUPO FAMILIAR :: MODIFICAR DATOS DEL ADICIONAL</h2>

<div class="areaDatoForm">
	<?php echo $frm->create(null,array('action' => 'modificar_datos_adicional/'.$this->data['BeneficiarioAdicional']['id']));?>
	<?php echo $this->renderElement('personas/form_datos_adicional',array('edit' => true))?>		
	<?php echo $frm->input('id');?>	
	<?php echo $frm->hidden('beneficiario_id',array('value' => $beneficiario_id));?>
	<?php echo $frm->hidden('persona_id',array('value' => $this->data['BeneficiarioAdicional']['persona_id']));?>
	<?php echo $frm->btnGuardarCancelar(array('URL' => '/beneficiario_adicionales/index/'.$beneficiario_id))?>	
</div>