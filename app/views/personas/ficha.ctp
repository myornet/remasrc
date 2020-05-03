<!-- Datos de la persona -->
<h2 class="title">DATOS DE LA PERSONA</h2>
<div class="box">
	<article class="media">
		<div class="media-content">
			<div class="content">
				<h3 class="title"><?php echo $persona['Persona']['apenom'] ?></h3>
				<h4 class="subtitle"><?php echo $persona['Persona']['tdocndoc'] ?></h4>
			</div>
		</div>
	</article>
</div>

<div class="tile is-ancestor">
	<div class="tile is-parent">
		<div class="tile is-child box">
			<h4 class="title">FICHA DE DATOS</h4>
			<p>
				<strong>CUIT / CUIL:</strong> <span class="info"><?php echo $persona['Persona']['cuit_cuil']?></span>
				<br>
				<strong>FECHA NACIMIENTO:</strong> <span class="info"><?php echo $util->armaFecha($persona['Persona']['fecha_nacimiento'])?></span>
				<br>	
				<strong>TELEFONO FIJO:</strong> <span class="info"><?php echo $persona['Persona']['telefono_fijo']?></span>
				<br>
				<strong>CELULAR:</strong> <span class="info"><?php echo $persona['Persona']['telefono_movil']?></span>	
				<br>
				<strong>MENSAJES:</strong> <span class="info"><?php echo $persona['Persona']['telefono_mensajes']?></span>
				<br>
				<strong>EMAIL:</strong> <span class="info"><?php echo $persona['Persona']['email']?></span>
				<br>
				<strong>CALLE:</strong> <span class="info"><?php echo $persona['Persona']['calle']?></span> - 
				<strong>Nº</strong> <span class="info"><?php echo $persona['Persona']['numero']?></span> 
				<br>
				<strong>BARRIO:</strong> <span class="info"><?php echo $persona['Persona']['barrio_d']?></span> 
				<br>
				<?php echo LOCALIDAD?> (CP <?php ECHO CP?>) - <?php echo PROVINCIA?>
			</p>
		</div>
	</div>
	<div class="tile is-parent is-8">
		<div class="tile is-child box">
			<h4 class="title">DETALLES PERSONALES</h4>
			<p>
				<strong>DISCAPACIDAD:</strong> <span class="info"><?php echo $persona['Persona']['tipo_discapacidad_d']?></span>
				<br>
				<strong>NIVEL DE INSTRUCCION:</strong> <span class="info"><?php echo $persona['Persona']['tipo_nivel_instruccion_d']?></span>
				<br>
				<strong>PROFESION/OFICIO:</strong> <span class="info"><?php echo $persona['Persona']['tipo_ocupacion_oficio_d']?></span>
				<br>
				<strong>INSTITUCION:</strong> <span class="info"><?php echo ($persona['Persona']['institucion_anio_grado_d'] ? $persona['Persona']['institucion_anio_grado_d'] : "")?></span>
				<br>
				<strong>OCUPACION ACTUAL:</strong> <span class="info"><?php echo $persona['Persona']['tipo_ocupacion_oficio_actual_d']?></span>
				<br>
				<strong>INGRESOS:</strong> <span class="info"><?php echo $util->nf($persona['Persona']['ingresos'])?></span>
				<br>
				<strong>COBERTURA MEDICA:</strong> <span class="info"><?php echo $persona['Persona']['tipo_cobertura_medica_d']?></span>
			</p>
		</div>
	</div>
</div>
	
<?php if(!empty($datosRed)):?>
<?php //debug($datosRed) ?>
	
<h3 class="title">RED DE MUNICIPIOS</h3>
<div class="table-container">
	<table class="table is-striped">
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
</div>
	
<?php endif;?>

<h3 class="title">HISTORICO DE CONSUMOS DE PRODUCTOS Y/O SERVICIOS</h3>
<?php if(!empty($consumos)):?>
<div class="table-container">
	<table class="table is-striped">
		<thead>
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
		</thead>
		
		<tbody>
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
		</tbody>
	
	</table>
</div>

<?php else:?>
<div class="notification is-warning">
	NO POSEE ORDENES DE CONSUMO
</div>
<?php endif;?>	

<?php //debug($consumos) ?>