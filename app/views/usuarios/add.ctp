<?php echo $this->renderElement('maquetado/menu_seguridad')?>
<h2 class="titulo_modulo">ADMINISTRACION DE USUARIOS</h2>

<?php echo $frm->create('Usuario',array('action' => 'add'));?>

<div class="areaDatoForm">

	<h3>AGREGAR USUARIO</h3>
	<table class="tbl_form">
		<tr>
			<td>USUARIO (sin espacios en blanco)</td>
			<td><?php echo $frm->input('usuario',array('size'=>10,'maxlength'=>10));?></td>
		</tr>
		<tr>
			<td>NOMBRE COMPLETO</td>
			<td><?php echo $frm->input('descripcion',array('size'=>50,'maxlength'=>50));?></td>
		</tr>
		<tr>
			<td>PERFIL</td>
			<td><?php echo $frm->input('perfil',array('type' => 'select', 'options' => $perfiles));?></td>
		</tr>
		<tr>
			<td>CENTRO DE ATENCION</td>
			<td><?php echo $frm->input('centro_id',$centros);?></td>
		</tr>

		<tr>
			<td>ACTIVO</td>
			<td><?php echo $frm->input('activo');?></td>
		</tr>					
	</table>
</div>
<?php echo $frm->input('id');?>	
<?php echo $frm->btnGuardarCancelar(array('URL' => '/usuarios'))?>