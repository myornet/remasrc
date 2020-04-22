<?php echo $this->renderElement('maquetado/menu_seguridad')?>
<h2 class="titulo_modulo">WEB SERVICE - ADMINISTRACION DE CONEXIONES</h2>
<div class="actions">
<?php echo $controles->botonGenerico('add','controles/enlaces.gif','AGREGAR CONEXION')?>
</div>

<?php if(!empty($conexiones)):?>
<?php echo $this->renderElement('paginado')?>
	<table>
		<tr>
			<th></th>
			<th>#</th>
			<th><?php echo $paginator->sort('MUNICIPALIDAD','municipalidad');?></th>
			<th><?php echo $paginator->sort('DOMICILIO','domicilio');?></th>
			<th>TELEFONOS</th>
			<th>RESPONSABLE</th>
			<th>EMAIL</th>	
			<th><?php echo $paginator->sort('ACTIVO','activo');?></th>
			<th>APLICACION REMAS REMOTA</th>
			<th>PIN ACCESO REMOTO</th>
			<th>PIN ACCESO LOCAL</th>	
			<th></th>	
			
		</tr>
		<?php foreach ($conexiones as $conexion):?>
			<tr>	
				<td class="actions" nowrap="nowrap"><?php echo $controles->getAcciones($conexion['Conexion']['id'],false) ?></td>
				<td><?php echo $conexion['Conexion']['id']; ?></td>
				<td><strong><?php echo $conexion['Conexion']['municipalidad']; ?></strong></td>
				<td><?php echo $conexion['Conexion']['domicilio']; ?></td>
				<td><?php echo $conexion['Conexion']['telefonos']; ?></td>
				<td><?php echo $conexion['Conexion']['responsable']; ?></td>
				<td><?php echo $text->autoLinkEmails($conexion['Conexion']['email'])?></td>
				<td align="center"><?php echo $controles->btnAjaxToggleOnOff('setActivoOnOff/activo/'.$conexion['Conexion']['id'],$conexion['Conexion']['activo'],"Habilitar la conexion Remora a: " . $conexion['Conexion']['municipalidad'],"Deshabilitar la conexion remota a: " . $conexion['Conexion']['municipalidad'])?></td>
				<td><?php echo $text->autoLinkUrls($conexion['Conexion']['app_remas_remoto'],array('target' => '_blank')); ?></td>
				<td align="center" style="font-size:large;color: navy;font-family: monospace;"><?php echo $conexion['Conexion']['pin_remoto']; ?></td>
				<td align="center" style="font-size: large;color: purple;font-family: monospace;" id="pinLocal<?php echo $conexion['Conexion']['id']?>"><?php echo $conexion['Conexion']['pin_local']; ?></td>
				<td>
					<?php echo $controles->btnAjaxUpdater("controles/16-security-key.png","reset_pin_local/".$conexion['Conexion']['id']."/".$conexion['Conexion']['pin_local'],"pinLocal".$conexion['Conexion']['id'],null,"Regenerar el PIN LOCAL de: " .$conexion['Conexion']['municipalidad'])?>
					<?//php echo $controles->botonGenerico('reset_pin_local/'.$conexion['Conexion']['id'],'controles/16-security-key.png','','',"Regenerar el PIN LOCAL de: " .$conexion['Conexion']['municipalidad'])?>
				</td>
				
			</tr>
		<?php endforeach;?>
	</table>
<?php echo $this->renderElement('paginado')?>
<?php endif;?>