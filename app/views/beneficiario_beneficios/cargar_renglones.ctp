<?php 

if(!empty($ERROR)){
	echo $this->renderElement('msg',array('msg' => array('ERROR' => $ERROR)));
}

?>
<?php if(!empty($renglones)):?>

	<table>
	
		<tr>
			<th></th>
			<th>BENEFICIARIO</th>
			<th>PRODUCTO</th>
			<th>CANTIDAD</th>
			<th>IMPORTE</th>
			<th>PERMANENTE</th>
			<th>FECHA HASTA</th>
			<th>OBSERVACIONES</th>
		
		</tr>
		<?php foreach($renglones as $key => $renglon):?>
		
			<tr>
			
				<td><?php echo $controles->linkAjax($html->image('controles/12-em-cross.png'),'cargar_renglones_remover/'.$key,'grilla_renglones',null,'Quitar este Renglon?')?></td>
				<td><strong><?php echo $renglon['BeneficiarioBeneficioDetalle']['persona']?></strong></td>
				<td><strong><?php echo $util->globalDato($renglon['BeneficiarioBeneficioDetalle']['codigo_producto'])?></strong></td>
				<td style="text-align: center;"><?php echo $renglon['BeneficiarioBeneficioDetalle']['cantidad']?></td>
				<td style="text-align: right;"><?php echo $util->nf($renglon['BeneficiarioBeneficioDetalle']['importe'])?></td>
				<td style="text-align: center;"><?php echo (isset($renglon['BeneficiarioBeneficioDetalle']['permanente']) ? "SI" : "" )?></td>
				<td style="text-align: center;"><?php echo (isset($renglon['BeneficiarioBeneficioDetalle']['permanente']) ? $renglon['BeneficiarioBeneficioDetalle']['fecha_hasta']['day']."-".$renglon['BeneficiarioBeneficioDetalle']['fecha_hasta']['month']."-".$renglon['BeneficiarioBeneficioDetalle']['fecha_hasta']['year'] : "" )?></td>
				<td><?php echo $renglon['BeneficiarioBeneficioDetalle']['observaciones']?></td>
			
			</tr>
		
		<?php endforeach;?>
	
	</table>
	<?php echo $frm->hidden('BeneficiarioBeneficioDetalle.renglonesSerialize', array('value' => base64_encode(serialize($renglones))))?>
<?php endif;?>