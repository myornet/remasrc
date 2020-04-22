<?php echo $this->renderElement('beneficiarios/menu_padron',array('beneficiario_id' => $beneficiario_id))?>
<h2>REASIGNAR CONSUMOS</h2>
<script type="text/javascript">
function validateForm(){
	var str = "***** ATENCION: ******\n";
	str = str + "REASIGNAR ORDENES:\n\n";
	str = str + "DE:\n" + getTextoSelect("BeneficiarioBeneficioDetallePersonaIdFrom") + "\n\n";
	str = str + "A:\n" + getTextoSelect("BeneficiarioBeneficioDetallePersonaIdTo") + "\n\n";
	str = str + "DESEA CONTINUAR?";
	return confirm(str);
}
</script>
<?php echo $frm->create(null,array('action' => 'reasignar_consumos/' . $beneficiario_id , 'onsubmit' => "return validateForm();"))?>
<div class="areaDatoForm">

	<table class="tbl_form">
		<tr>
			<td>CONSUMOS DE</td>
			<td><?php echo $frm->input('BeneficiarioBeneficioDetalle.persona_id_from',array('type' => 'select', 'options' => $adicionales))?></td>
		</tr>
		<tr>
			<td>ASIGNARLOS A</td>
			<td><?php echo $frm->input('BeneficiarioBeneficioDetalle.persona_id_to',array('type' => 'select', 'options' => $adicionales))?></td>
		</tr>			
	</table>

</div>
<?php echo $frm->hidden('BeneficiarioBeneficioDetalle.beneficiario_id',array('value' => $beneficiario_id));?>
<?php echo $frm->btnGuardarCancelar(array('TXT_GUARDAR' => 'REASIGNAR CONSUMOS','URL' => '/beneficiario_beneficios/index/'.$beneficiario_id))?>