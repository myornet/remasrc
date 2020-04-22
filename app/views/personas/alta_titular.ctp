<h2 class="modulo">PADRON DE BENEFICIARIOS :: ALTA NUEVO TITULAR</h2>

<div class="areaDatoForm">
	<h3>DATOS DEL TITULAR</h3>
	<?php echo $frm->create(null,array('action' => 'alta_titular'));?>
	<?php echo $this->renderElement('personas/form_datos_titular',array('edit' => false))?>
	<?php echo $frm->btnGuardarCancelar(array('URL' => '/personas'))?>	
	
	<?php echo $frm->end();?>
</div>
