<?php echo $this->renderElement('beneficiarios/menu_padron',array('beneficiario_id' => $beneficiario_id))?>
<h2>MODIFICAR VENCIMIENTO PRODUCTO / SERVICIO PERMANENTE</h2>
<?php echo $frm->create(null,array('action' => 'vencimiento_consumo/' . $renglon['BeneficiarioBeneficioDetalle']['id']))?>
<div class="areaDatoForm">

	<table class="tbl_form">
		<tr>
			<td>VENCIMIENTO ACTUAL</td>
			<td style="font-size: 14px;color: red;"><strong><?php echo $util->armaFecha($renglon['BeneficiarioBeneficioDetalle']['fecha_hasta'])?></strong></td>
		</tr>
		<tr>
			<td>NUEVA FECHA</td>
			<td><?php echo $frm->calendar('BeneficiarioBeneficioDetalle.fecha_hasta','',date('Y-m-d'),date('Y'),date('Y') + 1)?></td>
		</tr>			
	</table>

</div>
<?php echo $frm->hidden('BeneficiarioBeneficioDetalle.id',array('value' => $renglon['BeneficiarioBeneficioDetalle']['id']));?>
<?php echo $frm->hidden('BeneficiarioBeneficioDetalle.fecha_actual',array('value' => $renglon['BeneficiarioBeneficioDetalle']['fecha_hasta']));?>
<?php echo $frm->btnGuardarCancelar(array('TXT_GUARDAR' => 'MODIFICAR VENCIMIENTO','URL' => '/beneficiario_beneficios/index/'.$beneficiario_id))?>
