<h3 class="title">DATOS DEL TITULAR</h3>

<div class="tile is-ancestor">
	<div class="tile is-parent">
		<div class="tile is-child box">
			<h4 class="title">FICHA DE DATOS</h4>
			<p>
				<strong>DOCUMENTO:</strong> <?php echo $beneficiario['Persona']['tdocndoc']?>
				<br/>
				<strong>APELLIDO Y NOMBRE:</strong> <?php echo $beneficiario['Persona']['apenom']?>
				<br/>
				<strong>CUIT / CUIL:</strong> <?php echo $beneficiario['Persona']['cuit_cuil']?>
				<br/>
				<strong>FECHA NACIMIENTO:</strong> <?php echo $util->armaFecha($beneficiario['Persona']['fecha_nacimiento'])?>
				<br/>
				<strong>TELEFONO FIJO:</strong> <?php echo $beneficiario['Persona']['telefono_fijo']?>
				<br/>
				<strong>CELULAR:</strong> <?php echo $beneficiario['Persona']['telefono_movil']?>
				<br/>
				<strong>MENSAJES:</strong> <?php echo $beneficiario['Persona']['telefono_mensajes']?>
				<br/>
				<strong>EMAIL:</strong> <?php echo $beneficiario['Persona']['email']?>
				<br/>
				<strong>CALLE:</strong> <?php echo $beneficiario['Persona']['calle']?> - <strong>Nº</strong> <?php echo $beneficiario['Persona']['numero']?> 
				<br/>
				<strong>BARRIO:</strong> <?php echo $beneficiario['Persona']['barrio_d']?> 
				<br/>
				<?php echo LOCALIDAD?> (CP <?php ECHO CP?>) - <?php echo PROVINCIA?>
			</p>
		</div>
	</div>
	<div class="tile is-parent is-8">
		<div class="tile is-child box">
			<h4 class="title">DETALLES PERSONALES</h4>
			<p>
				<strong>DISCAPACIDAD:</strong> <span class="info"><?php echo $beneficiario['Persona']['tipo_discapacidad_d']?></span>
				<br>
				<strong>NIVEL DE INSTRUCCION:</strong> <span class="info"><?php echo $beneficiario['Persona']['tipo_nivel_instruccion_d']?></span>
				<br/>
				<strong>PROFESION/OFICIO:</strong> <span class="info"><?php echo $beneficiario['Persona']['tipo_ocupacion_oficio_d']?></span>
				<br>
				<strong>INSTITUCION:</strong> <span class="info"><?php echo ($beneficiario['Persona']['institucion_anio_grado_d'] ? $beneficiario['Persona']['institucion_anio_grado_d'] : "")?></span> 
				<br>
				<strong>OCUPACION ACTUAL:</strong> <span class="info"><?php echo $beneficiario['Persona']['tipo_ocupacion_oficio_actual_d']?></span>
				<br/>
				<strong>INGRESOS:</strong> <span class="info"><?php echo $util->nf($beneficiario['Persona']['ingresos'])?></span>
				<br>
				<strong>COBERTURA MEDICA:</strong> <span class="info"><?php echo $beneficiario['Persona']['tipo_cobertura_medica_d']?></span>
				<br/>
				<strong>CONDICION LABORAL ACTUAL:</strong> <span class="info"><?php echo $beneficiario['Persona']['condicion_ocupacion_actual_d']?></span>
			</p>
		</div>
	</div>
</div>

