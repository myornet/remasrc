<?php echo $this->renderElement('maquetado/menu_seguridad')?>
<h2 class="titulo_modulo">ADMINISTRACION DE CENTROS DE ATENCION</h2>
<div class="actions">
<?php echo $controles->botonGenerico('add','controles/application_form_add.png','AGREGAR CENTRO DE ATENCION')?>
</div>
<?php echo $this->renderElement('paginado')?>
<table>
	<tr>
		<th></th>
		<th>#</th>
		<th><?php echo $paginator->sort('NOMBRE','descripcion');?></th>
		<th><?php echo $paginator->sort('DOMICILIO','domicilio');?></th>
		<th>TELEFONOS</th>
		<th>RESPONSABLE</th>
		<th>EMAIL</th>	
		<th><?php echo $paginator->sort('ACTIVO','activo');?></th>		
		
	</tr>
	<?php foreach ($centros as $centro):?>
		<tr>
			<td class="actions"><?php echo $controles->getAcciones($centro['Centro']['id'],false) ?></td>
			<td><?php echo $centro['Centro']['id']; ?></td>
			<td><strong><?php echo $centro['Centro']['descripcion']; ?></strong></td>
			<td><?php echo $centro['Centro']['domicilio']; ?></td>
			<td><?php echo $centro['Centro']['telefonos']; ?></td>
			<td><?php echo $centro['Centro']['responsable']; ?></td>
			<td><?php echo $text->autoLinkEmails($centro['Centro']['email'])?></td>
			<td align="center"><?php echo $controles->onOff($centro['Centro']['activo']); ?></td>
			
		</tr>
	<?php endforeach;?>
</table>
<?php echo $this->renderElement('paginado')?>

