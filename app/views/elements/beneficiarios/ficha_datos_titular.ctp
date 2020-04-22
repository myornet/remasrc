<div id="ficha">

	<div id="ficha-etiqueta">FICHA DE DATOS DEL TITULAR</div>

	<div id="ficha-datos">
	
		DOCUMENTO:<span class="info"><?php echo $beneficiario['Persona']['tdocndoc']?></span>&nbsp;&nbsp;APELLIDO Y NOMBRE:<span class="info"><?php echo $beneficiario['Persona']['apenom']?></span>
		
		<br/><br/>	
		
		CUIT / CUIL:<span class="info"><?php echo $beneficiario['Persona']['cuit_cuil']?></span>&nbsp;&nbsp;FECHA NACIMIENTO:<span class="info"><?php echo $util->armaFecha($beneficiario['Persona']['fecha_nacimiento'])?></span>
		
		<br/>
		
		TELEFONO FIJO:<span class="info"><?php echo $beneficiario['Persona']['telefono_fijo']?></span>&nbsp;&nbsp;CELULAR: <span class="info"><?php echo $beneficiario['Persona']['telefono_movil']?></span>
		
		<br/>
		
		MENSAJES:<span class="info"><?php echo $beneficiario['Persona']['telefono_mensajes']?></span>&nbsp;&nbsp;EMAIL:<span class="info"><?php echo $beneficiario['Persona']['email']?></span>
		
		<br/>
		
		CALLE:<span class="info"><?php echo $beneficiario['Persona']['calle']?></span>&nbsp;&nbsp;NUMERO:<span class="info"><?php echo $beneficiario['Persona']['numero']?></span>&nbsp;&nbsp;BARRIO:<span class="info"><?php echo $beneficiario['Persona']['barrio_d']?></span> <?php echo LOCALIDAD?> (CP <?php ECHO CP?>) - <?php echo PROVINCIA?>
	
		<br/><br/>
	
		DISCAPACIDAD:<span class="info"><?php echo $beneficiario['Persona']['tipo_discapacidad_d']?></span>&nbsp;&nbsp;NIVEL DE INSTRUCCION:<span class="info"><?php echo $beneficiario['Persona']['tipo_nivel_instruccion_d']?></span>
		
		<br/>
		
		PROFESION/OFICIO:<span class="info"><?php echo $beneficiario['Persona']['tipo_ocupacion_oficio_d']?></span>&nbsp;INSTITUCION: <span class="info"><?php echo ($beneficiario['Persona']['institucion_anio_grado_d'] ? $beneficiario['Persona']['institucion_anio_grado_d'] : "")?></span>&nbsp;&nbsp;OCUPACION ACTUAL:<span class="info"><?php echo $beneficiario['Persona']['tipo_ocupacion_oficio_actual_d']?></span>
		<br/>
		INGRESOS:<span class="info"><?php echo $util->nf($beneficiario['Persona']['ingresos'])?></span>
		&nbsp;&nbsp;COBERTURA MEDICA:<span class="info"><?php echo $beneficiario['Persona']['tipo_cobertura_medica_d']?></span>
		<br/>
		CONDICION LABORAL ACTUAL: <span class="info"><?php echo $beneficiario['Persona']['condicion_ocupacion_actual_d']?></span>
		<br/><br/>
		
		<div id="ficha-etiqueta">DATOS HABITACIONALES</div>
	
		LA VIVIENDA ES:<span class="info"><?php echo $beneficiario['Persona']['tipo_vivienda_d']?></span>&nbsp;&nbsp;HABITACIONES (SIN BA&Ntilde;O NI COCINA):<span class="info"><?php echo $beneficiario['Persona']['habitaciones']?></span>&nbsp;&nbsp;LA FAMILIA ES:<span class="info"><?php echo $beneficiario['Persona']['tipo_condicion_vivienda_d']?></span>
		
		<br/>
		
		ELECTRICIDAD:<span class="info"><?php echo $beneficiario['Persona']['tipo_electricidad_d']?></span>&nbsp;&nbsp;AGUA:<span class="info"><?php echo $beneficiario['Persona']['tipo_agua_d']?></span>&nbsp;&nbsp;CONEX.AGUA:<span class="info"><?php echo $beneficiario['Persona']['tipo_conexion_agua_d']?></span>
		<br/>BA&Ntilde;O:<span class="info"><?php echo $beneficiario['Persona']['tipo_banio_d']?></span>
		
		<br/>
		
		MATERIALES DE TECHO :<span class="info"><?php echo $beneficiario['Persona']['tipo_techo_d']?></span>&nbsp;&nbsp;MATERIALES DE PISOS:<span class="info"><?php echo $beneficiario['Persona']['tipo_piso_d']?></span>	
	
		<br/>
		
		VIVIENDA PRECARIA: <span class="info"><?php echo ($beneficiario['Persona']['vivienda_precaria'] == 1 ? "SI":"NO")?></span>
		&nbsp;&nbsp; N.B.I.: <span class="info"><?php echo ($beneficiario['Persona']['nbi'] == 1 ? "SI":"NO")?></span>
	
		<br/><br/>
		
		<div id="ficha-etiqueta">OBSERVACIONES</div>
		
		<?php echo $beneficiario['Persona']['observaciones']?>
		
		<br/><br/>
		ALTA EN: <strong><?php echo $beneficiario['Beneficiario']['alta_centro_id_d']?></strong> | FECHA: <strong><?php echo $util->armaFecha($beneficiario['Beneficiario']['fecha_alta'])?></strong>
		
	</div>

	
	
		<div id="ficha-etiqueta">GRUPO FAMILIAR ACTUAL</div>
	
		<div id="ficha-datos">
		
				<?php if(!empty($beneficiario['adicionales'])):?>
			
					<table>
					
						<tr>
						
							<th>APELLIDO Y NOMBRE</th>
							<th>DOCUMENTO</th>
							<th>NACIMIENTO</th>
							<th>PARENTEZCO</th>
							<th>DISCAPACIDAD</th>
							<th>INSTRUCCION</th>
							<th>PROF./OFICIO</th>
							<th>OCUP.ACTUAL</th>
							<th>INSTITUCION</th>
							<th>INGRESOS</th>
							<th>FECHA ALTA</th>
							<th>FECHA BAJA</th>
							<th>ALTA EN</th>
							
						</tr>
						
						<?php foreach($beneficiario['adicionales'] as $adicional):?>
							<tr>
							
								<td nowrap="nowrap"><?php echo $html->link($adicional['Persona']['apenom'],'/personas/ficha/' . $adicional['Persona']['id'],array('target' => '_blank')) ?></td>
								<td nowrap="nowrap"><?php echo $adicional['Persona']['tdocndoc']?></td>
								<td><?php echo $util->armaFecha($adicional['Persona']['fecha_nacimiento'])?></td>
								<td><?php echo $adicional['BeneficiarioAdicional']['tipo_parentezco_d']?></td>
								<td><?php echo $adicional['Persona']['tipo_discapacidad_d']?></td>
								<td><?php echo $adicional['Persona']['tipo_nivel_instruccion_d']?></td>
								
								<td><?php echo $adicional['Persona']['tipo_ocupacion_oficio_d']?></td>
								<td><?php echo $adicional['Persona']['tipo_ocupacion_oficio_actual_d']?></td>
								<td><?php echo $adicional['Persona']['institucion_anio_grado_d']?></td>
								<td align="right"><?php echo $util->nf($adicional['Persona']['ingresos'])?></td>
								<td align="center"><?php if(!empty($adicional['BeneficiarioAdicional']['fecha_alta'])) echo $util->armaFecha($adicional['BeneficiarioAdicional']['fecha_alta'])?></td>
								<td align="center"><?php if(!empty($adicional['BeneficiarioAdicional']['fecha_baja'])) echo $util->armaFecha($adicional['BeneficiarioAdicional']['fecha_baja'])?></td>
								<td align="center"><?php echo $adicional['BeneficiarioAdicional']['alta_centro_id_d']?></td>
								<td><?php echo $adicional['BeneficiarioAdicional']['observaciones']?></td>
						
						<?php endforeach;?>
					
					</table>
				<?php else:?>
				
					*** NO POSEE GRUPO FAMILIAR A CARGO ***
						
				<?php endif;?>	
			<?//php debug($adicionales)?>
			
		</div>
	
	
	
	<?php if(!empty($beneficiario['BeneficiosPermanentes'])):?>
		
		<div id="ficha-etiqueta">PRODUCTOS Y/O SERVICIOS PERMANENTES</div>
		<div id="ficha-datos">
		
			<table>
			
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
				
				<?php foreach($beneficiario['BeneficiosPermanentes'] as $beneficio):?>
			
					<tr class="<?php echo ($beneficio['vencido'] == 1 ? "productoVencido" : "")?>">
						<td align="center"><?php echo $html->link($beneficio['orden_nro_str'],'/beneficiario_beneficios/ficha/'.$beneficio['beneficiario_beneficio_id'],array('target' => 'blank'))?></td>
						<td align="center"><?php if($beneficio['vencido']) echo $html->image("controles/error.png")?></td>
						<td align="center"><?php echo $beneficio['orden_fecha_str']?></td>
						<td align="center"><strong><?php echo $util->armaFecha($beneficio['fecha_hasta'])?></strong></td>
						<td><?php echo $beneficio['producto_str']?></td>
						<td><strong><?php echo $html->link($beneficio['solicitante_str'],'/personas/ficha/' . $beneficio['persona_id'],array('target' => '_blank'))?></strong></td>
						<td align="center"><?php echo $beneficio['cantidad']?></td>
						<td align="right"><?php echo $util->nf($beneficio['importe'])?></td>
						<td><?php echo $beneficio['observaciones']?></td>
						<td><?php echo $beneficio['orden_emitida_str']?></td>
					</tr>
			
				<?php endforeach;?>
			
			</table>		
		
		</div>
	<?php endif;?>
	
	<?php if(!empty($beneficiario['Beneficios'])):?>
		<div id="ficha-etiqueta">HISTORICO DE PRODUCTOS Y/O SERVICIOS</div>
		<div id="ficha-datos">
			<table>
			
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
				
				<?php foreach($beneficiario['Beneficios'] as $beneficio):?>
			
					<tr>
						<td align="center"><?php echo $html->link($beneficio['orden_nro_str'],'/beneficiario_beneficios/ficha/'.$beneficio['beneficiario_beneficio_id'],array('target' => 'blank'))?></td>
						<td align="center"><?php echo $beneficio['orden_fecha_str']?></td>
						<td><?php echo $beneficio['producto_str']?></td>
						<td><strong><?php echo $html->link($beneficio['solicitante_str'],'/personas/ficha/' . $beneficio['persona_id'],array('target' => '_blank'))?></strong></td>
						<td align="center"><?php echo $beneficio['cantidad']?></td>
						<td align="right"><?php echo $util->nf($beneficio['importe'])?></td>
						<td><?php echo $beneficio['observaciones']?></td>
						<td><?php echo $beneficio['orden_emitida_str']?></td>
					</tr>
			
				<?php endforeach;?>
			
			</table>		
		</div>	
	<?php endif;?>

<!-- 
	<div id="ficha-etiqueta">APRENDIENDO JUNTOS Y APOYO ESCOLAR</div>

	<div id="ficha-datos">#APOYOESCOLAR#</div>


	<div id="ficha-etiqueta">BENEFICIOS</div>

	<div id="ficha-datos">
	
		<div id="ficha-etiqueta">ALIMENTOS</div>
		
			#ALIMENTOS#
		
		<div id="ficha-etiqueta">SALUD</div>
		
			#SALUD#
		
		<div id="ficha-etiqueta">SALUD</div>
		
			#SALUD#
	
	</div>
 -->

</div>