<div class="tile is-ancestor">
	<div class="tile is-parent is-3">
		<div class="tile is-child box">
			<h4 class="title">OBSERVACIONES</h4>
			<p>
				<?php echo $beneficiario['Persona']['observaciones']?>
			</p>
			<p>
				ALTA EN: <strong><?php echo $beneficiario['Beneficiario']['alta_centro_id_d']?></strong>
				<br>
				<br>
				FECHA: <strong><?php echo $util->armaFecha($beneficiario['Beneficiario']['fecha_alta'])?></strong>
			</p>
		</div>
	</div>
	<div class="tile is-parent">
		<div class="tile is-child box">
			<h4 class="title">DATOS HABITACIONALES</h4>
			<p>
				<strong>LA VIVIENDA ES:</strong> <span class="info"><?php echo $beneficiario['Persona']['tipo_vivienda_d']?></span>
				<br/>
				<strong>HABITACIONES (SIN BA&Ntilde;O NI COCINA):</strong> <span class="info"><?php echo $beneficiario['Persona']['habitaciones']?></span>
				<br>
				<strong>LA FAMILIA ES:</strong> <span class="info"><?php echo $beneficiario['Persona']['tipo_condicion_vivienda_d']?></span>
				<br>
				<strong>ELECTRICIDAD:</strong> <span class="info"><?php echo $beneficiario['Persona']['tipo_electricidad_d']?></span>
				<br>
				<strong>AGUA:</strong> <span class="info"><?php echo $beneficiario['Persona']['tipo_agua_d']?></span>
				<br>
				<strong>CONEXIÓN DE AGUA:</strong> <span class="info"><?php echo $beneficiario['Persona']['tipo_conexion_agua_d']?></span>
				<br/>
				<strong>BA&Ntilde;O:</strong> <span class="info"><?php echo $beneficiario['Persona']['tipo_banio_d']?></span>
				<br/>
				<strong>MATERIALES DE TECHO:</strong> <span class="info"><?php echo $beneficiario['Persona']['tipo_techo_d']?></span>
				<br>
				<strong>MATERIALES DE PISOS:</strong> <span class="info"><?php echo $beneficiario['Persona']['tipo_piso_d']?></span>
				<br/>
				<strong>VIVIENDA PRECARIA:</strong> <span class="info"><?php echo ($beneficiario['Persona']['vivienda_precaria'] == 1 ? "SI":"NO")?></span>
				<br>
				<strong>N.B.I.:</strong> <span class="info"><?php echo ($beneficiario['Persona']['nbi'] == 1 ? "SI":"NO")?></span>
			</p>
		</div>
	</div>
</div>

<h3 class="title">GRUPO FAMILIAR ACTUAL</h3>
<?php if(!empty($beneficiario['adicionales'])):?>
<div class="table-container">
	<table class="table is-striped">
		<thead>
			<tr>
				<th>APELLIDO Y NOMBRE</th>
				<th>DOCUMENTO</th>
				<th>NACIMIENTO</th>
				<th>PARENTEZCO</th>
				<th>DISCAPACIDAD</th>
				<th>INSTRUCCION</th>
				<th>AÑO / GRADO</th>
				<th>PROF./OFICIO</th>
				<th>OCUP.ACTUAL</th>
				<th>INGRESOS</th>
				<th>FECHA ALTA</th>
				<th>FECHA BAJA</th>
				<th>OBSERVACIONES</th>
				<th>ALTA EN</th>
			</tr>
		</thead>
		
		<tbody>
		<?php foreach($beneficiario['adicionales'] as $adicional):?>
			<tr>
				<td nowrap="nowrap"><?php echo $html->link($adicional['Persona']['apenom'],'/personas/ficha/' . $adicional['Persona']['id'],array('target' => '_blank')) ?></td>
				<td nowrap="nowrap"><?php echo $adicional['Persona']['tdocndoc']?></td>
				<td><?php echo $util->armaFecha($adicional['Persona']['fecha_nacimiento'])?></td>
				<td><?php echo $adicional['BeneficiarioAdicional']['tipo_parentezco_d']?></td>
				<td><?php echo $adicional['Persona']['tipo_discapacidad_d']?></td>
				<td><?php echo $adicional['Persona']['institucion_anio_grado_d']?></td>
				<td><?php echo $adicional['Persona']['tipo_nivel_instruccion_d']?></td>
				<td><?php echo $adicional['Persona']['tipo_ocupacion_oficio_d']?></td>
				<td><?php echo $adicional['Persona']['tipo_ocupacion_oficio_actual_d']?></td>
				<td><?php echo $util->nf($adicional['Persona']['ingresos'])?></td>
				<td><?php if(!empty($adicional['BeneficiarioAdicional']['fecha_alta'])) echo $util->armaFecha($adicional['BeneficiarioAdicional']['fecha_alta'])?></td>
				<td><?php if(!empty($adicional['BeneficiarioAdicional']['fecha_baja'])) echo $util->armaFecha($adicional['BeneficiarioAdicional']['fecha_baja'])?></td>
				<td><?php echo $adicional['BeneficiarioAdicional']['observaciones']?></td>
				<td><?php echo $adicional['BeneficiarioAdicional']['alta_centro_id_d']?></td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>		
	<?php //debug($adicionales)?>
