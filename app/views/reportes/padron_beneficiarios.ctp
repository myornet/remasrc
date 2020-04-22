
<?php echo $this->renderElement('maquetado/menu_reportes')?>



<div class="areaDatoForm">
	<script type="text/javascript">
	Event.observe(window, 'load', function(){
		<?php if(!empty($asincrono)):?>
			$('padron_beneficiarios').disable();
		<?php endif;?>
	});
	</script>
	<h3>PADRON DE BENEFICIARIOS</h3>
	<?php echo $frm->create(null,array('action' => 'padron_beneficiarios','id' => 'padron_beneficiarios'));?>
		<table class="tbl_form">
			<tr>
				<td>CENTRO DE ATENCION (blanco = todos)</td>
				<td><?php echo $frm->input('Reporte.alta_centro_id',array('type' => 'select', 'options' => $centros, 'empty' => true))?></td>
			</tr>
			
			<tr>
				<td>BARRIO (blanco = todos)</td>
				<td>
					<?php 
					echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSBARR','empty' => true,'selected' => $this->data['Reporte']['barrio'],'model' => 'Reporte.barrio'));
					?>			
				</td>
			</tr>			
			<tr><th colspan="2" style="text-align:left;">DATOS COMPLEMENTARIOS</th></tr>		
			<tr>
				<td>NIVEL DE INSTRUCCION (blanco = todos)</td>
				<td>
					<?php 
					echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSNINT','empty' => true,'model' => 'Reporte.tipo_nivel_instruccion','selected' => $this->data['Reporte']['tipo_nivel_instruccion'],'orden' => array('GlobalDato.concepto_1')));
					?>
				</td>
			</tr>		
			<tr>
				<td>DISCAPACIDAD (blanco = todos)</td>
				<td>
					<?php 
					echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSDISC','empty' => true,'model' => 'Reporte.tipo_discapacidad','selected' => $this->data['Reporte']['tipo_discapacidad'],'orden' => array('GlobalDato.concepto_1')));
					?>			
				</td>
			</tr>		
			<tr>
				<td>PROFESION / OFICIO (blanco = todos)</td>
				<td>
					<?php 
					echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSOCUP','empty' => true,'model' => 'Reporte.tipo_ocupacion_oficio','selected' => $this->data['Reporte']['tipo_ocupacion_oficio'],'orden' => array('GlobalDato.concepto_1')));
					?>	
				</td>
			</tr>
			<tr>
				<td>OCUPACION ACTUAL (blanco = todos)</td>
				<td>
					<?php 
					echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSOCPA','empty' => true,'model' => 'Reporte.tipo_ocupacion_oficio_actual','selected' => $this->data['Reporte']['tipo_ocupacion_oficio_actual'],'orden' => array('GlobalDato.concepto_1')));
					?>			
				</td>
			</tr>
			<tr>
				<td>CONDICION LABORAL (blanco = todos)</td>
				<td>
					<?php 
					echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSTIOC','empty' => true,'model' => 'Reporte.condicion_ocupacion_actual','selected' => $this->data['Reporte']['condicion_ocupacion_actual'],'orden' => array('GlobalDato.concepto_1')));
					?>			
				</td>
			</tr>			
			<tr>
				<td>COBERTURA MEDICA (blanco = todos)</td>
				<td>
					<?php 
					echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSCOBE','empty' => true,'model' => 'Reporte.tipo_cobertura_medica','selected' => $this->data['Reporte']['tipo_cobertura_medica'],'orden' => array('GlobalDato.concepto_1')));
					?>			
				</td>
			</tr>
			<tr><th colspan="2" style="text-align:left;">DATOS HABITACIONALES</th></tr>
			<tr>
				<td>LA VIVIENDA ES (blanco = todos)</td>
				<td>
					<?php 
					echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSVIVI','empty' => true,'model' => 'Reporte.tipo_vivienda','selected' => $this->data['Reporte']['tipo_vivienda'],'orden' => array('GlobalDato.concepto_1')));
					?>	
				</td>
			</tr>
			<tr>
				<td>LA FAMILIA ES (blanco = todos)</td>
				<td>
					<?php 
					echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSCVIV','empty' => true,'model' => 'Reporte.tipo_condicion_vivienda','selected' => $this->data['Reporte']['tipo_condicion_vivienda'],'orden' => array('GlobalDato.concepto_1')));
					?>
				</td>
			</tr>
			<tr>
				<td>ELECTRICIDAD (blanco = todos)</td>
				<td>
					<?php 
					echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSELEC','empty' => true,'model' => 'Reporte.tipo_electricidad','selected' => $this->data['Reporte']['tipo_electricidad'],'orden' => array('GlobalDato.id')));
					?>			
				</td>
			</tr>
			<tr>
				<td>SERV. DE AGUA (blanco = todos)</td>
				<td>
					<?php 
					echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSAGUA','empty' => true,'model' => 'Reporte.tipo_agua','selected' => $this->data['Reporte']['tipo_agua'],'orden' => array('GlobalDato.id')));
					?>
				</td>
			</tr>
			<tr>
				<td>CONEXION (blanco = todos)</td>
				<td>
					<?php 
					echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSTCOA','empty' => true,'model' => 'Reporte.tipo_conexion_agua','selected' => $this->data['Reporte']['tipo_conexion_agua'],'orden' => array('GlobalDato.id')));
					?>						
				</td>
			</tr>		
			<tr>
				<td>BA&Ntilde;O (blanco = todos)</td>
				<td>
					<?php 
					echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSBANI','empty' => true,'model' => 'Reporte.tipo_banio','selected' => $this->data['Reporte']['tipo_banio'],'orden' => array('GlobalDato.id')));
					?>			
				</td>
			</tr>
			<tr>
				<td>MATERIALES DE TECHO (blanco = todos)</td>
				<td>
					<?php 
					echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSTECH','empty' => true,'model' => 'Reporte.tipo_techo','selected' => $this->data['Reporte']['tipo_techo'],'orden' => array('GlobalDato.id')));
					?>			
				</td>
			</tr>	
			<tr>
				<td>MATERIALES DE PISOS (blanco = todos)</td>
				<td>
					<?php 
					echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSPISO','empty' => true,'model' => 'Reporte.tipo_piso','selected' => $this->data['Reporte']['tipo_piso'],'orden' => array('GlobalDato.id')));
					?>			
				</td>
			</tr>			
			<tr>
				<td>VIVIENDA PRECARIA</td>
				<td><input type="checkbox" name="data[Reporte][vivienda_precaria]" value="1" id="ReporteViviendaPrecaria" <?php echo (isset($this->data['Reporte']['vivienda_precaria']) ? "checked='checked'":"")?>/></td>
			</tr>
			<tr>
				<td>N.B.I.</td>
				<td><input type="checkbox" name="data[Reporte][nbi]" value="1" id="ReporteNbi" <?php echo (isset($this->data['Reporte']['nbi']) ? "checked='checked'":"")?>/></td>
			</tr>
			<tr>
				<td>TIPO DE REPORTE</td>
				<td><?php echo $frm->input('Reporte.filtrado',array('type' => 'select', 'options' => array('GENERAL' => 'PADRON GENERAL DE PERSONAS','SOLO_TITULARES' => 'PADRON DE TITULARES DE BENEFICIO', 'TITULARES_ADICIONALES' => 'PADRON DE TITULARES CON DETALLE DE ADICIONALES'),))?></td>
			</tr>						
			<tr>
				<td>FORMATO</td>
				<td><?php echo $frm->tipoReporte((isset($this->data['Reporte']['tipo_reporte']) ? $this->data['Reporte']['tipo_reporte'] : "PDF"),'Reporte')?></td>
			</tr>			
			<tr>
				<td colspan="2"><?php echo $frm->submit("GENERAR PROCESO")?></td>
			</tr>			
			
		
		</table>
	<?php echo $frm->end();?>
</div>
<?php echo $this->renderElement('asincrono',array('asincrono' => $asincrono))?>
