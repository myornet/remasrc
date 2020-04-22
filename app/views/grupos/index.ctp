<?php echo $this->renderElement('maquetado/menu_seguridad')?>
<h2 class="titulo_modulo">ADMINISTRACION DE GRUPOS</h2>
<table>
	<tr>
		<td colspan="5" style="text-align: right;"><?php echo $controles->botonGenerico('add','controles/application_form_add.png','AGREGAR GRUPO')?></td>
	</tr>
	<tr>
		<th>#</th>
		<th><?php echo $paginator->sort('NOMBRE DEL GRUPO','nombre');?></th>
		<th><?php echo $paginator->sort('ACTIVO','activo');?></th>
		<th></th>
		<th></th>
	</tr>
	<?php foreach ($grupos as $grupo):?>
		<tr>
			<td><?php echo $grupo['Grupo']['id']; ?></td>
			<td><strong><?php echo $grupo['Grupo']['nombre']; ?></strong></td>
			<td align="center"><?php echo $controles->onOff($grupo['Grupo']['activo']); ?></td>
			<td class="actions"><?php echo $controles->getAcciones($grupo['Grupo']['id'],false) ?></td>
			<td><?php echo $controles->botonGenerico('permisos/'.$grupo['Grupo']['id'],'controles/lock_edit.png')?></td>
		</tr>
	<?php endforeach;?>
</table>
