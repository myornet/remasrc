<?php echo $this->renderElement('beneficiarios/menu_padron',array('beneficiario_id' => $beneficiario_id))?>

<div>
<?php if($user['Usuario']['perfil'] > 1 && $beneficiario['Beneficiario']['estado'] == 1) echo $controles->botonGenerico('cargar_consumo/'.$beneficiario_id,'controles/cart_add.png','CARGAR NUEVO CONSUMO');?>
<?php if($user['Usuario']['perfil'] == 3 && $beneficiario['Beneficiario']['estado'] == 1 && (!empty($renglonesPermanentes) || !empty($renglones))) echo "&nbsp;|&nbsp;" . $controles->botonGenerico('reasignar_consumos/'.$beneficiario_id,'controles/chart_organisation.png','REASIGNAR CONSUMOS');?>

</div>
<?php if(!empty($renglonesPermanentes)):?>

	<h2>PRODUCTOS Y/O SERVICIOS PERMANENTES</h2>
	<table>
	
		<tr>
			<th>ORD.</th>
			<th></th>
			<th></th>
			<th>TITULAR</th>
			<th>FECHA DESDE</th>
			<th>FECHA HASTA</th>
			<th>PRODUCTO / SERVICIO</th>
			<th>BENEFICIARIO</th>
			<th>CANTIDAD</th>
			<th>VALOR</th>
			<th>OBSERVACIONES</th>
			<th>EMITIDA EN</th>
			<th>USUARIO</th>
		</tr>
		
		<?php foreach($renglonesPermanentes as $renglonesPermanente):?>
	
			<tr class="<?php echo ($renglonesPermanente['vencido'] == 1 ? "productoVencido" : "")?>">
				<td align="center"><?php echo $html->link($renglonesPermanente['orden_nro_str'],'ficha/'.$renglonesPermanente['beneficiario_beneficio_id'])?></td>
				<td><?php if($user['Usuario']['perfil'] == 3 && $beneficiario['Beneficiario']['estado'] == 1) echo $controles->botonGenerico('borrar_consumo/'.$renglonesPermanente['beneficiario_beneficio_id'],'controles/user-trash.png','',null,"BORRAR DEFINITVAMENTE LA ORDEN #".$renglonesPermanente['beneficiario_beneficio_id']."?")?></td>
				<td><?php if($user['Usuario']['perfil'] == 3 && $beneficiario['Beneficiario']['estado'] == 1 && $renglonesPermanente['vencido'] == 0) echo $controles->botonGenerico('vencimiento_consumo/'.$renglonesPermanente['id'],'controles/calendar_2.png')?></td>
				<td nowrap="nowrap" align="center"><?php echo $html->link($renglonesPermanente['orden_titular_str'],'/personas/ficha/' . $renglonesPermanente['orden_titular_persona_id'],array('target' => '_blank')) ?></td>
				<td align="center"><?php echo $renglonesPermanente['orden_fecha_str']?></td>
				<td align="center"><strong><?php echo $util->armaFecha($renglonesPermanente['fecha_hasta'])?></strong></td>
				<td><?php echo $renglonesPermanente['producto_str']?></td>
				<td nowrap="nowrap"><strong><?php echo $html->link($renglonesPermanente['solicitante_str'],'/personas/ficha/' . $renglonesPermanente['persona_id'],array('target' => '_blank')) ?></strong></td>
				<td align="center"><?php echo $renglonesPermanente['cantidad']?></td>
				<td align="right"><?php echo $util->nf($renglonesPermanente['importe'])?></td>
				<td><?php echo $renglonesPermanente['observaciones']?></td>
				<td><?php echo $renglonesPermanente['orden_emitida_str']?></td>
				<td><?php echo $renglonesPermanente['user_created'] ." - " . $renglonesPermanente['created']?></td>
			</tr>
	
		<?php endforeach;?>
	
	</table>

<?php endif;?>

<br/>
<h2>HISTORICO DE CONSUMOS DE PRODUCTOS Y/O SERVICIOS</h2>



<?php if(!empty($renglones)):?>


	<?//php debug($renglones)?>
	
	
	<table>
	
		<tr>
			<th>ORD.</th>
			<th></th>
			<th>TITULAR</th>
			<th>FECHA</th>
			<th>PRODUCTO / SERVICIO</th>
			<th>BENEFICIARIO</th>
			<th>CANTIDAD</th>
			<th>VALOR</th>
			<th>OBSERVACIONES</th>
			<th>EMITIDA EN</th>
			<th>USUARIO</th>
		</tr>
		
		<?php foreach($renglones as $renglon):?>
	
			<tr>
<!--				<td align="center"><?//php if($user['Usuario']['perfil'] == 3) echo $controles->botonGenerico('borrar_consumo/'.$beneficio['BeneficiarioBeneficio']['id'],'controles/user-trash.png','',null,"BORRAR DEFINITVAMENTE?")?></td>-->
				<td align="center"><?php echo $html->link($renglon['orden_nro_str'],'ficha/'.$renglon['beneficiario_beneficio_id'])?></td>
				<td><?php if($user['Usuario']['perfil'] == 3 && $beneficiario['Beneficiario']['estado'] == 1) echo $controles->botonGenerico('borrar_consumo/'.$renglon['beneficiario_beneficio_id'],'controles/user-trash.png','',null,"BORRAR DEFINITVAMENTE LA ORDEN #".$renglon['beneficiario_beneficio_id']."?")?></td>
				<td><?php echo $html->link($renglon['orden_titular_str'],'/personas/ficha/' . $renglon['orden_titular_persona_id'],array('target' => '_blank')) ?></td>
				
				<td align="center"><?php echo $renglon['orden_fecha_str']?></td>
				<td><?php echo $renglon['producto_str']?></td>
				<td><strong><?php echo $html->link($renglon['solicitante_str'],'/personas/ficha/' . $renglon['persona_id'],array('target' => '_blank')) ?></strong></td>
				<td align="center"><?php echo $renglon['cantidad']?></td>
				<td align="right"><?php echo $util->nf($renglon['importe'])?></td>
				<td><?php echo $renglon['observaciones']?></td>
				<td><?php echo $renglon['orden_emitida_str']?></td>
				<td align="center"><?php echo $renglon['user_created'] ." - " . $renglon['created']?></td>
			</tr>
	
		<?php endforeach;?>
	
	</table>
	
	<?//php debug($beneficios)?>

<?php endif;?>