<?php echo $this->renderElement('beneficiarios/menu_padron',array('beneficiario_id' => $beneficiario_id))?>
<h2>ESTADO DEL BENEFICIO</h2>
<div class="areaDatoForm">
<?php 

	if($beneficiario['Beneficiario']['estado'] == 1) $btnLabel = "DAR DE BAJA";
	else $btnLabel = "DAR DE ALTA";

?>

<?php echo $frm->create(null,array('action' => 'modificar_estado/' . $beneficiario_id,'onsubmit' => "return confirm('".$btnLabel."?')"));?>

<table class="tbl_form">
	<tr>
		<td>ESTADO ACTUAL</td>
		<td>
		<?php if($beneficiario['Beneficiario']['estado'] == 1):?>
			<span style="color: green;font-size: 14px; font-weight: bold;">VIGENTE</span>
		<?php else:?>
			<span style="color: red;font-size: 14px; font-weight: bold;">NO VIGENTE (<?php echo $util->armaFecha($beneficiario['Beneficiario']['fecha_baja'])?>)</span>	
		<?php endif;?>		
		</td>
	</tr>
</table>
<?php echo $frm->hidden('id',array('value' => $beneficiario_id))?>
<?php echo $frm->hidden('estado',array('value' => ($beneficiario['Beneficiario']['estado'] == 1 ? 0 : 1)))?>
<?php if($user['Usuario']['perfil'] == 3) echo $frm->end($btnLabel);?>
</div>

