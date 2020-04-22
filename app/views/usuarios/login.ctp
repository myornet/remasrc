<script type="text/javascript">
window.onload=function(){document.getElementById('UsuarioUsuario').focus();};
</script>
<?php echo $frm->create('Usuario',array('action' => 'login'));?>
<table style="margin: 0 auto;width: auto;" class="tbl_form">
	<tr>
		<td style="text-align: right;">USUARIO</td><td><input type="text" id="UsuarioUsuario" name="data[Usuario][usuario]" value="<?php echo (isset($this->data['Usuario']['usuario']) ? $this->data['Usuario']['usuario'] : '')?>"/></td>
	</tr>
	<tr>
		<td style="text-align: right;">CONTRASE&Ntilde;A</td><td><input type="password" name="data[Usuario][password]"/></td>
	</tr>
	<tr>
		<td colspan="2" align="center"></td>
	</tr>	
	<tr>
		<td colspan="2" style="text-align: center;"><input type="submit" value="INGRESAR"/></td>
	</tr>

</table>

<?php echo $frm->end();?>