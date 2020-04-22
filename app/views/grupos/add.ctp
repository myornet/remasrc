<?php echo $this->renderElement('maquetado/menu_seguridad')?>
<h2 class="titulo_modulo">ADMINISTRACION DE GRUPOS</h2>
<?php echo $frm->create('Grupo',array('action' => 'add'));?>

<div class="areaDatoForm">
	<h3>AGREGAR NUEVO GRUPO</h3>
	<table class="tbl_form">
		<tr>
			<td>NOMBRE DEL GRUPO</td>
			<td><?php echo $frm->input('nombre',array('size'=>30,'maxlength'=>30));?></td>
		</tr>
		<tr>
			<td>ACTIVO</td>
			<td><?php echo $frm->input('activo');?></td>
		</tr>					
	</table>
</div>
<?php echo $frm->input('id');?>	
<?php echo $frm->btnGuardarCancelar(array('URL' => '/grupos'))?>
