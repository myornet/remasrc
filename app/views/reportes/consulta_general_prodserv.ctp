
<?php echo $this->renderElement('maquetado/menu_reportes')?>



<div class="areaDatoForm">
	<script type="text/javascript">
	Event.observe(window, 'load', function(){
		<?php if(!empty($asincrono)):?>
			$('consulta_general_prodserv').disable();
		<?php endif;?>
	});
	</script>
	<h3>REPORTE GENERAL DE PRODUCTOS Y/O SERVICIOS</h3>
	<?php echo $frm->create(null,array('action' => 'consulta_general_prodserv','id' => 'consulta_general_prodserv'));?>
		<table class="tbl_form">
			<tr>
				<td>CENTRO DE ATENCION (blanco = todos)</td>
				<td><?php echo $frm->input('Reporte.alta_centro_id',array('type' => 'select', 'options' => $centros, 'empty' => true))?></td>
			</tr>		
			<tr>
				<td>PRODUCTO / SERVICIO (blanco = todos)</td>
				<td><?php echo $this->renderElement('combo_nomenclador',array('plugin' => 'global','model' => 'Reporte','field' => 'producto_servicio','empty' => true, 'selected' => (isset($this->data['Reporte']['producto_servicio']) ? $this->data['Reporte']['producto_servicio'] : "")))?></td>
			</tr>
			<tr>
				<td>DESDE</td>
				<td><?php echo $frm->calendar('Reporte.fecha_desde','',$fecha_desde,'1990',date("Y"))?></td>
			</tr>
			<tr>
				<td>HASTA</td>
				<td><?php echo $frm->calendar('Reporte.fecha_hasta','',$fecha_hasta,'1990',date("Y"))?></td>
			</tr>
			<tr>
				<td>BARRIO (blanco = todos)</td>
				<td>
				<?php echo $this->renderElement('combo_metodo',array(
																				'plugin'=>'global',
																				'model' => 'Reporte.codigo_barrio',
																				'metodo' => 'get_barrios',
																				'disable' => false,
																				'empty' => true,
																				'selected' => (!empty($this->data['Reporte']['codigo_barrio']) ? $this->data['Reporte']['codigo_barrio'] : ''),
				))?>
				</td>
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
