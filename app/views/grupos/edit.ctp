<?php echo $this->renderElement('maquetado/menu_seguridad')?>
<h2 class="titulo_modulo">ADMINISTRACION DE GRUPOS</h2>
<?php echo $frm->create('Grupo',array('action' => 'edit'));?>

<div class="areaDatoForm">
	<h3>MODIFICAR DATOS DEL GRUPO</h3>
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
<?php if(!empty($grupo['Usuario'])):?>
	<br/>
	<table>
		<tr>
			<th colspan="5">USUARIOS PERTENECIENTES A ESTE GRUPO</th>
		</tr>
		<tr>
			<th>#</th>
			<th>USUARIO</th>
			<th>DESCRIPCION</th>
			<th>CENTRO</th>
			<th>ACTIVO</th>
		</tr>
		<?php foreach ($grupo['Usuario'] as $usuario):?>
			<tr>
				<td><?php echo $usuario['id']; ?></td>
				<td><strong><?php echo $usuario['usuario']; ?></strong></td>
				<td><?php echo $usuario['descripcion']; ?></td>
				<td><?php echo $usuario['Centro']['descripcion']; ?></td>
				<td align="center"><?php echo $controles->onOff($usuario['activo']); ?></td>
			</tr>
		<?php endforeach;?>
	</table>

<?//php debug($grupo['Usuario'])?>

<?php endif;?>