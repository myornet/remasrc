<h2 class="titulo_modulo" style="color: maroon;border-bottom: 1px solid;padding: 3px;"><?php echo $muniRemota?></h2>

<div id="ficha">
	
	<div id="ficha-datos">
		
		DOCUMENTO:<span class="info"><?php echo $oPersonaRemota->tipo_documento?> <?php echo $oPersonaRemota->documento?></span>&nbsp;&nbsp;APELLIDO Y NOMBRE:<span class="info"><?php echo $oPersonaRemota->apenom?></span>
		
		<br/>

		CUIT / CUIL:<span class="info"><?php echo $oPersonaRemota->cuit_cuil?></span>&nbsp;&nbsp;FECHA NACIMIENTO:<span class="info"><?php echo $oPersonaRemota->fecha_nacimiento?></span>
		
		<br/>
		
		TELEFONO FIJO:<span class="info"><?php echo $oPersonaRemota->telefono_fijo?></span>&nbsp;&nbsp;CELULAR: <span class="info"><?php echo $oPersonaRemota->telefono_movil?></span>
		
		<br/>
		
		MENSAJES:<span class="info"><?php echo $oPersonaRemota->telefono_mensajes?></span>&nbsp;&nbsp;EMAIL:<span class="info"><?php echo $oPersonaRemota->email?></span>
		
		<br/>
		
		DOMICILIO:<span class="info"><?php echo $oPersonaRemota->domicilio?></span>
	
	</div>

	<div id="ficha-etiqueta">CONSUMOS DE PRODUCTOS Y/O SERVICIOS REGISTRADOS EN LOS ULTIMOS <?php echo $oPersonaRemota->dias_corte_registro_consumos?> DIAS (DESDE EL <?php echo $oPersonaRemota->fecha_corte_registro_consumos?>)</div>
		<?php if(!empty($oPersonaRemota->registro_consumos)):?>
		<table>
		
			<tr>
				<th>BENEFICIO</th>
				<th>TITULAR DEL BENEFICIO</th>
				<th>ORD.</th>
				<th>FECHA</th>
				<th>FECHA HASTA</th>
				<th>PRODUCTO / SERVICIO</th>
				<th>CANTIDAD</th>
				<th>VALOR</th>
			</tr>
			
			<?php foreach($oPersonaRemota->registro_consumos as $beneficio):?>
		
				<tr class="<?php echo ($beneficio->vencido == 1 ? "productoVencido" : "")?>">
					<td align="center"><?php echo $beneficio->beneficio_nro?></td>
					<td><strong><?php echo $beneficio->titular?></strong></td>
					<td align="center"><?php echo $beneficio->orden_nro?></td>
					<td align="center"><?php echo $beneficio->fecha?></td>
					<td align="center"><?php echo $beneficio->vigente_hasta?></td>
					<td><?php echo $beneficio->producto?></td>
					<td align="center"><?php echo $beneficio->cantidad?></td>
					<td align="right"><?php echo $beneficio->importe?></td>
				</tr>
		
			<?php endforeach;?>
		
		</table>
		<?php else:?>
		
			*** NO POSEE ORDENES DE CONSUMO ***
		
		<?php endif;?>	
	
	<?//php debug($consumos)?>
	
</div>
<?//php debug($oPersonaRemota)?>