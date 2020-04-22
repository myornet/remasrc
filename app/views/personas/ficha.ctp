<div id="ficha">
	
	<div style="font-family:'lucida grande',verdana,helvetica,arial,sans-serif;color:maroon;font-size: 18px;font-weight: bold;margin-bottom: 15px;margin-top: 15px;">
		<?php echo $persona['Persona']['tdocndoc']?> - <?php echo $persona['Persona']['apenom']?>
	</div>
	
	<div id="ficha-datos">

		CUIT / CUIL:<span class="info"><?php echo $persona['Persona']['cuit_cuil']?></span>&nbsp;&nbsp;FECHA NACIMIENTO:<span class="info"><?php echo $util->armaFecha($persona['Persona']['fecha_nacimiento'])?></span>
		
		<br/>
		
		TELEFONO FIJO:<span class="info"><?php echo $persona['Persona']['telefono_fijo']?></span>&nbsp;&nbsp;CELULAR: <span class="info"><?php echo $persona['Persona']['telefono_movil']?></span>
		
		<br/>
		
		MENSAJES:<span class="info"><?php echo $persona['Persona']['telefono_mensajes']?></span>&nbsp;&nbsp;EMAIL:<span class="info"><?php echo $persona['Persona']['email']?></span>
		
		<br/>
		
		CALLE:<span class="info"><?php echo $persona['Persona']['calle']?></span>&nbsp;&nbsp;NUMERO:<span class="info"><?php echo $persona['Persona']['numero']?></span>&nbsp;&nbsp;BARRIO:<span class="info"><?php echo $persona['Persona']['barrio_d']?></span> <?php echo LOCALIDAD?> (CP <?php ECHO CP?>) - <?php echo PROVINCIA?>
	
		<br/><br/>
	
		DISCAPACIDAD:<span class="info"><?php echo $persona['Persona']['tipo_discapacidad_d']?></span>&nbsp;&nbsp;NIVEL DE INSTRUCCION:<span class="info"><?php echo $persona['Persona']['tipo_nivel_instruccion_d']?></span>
		
		<br/>
		
		PROFESION/OFICIO:<span class="info"><?php echo $persona['Persona']['tipo_ocupacion_oficio_d']?></span>&nbsp;INSTITUCION: <span class="info"><?php echo ($persona['Persona']['institucion_anio_grado_d'] ? $persona['Persona']['institucion_anio_grado_d'] : "")?></span>&nbsp;&nbsp;OCUPACION ACTUAL:<span class="info"><?php echo $persona['Persona']['tipo_ocupacion_oficio_actual_d']?></span>
		<br/>
		INGRESOS:<span class="info"><?php echo $util->nf($persona['Persona']['ingresos'])?></span>
		&nbsp;&nbsp;COBERTURA MEDICA:<span class="info"><?php echo $persona['Persona']['tipo_cobertura_medica_d']?></span>
	
	
	</div>
	<?php if(!empty($datosRed)):?>
		<?//php debug($datosRed)?>
		
		<div id="ficha-etiqueta">RED DE MUNICIPIOS</div>
		<table style="width: 50%">
			<?php foreach($datosRed as $idConn => $obj):?>
				<tr>
					<th style="text-align: left;"><?php echo $obj->client?></th>
				</tr>
				
				<?php if($obj->error == 0):?>
				<tr>
					<td>
						<table>
							<tr class="rowsel">
								<td></td>
								<td style="font-weight: bold;text-align: center;">TIPO - DOCUMENTO</td>
								<td style="font-weight: bold;text-align: center;">APELLIDO Y NOMBRE</td>
								<td style="font-weight: bold;text-align: center;">DOMICILIO</td>
							</tr>
							<?php foreach($obj->result as $oPerRem):?>
								<tr>
									<td><?php echo $controles->botonGenerico('ficha_remota/'.$idConn.'/'.$oPerRem->id,'controles/page_world.png',null,array('target' => 'blank'))?></td>
									<td><?php echo $oPerRem->tipo_documento . " - " . $oPerRem->documento?></td>
									<td><?php echo $oPerRem->apenom?></td>
									<td><?php echo $oPerRem->domicilio?></td>
								</tr>
							<?php endforeach;?>
						</table>
					</td>
				</tr>	
				<?php else:?>
					<tr>
						<td style="color: red;"><?php echo $obj->msg_error?></td>
					</tr>	
				<?php endif;?>
			<?php endforeach;?>
		</table>
		<?//php debug($datosRed)?>
		
		
	<?php endif;?>
	<div id="ficha-etiqueta">HISTORICO DE CONSUMOS DE PRODUCTOS Y/O SERVICIOS</div>
		<?php if(!empty($consumos)):?>
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
				<th>OBSERVACIONES</th>
				<th>ENTREGADO EN</th>
				<th>USUARIO</th>
			</tr>
			
			<?php foreach($consumos as $beneficio):?>
		
				<tr class="<?php echo ($beneficio['vencido'] == 1 ? "productoVencido" : "")?>">
					<td align="center"><?php echo $html->link("#".$beneficio['orden_beneficio_id'],'/beneficiarios/ficha/'.$beneficio['orden_titular_persona_id'],array('target' => '_blank'))?></td>
					<td><strong><?php echo $beneficio['orden_titular_str']?></strong></td>
					<td align="center"><?php echo $html->link($beneficio['orden_nro_str'],'/beneficiario_beneficios/ficha/'.$beneficio['beneficiario_beneficio_id'],array('target' => '_blank'))?></td>
					<td align="center"><?php echo $beneficio['orden_fecha_str']?></td>
					<td align="center"><?php if(!empty($beneficio['fecha_hasta'])) echo $util->armaFecha($beneficio['fecha_hasta'])?></td>
					<td><?php echo $beneficio['producto_str']?></td>
					
					<td align="center"><?php echo $beneficio['cantidad']?></td>
					<td align="right"><?php echo $util->nf($beneficio['importe'])?></td>
					<td><?php echo $beneficio['observaciones']?></td>
					<td><?php echo $beneficio['orden_emitida_str']?></td>
					<td><?php echo $beneficio['user_created'] ." - " . $beneficio['created']?></td>
				</tr>
		
			<?php endforeach;?>
		
		</table>
		<?php else:?>
		
			*** NO POSEE ORDENES DE CONSUMO ***
		
		<?php endif;?>	
	
	<?//php debug($consumos)?>
	
</div>