<?php echo $this->renderElement('maquetado/menu_seguridad')?>
<h2 class="titulo_modulo">ADMINISTRACION DE USUARIOS</h2>
<div class="actions">
<?php echo $controles->botonGenerico('add','controles/application_form_add.png','AGREGAR USUARIO')?>
</div>
<table>
	<tr>
		<th></th>
		<th>#</th>
		<th><?php echo $paginator->sort('USUARIO','usuario');?></th>
		<th><?php echo $paginator->sort('DESCRIPCION','descripcion');?></th>
		<th><?php echo $paginator->sort('PERFIL','perfil');?></th>
		<th><?php echo $paginator->sort('CENTRO','Centro.descripcion');?></th>
		<th><?php echo $paginator->sort('ACTIVO','activo');?></th>
		<th>CLAVE</th>
		
	</tr>
	<?php foreach ($usuarios as $usuario):?>
		<tr class="<?php echo ($usuario['Usuario']['perfil'] == 3 ? "rowsel" : "")?>">
			<td class="actions"><?php echo $controles->getAcciones($usuario['Usuario']['id'],false) ?></td>
			<td><?php echo $usuario['Usuario']['id']; ?></td>
			<td><strong><?php echo $usuario['Usuario']['usuario']; ?></strong></td>
			<td><?php echo $usuario['Usuario']['descripcion']; ?></td>
			<td><?php echo $perfiles[$usuario['Usuario']['perfil']]; ?></td>
			<td><?php echo $usuario['Centro']['descripcion']; ?></td>
			<td align="center"><?php echo $controles->btnAjaxToggleOnOff('setActivoOnOff/activo/'.$usuario['Usuario']['id'],$usuario['Usuario']['activo'],"Habilitar el Acceso del Usuario: " . $usuario['Usuario']['usuario'],"Bloquear el Acceso del Usuario: " . $usuario['Usuario']['usuario'])?></td>
			<td align="center"><?php echo $controles->botonGenerico('reset_pws/'.$usuario['Usuario']['id'],'controles/16-security-key.png','','',"Resetear la Clave del Usuario: " .$usuario['Usuario']['usuario'])?></td>
			
		</tr>
	<?php endforeach;?>
</table>
