<?php echo $this->renderElement('beneficiarios/menu_padron',array('beneficiario_id' => $orden['BeneficiarioBeneficio']['beneficiario_id']))?>

<div class="areaDatoForm">
	<h2>ORDEN #<?php echo $orden['BeneficiarioBeneficio']['id']?></h2>

	<div class="areaDatoForm2">
	<table class="tbl_form">
	
		<tr><td>FECHA:</td><td><?php echo $util->armaFecha($orden['BeneficiarioBeneficio']['fecha'])?></td></tr>
		<tr><td>TITULAR:</td><td><strong><?php echo $orden['BeneficiarioBeneficio']['titular']?></strong></td></tr>
		<tr><td>EMITIDA EN:</td><td><?php echo $orden['BeneficiarioBeneficio']['centro']?></td></tr>
		<tr><td>USUARIO:</td><td><?php echo $orden['BeneficiarioBeneficio']['user_created'] ." - " . $orden['BeneficiarioBeneficio']['created']?></td></tr>
	
	</table>
	</div>
	<h3>DETALLE DE LA ORDEN</h3>
	
	<table>
	
		<tr>
			<th>PRODUCTO / SERVICIO</th>
			<th>BENEFICIARIO</th>
			<th>CANTIDAD</th>
			<th>IMPORTE</th>
			<th>PERM</th>
			<th>HASTA</th>
			<th>OBSERVACIONES</th>
			
		</tr>
		<?php if(!empty($orden['BeneficiarioBeneficioDetalle'])):?>
			<?php 
			$ACU_TOTAL = 0;
			$ACU_CANTIDAD = 0;			
			?>
			<?php foreach($orden['BeneficiarioBeneficioDetalle'] as $renglon):?>
			
				<tr class="<?php echo ($renglon['permanente'] == 1 ? "rowsel" : "")?>">
					<td nowrap="nowrap"><?php echo $renglon['producto_str']?></td>
					<td nowrap="nowrap"><?php echo $renglon['solicitante_str']?></td>
					<td align="center"><?php echo $renglon['cantidad']?></td>
					<td align="right"><?php echo $util->nf($renglon['importe'])?></td>
					<td align="center"><?php echo ($renglon['permanente'] == 1 ? "SI" : "")?></td>
					<td align="center"><?php echo ($renglon['permanente'] == 1 ? $util->armaFecha($renglon['fecha_hasta']) : "")?></td>
					<td><?php echo $renglon['observaciones']?></td>
				
				</tr>
				
				<?php 
				$ACU_TOTAL += $renglon['importe'];
				$ACU_CANTIDAD += $renglon['cantidad'];				
				?>
			
			<?php endforeach;?>
			<tr>
				<td colspan="2" align="right" style="border-top: 1px solid;"><strong>TOTAL DE LA ORDEN</strong></td>
				<td align="center" style="border-top: 1px solid;"><strong><?php echo $ACU_CANTIDAD?></strong></td>
				<td align="right" style="border-top: 1px solid;"><strong><?php echo $util->nf($ACU_TOTAL)?></strong></td>
				<td colspan="3" style="border-top: 1px solid;"></td>
			</tr>
		
		<?php endif;?>
	
	</table>
	
</div>
<?php echo $controles->botonGenerico('ficha/'.$orden['BeneficiarioBeneficio']['id'].'/1','controles/printer.png','IMPRIMIR ORDEN #' . $orden['BeneficiarioBeneficio']['id'],array('target' => 'blank'));?>