</div>

<?php else:?>
<div class="notification is-warning">
	NO POSEE GRUPO FAMILIAR A CARGO
</div>
<?php endif;?>	


<?php if(!empty($beneficiario['BeneficiosPermanentes'])):?>
<h3 class="title">PRODUCTOS Y/O SERVICIOS PERMANENTES</h3>
<div class="table-container">
	<table class="table is-striped">
		<thead>
			<tr>
				<th>ORD.</th>
				<th></th>
				<th>FECHA DESDE</th>
				<th>FECHA HASTA</th>
				<th>PRODUCTO / SERVICIO</th>
				<th>ENTREGADO A</th>
				<th>CANTIDAD</th>
				<th>VALOR</th>
				<th>OBSERVACIONES</th>
				<th>ENTREGADO EN</th>
			</tr>
		</thead>
		
		<tbody>
		<?php foreach($beneficiario['BeneficiosPermanentes'] as $beneficio):?>
			<tr class="<?php echo ($beneficio['vencido'] == 1 ? "productoVencido" : "")?>">
				<td><?php echo $html->link($beneficio['orden_nro_str'],'/beneficiario_beneficios/ficha/'.$beneficio['beneficiario_beneficio_id'],array('target' => 'blank'))?></td>
				<td><?php if($beneficio['vencido']) echo $html->image("controles/error.png")?></td>
				<td><?php echo $beneficio['orden_fecha_str']?></td>
				<td><strong><?php echo $util->armaFecha($beneficio['fecha_hasta'])?></strong></td>
				<td><?php echo $beneficio['producto_str']?></td>
				<td><strong><?php echo $html->link($beneficio['solicitante_str'],'/personas/ficha/' . $beneficio['persona_id'],array('target' => '_blank'))?></strong></td>
				<td><?php echo $beneficio['cantidad']?></td>
				<td><?php echo $util->nf($beneficio['importe'])?></td>
				<td><?php echo $beneficio['observaciones']?></td>
				<td><?php echo $beneficio['orden_emitida_str']?></td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
</div>
<?php endif;?>

<?php if(!empty($beneficiario['Beneficios'])):?>
<h3 class="title">HISTORICO DE PRODUCTOS Y/O SERVICIOS</h3>
<div class="table-container">
	<table class="table is-striped">
		<thead>
			<tr>
				<th>ORD.</th>
				<th>FECHA</th>
				<th>PRODUCTO / SERVICIO</th>
				<th>ENTREGADO A</th>
				<th>CANTIDAD</th>
				<th>VALOR</th>
				<th>OBSERVACIONES</th>
				<th>ENTREGADO EN</th>
			</tr>
		</thead>
		
		<tbody>
		<?php foreach($beneficiario['Beneficios'] as $beneficio):?>
			<tr>
				<td><?php echo $html->link($beneficio['orden_nro_str'],'/beneficiario_beneficios/ficha/'.$beneficio['beneficiario_beneficio_id'],array('target' => 'blank'))?></td>
				<td><?php echo $beneficio['orden_fecha_str']?></td>
				<td><?php echo $beneficio['producto_str']?></td>
				<td><strong><?php echo $html->link($beneficio['solicitante_str'],'/personas/ficha/' . $beneficio['persona_id'],array('target' => '_blank'))?></strong></td>
				<td><?php echo $beneficio['cantidad']?></td>
				<td><?php echo $util->nf($beneficio['importe'])?></td>
				<td><?php echo $beneficio['observaciones']?></td>
				<td><?php echo $beneficio['orden_emitida_str']?></td>
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>		
</div>	
<?php endif;?>
