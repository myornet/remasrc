<?php echo $this->renderElement('maquetado/menu_seguridad')?>
<h2 class="titulo_modulo">ADMINISTRACION DE CENTROS DE ATENCION</h2>
<?php echo $frm->create('Centro',array('action' => 'edit'));?>

<div class="areaDatoForm">
	<h3>MODIFICAR DATOS DEL CENTRO DE ATENCION</h3>
	<table class="tbl_form">
		<tr>
			<td>NOMBRE</td>
			<td><?php echo $frm->input('descripcion',array('size'=>30,'maxlength'=>30));?></td>
		</tr>
		<tr>
			<td>DOMICILIO</td>
			<td><?php echo $frm->input('domicilio',array('size'=>60,'maxlength'=>60));?></td>
		</tr>
		<tr>
			<td>TELEFONOS</td>
			<td><?php echo $frm->input('telefonos',array('size'=>60,'maxlength'=>60));?></td>
		</tr>
		<tr>
			<td>RESPONSABLE</td>
			<td><?php echo $frm->input('responsable',array('size'=>60,'maxlength'=>60));?></td>
		</tr>
		<tr>
			<td>EMAIL</td>
			<td><?php echo $frm->input('email',array('size'=>60,'maxlength'=>60));?></td>
		</tr>								
		<tr>
			<td>ACTIVO</td>
			<td><?php echo $frm->input('activo');?></td>
		</tr>					
	</table>
</div>
<?php echo $frm->input('id');?>	
<?php echo $frm->btnGuardarCancelar(array('URL' => '/centros'))?>
<?php if(!empty($centro['Usuario'])):?>
	<br/>
	<table>
		<tr>
			<th colspan="5">USUARIOS PERTENECIENTES A ESTE CENTRO DE ATENCION</th>
		</tr>
		<tr>
			<th>#</th>
			<th>USUARIO</th>
			<th>DESCRIPCION</th>
			<th>GRUPO</th>
			<th>ACTIVO</th>
		</tr>
		<?php foreach ($centro['Usuario'] as $usuario):?>
			<tr>
				<td><?php echo $usuario['id']; ?></td>
				<td><strong><?php echo $usuario['usuario']; ?></strong></td>
				<td><?php echo $usuario['descripcion']; ?></td>
				<td><?php echo $usuario['Grupo']['nombre']; ?></td>
				<td align="center"><?php echo $controles->btnAjaxToggleOnOff('/usuarios/setActivoOnOff/activo/'.$usuario['id'],$usuario['activo'],"Habilitar el Acceso del Usuario: " . $usuario['usuario'],"Bloquear el Acceso del Usuario: " . $usuario['usuario'])?></td>
			</tr>
		<?php endforeach;?>
	</table>

<?//php debug($grupo['Usuario'])?>

<?php endif;?>