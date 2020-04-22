<h2 class="modulo">CAMBIO CLAVE USUARIO</h2>

<?php echo $frm->create('Usuario',array('action' => 'password'));?>

<div class="areaDatoForm">

	<table class="tbl_form">
		<tr>
			<td>CONTRASE&Ntilde;A ANTERIOR</td>
			<td><input type="password" name="data[Usuario][old_password]"/></td>
		</tr>
		<tr>
			<td>NUEVA CONTRASE&Ntilde;A</td>
			<td><input type="password" name="data[Usuario][new_password]"/></td>
		</tr>
		<tr>
			<td>REPETIR NUEVA CONTRASE&Ntilde;A</td>
			<td><input type="password" name="data[Usuario][new_password_confirm]"/></td>
		</tr>
		<tr>
			<td colspan="2"><?php echo $frm->submit("GUARDAR");?></td>
		</tr>				
	</table>
<?//php DEBUG($user)?>
</div>
<?php echo $frm->end();?>
