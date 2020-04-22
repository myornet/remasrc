<?php echo $this->renderElement('beneficiarios/menu_padron',array('beneficiario_id' => $beneficiario_id))?>
<h2>REGISTRO DE NOVEDADES :: ALTA DE NOVEDAD</h2>
<?php echo $form->create(null,array('type' => 'file','action' => 'nueva_novedad/' . $beneficiario_id, 'onsubmit' => "return confirm('DAR DE ALTA LA NOVEDAD?')"));?>
<div class="areaDatoForm">

	<table class="tbl_form">
		<tr>
			<td>FECHA</td><td><?php echo date("d-m-Y")?></td>
		</tr>
		<tr>
			<td>EMITIDA POR</td><td><strong><?php echo $user['Usuario']['usuario']?></strong> - <?php echo $user['Centro']['descripcion']?></td>
		</tr>
		<tr>
			<td>NOVEDAD</td><td><?php echo $frm->textarea('BeneficiarioNovedad.novedad',array('cols' => 75, 'rows' => 6))?></td>
		</tr>
		<tr>
			<td>ADJUNTAR</td><td><?php echo $frm->input('BeneficiarioNovedad.fileUp',array('type'=>'file','size' => 40,'maxlength' => 40));?></td>
		</tr>
		<tr>
			<td></td>
			<td style="font-size: xx-small;">SOLAMENTE ARCHIVOS .jpg | TAMA&Ntilde;O MAXIMO PARA LA IMAGEN PERMITIDO 500 Kb</td>
		</tr>		
							
	</table>

</div>
<?php echo $frm->hidden('BeneficiarioNovedad.id',array('value' => 0))?>
<?php echo $frm->hidden('BeneficiarioNovedad.fecha',array('value' => date("Y-m-d")))?>
<?php echo $frm->hidden('BeneficiarioNovedad.beneficiario_id',array('value' => $beneficiario_id))?>
<?php echo $frm->hidden('BeneficiarioNovedad.usuario',array('value' => $user['Usuario']['usuario']))?>
<?php echo $frm->hidden('BeneficiarioNovedad.centro_atencion',array('value' => $user['Centro']['descripcion']))?>
<?php echo $frm->hidden('BeneficiarioNovedad.alta_centro_id',array('value' => $user['Centro']['id']))?>
<?php echo $frm->btnGuardarCancelar(array('URL' => '/beneficiarios/novedades/'.$beneficiario_id))?>	
