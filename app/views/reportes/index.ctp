<h2 class="modulo">REPORTES</h2>
<div class="areaDatoForm">
	<h3>CONSULTA GENERAL DE PRODUCTOS Y/O SERVICIOS</h3>
	<?php echo $frm->create(null,array('action' => 'index'));?>
		<table class="tbl_form">
			<tr>
				<td>PRODUCTO / SERVICIO</td>
				<td><?php echo $this->renderElement('combo_nomenclador',array('plugin' => 'global','empty' => true))?></td>
			</tr>
			<tr>
				<td>DESDE</td>
				<td><?php echo $frm->calendar('fecha_desde','',$fecha_desde,'1990',date("Y"))?></td>
			</tr>
			<tr>
				<td>HASTA</td>
				<td><?php echo $frm->calendar('fecha_desde','',$fecha_desde,'1990',date("Y"))?></td>
			</tr>
			<tr>
				<td>BARRIO</td>
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
				<td><?php echo $frm->tipoReporte()?></td>
			</tr>			
			<tr>
				<td colspan="2"><?php echo $frm->submit("GENERAR PROCESO")?></td>
			</tr>			
			
		
		</table>
	<?php echo $frm->end();?>
</div>