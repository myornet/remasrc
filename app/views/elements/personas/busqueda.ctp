<div class="areaDatoForm">
	<?php echo $frm->create("Persona",array('action' => 'index'));?>
	<table class="tbl_form">
		<tr>
			<td>TIPO</td>
			<td>
				<?php 
				echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSTDOC','empty' => true, 'selected' => "",'model' => 'Persona.tipo_documento'));
				?>
			</td>
			<td><?php echo $frm->number('documento',array('size'=>11,'maxlength'=>11));?></td>
			<td>APELLIDO</td><td><?php echo $frm->input('apellido',array('size'=>20,'maxlenght'=>50));?></td>
			<td>NOMBRE</td><td><?php echo $frm->input('nombre',array('size'=>20,'maxlenght'=>50));?></td>
			<td><input type="submit" value="?" /></td>
			<td></td>
			<td><?php if($user['Usuario']['perfil'] == 3) echo $frm->boton(array('URL' => '/personas/alta_titular','LABEL' => 'NUEVO'))?></td>
		</tr>
	</table>
	<?php echo $frm->end();?>
</div>