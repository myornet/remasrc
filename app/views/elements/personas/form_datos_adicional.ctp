<table class="tbl_form">

	<tr>
		<td>PARENTEZCO</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSPARE','selected' => (isset($this->data['BeneficiarioAdicional']['tipo_parentezco']) ? $this->data['BeneficiarioAdicional']['tipo_parentezco'] : ""),'empty' => false,'model' => 'BeneficiarioAdicional.tipo_parentezco'));
			?>			
		</td>
	</tr>	

	<tr>
		<td>TIPO DOCUMENTO</td>
		<td>
			<?php 
			if(isset($edit) && $edit):
				echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSTDOC','empty' => false,'disabled'=> true,'selected' => $this->data['Persona']['tipo_documento'],'model' => 'Persona.tipo_documento'));
				echo $frm->input('Persona.documento',array('label' => 'NUMERO','size'=>11,'maxlength'=>11,'disabled' => 'disabled'));
			else: 
				echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSTDOC','selected' => 'PERSTDOC0DNI','empty' => false,'model' => 'Persona.tipo_documento'));
				echo $frm->number('Persona.documento',array('label' => 'NUMERO','size'=>11,'maxlength'=>11));
				echo " (*)";
			endif;
			echo $frm->hidden('Persona.id',array('value' => (isset($this->data['BeneficiarioAdicional']['persona_id']) ? $this->data['BeneficiarioAdicional']['persona_id'] : 0)));
			?>
		</td>
	</tr>	
	<tr>
		<td>APELLIDO</td><td><?php echo $frm->input('Persona.apellido',array('size'=>50,'maxlength'=>50));?> (*)</td>
	</tr>
	<tr>
		<td>NOMBRES</td><td><?php echo $frm->input('Persona.nombre',array('size'=>50,'maxlength'=>50));?> (*)</td>
	</tr>
	<tr>
		<td>SEXO</td><td><?php echo $frm->input('Persona.sexo',array('type' => 'select','options' => array('M' => 'MASCULINO', 'F' => 'FEMENINO')));?></td>
	</tr>	
	<tr>
		<td>FECHA NACIMIENTO</td>
		<td>
			<?php echo $frm->input('Persona.fecha_nacimiento',array('dateFormat' => "DMY", 'minYear'=>'1930','maxYear'=> date('Y')));?>
			&nbsp;CUIT / CUIL <?php echo $frm->number('Persona.cuit_cuil',array('size'=>11,'maxlength'=>11));?>
		</td>
	</tr>
	<tr>
		<td>TELEFONO CELULAR</td>
		<td>
			<?php echo $frm->number('Persona.telefono_movil',array('size'=>20,'maxlength'=>20));?>
			&nbsp;E-MAIL <?php echo $frm->input('Persona.email',array('size'=>50,'maxlength'=>50));?>
		</td>
	</tr>	
	<tr>
		<td>COBERTURA MEDICA</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSCOBE','empty' => false,'model' => 'Persona.tipo_cobertura_medica','selected' => (isset($this->data['Persona']['tipo_cobertura_medica']) ? $this->data['Persona']['tipo_cobertura_medica'] : ""),'orden' => array('GlobalDato.concepto_1')));
			?>			
		</td>
	</tr>	
	<tr>
		<td>NIVEL DE INSTRUCCION</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSNINT','empty' => false, 'selected' => (isset($this->data['Persona']['tipo_nivel_instruccion']) ? $this->data['Persona']['tipo_nivel_instruccion'] : "") ,'model' => 'Persona.tipo_nivel_instruccion','orden' => array('GlobalDato.concepto_1')));
			?>
		</td>
	</tr>		
	<tr>
		<td>DISCAPACIDAD</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSDISC','empty' => false,'selected' => (isset($this->data['Persona']['tipo_discapacidad']) ? $this->data['Persona']['tipo_discapacidad'] : ""),'model' => 'Persona.tipo_discapacidad','orden' => array('GlobalDato.concepto_1')));
			?>			
		</td>
	</tr>		
	<tr>
		<td>PROFESION / OFICIO</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSOCUP','empty' => false,'selected' => (isset($this->data['Persona']['tipo_ocupacion_oficio']) ? $this->data['Persona']['tipo_ocupacion_oficio'] : ""),'model' => 'Persona.tipo_ocupacion_oficio','orden' => array('GlobalDato.concepto_1')));
			?>	
		</td>
	</tr>
	<tr>
		<td>OCUPACION ACTUAL</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSOCPA','empty' => false,'model' => 'Persona.tipo_ocupacion_oficio_actual','selected' => (isset($this->data['Persona']['tipo_ocupacion_oficio_actual']) ? $this->data['Persona']['tipo_ocupacion_oficio_actual'] : ""),'orden' => array('GlobalDato.concepto_1')));
			?>			
			&nbsp;INGRESOS (####.##)
			<?php echo $frm->number('Persona.ingresos',array('size'=>10,'maxlength'=>10),true);?>
		</td>
	</tr>	
	<tr>
		<td>INSTITUCION</td>
		<td>
			<input name="data[Persona][institucion]" type="text" size="40" maxlength="100" value="<?php echo $this->data['Persona']['institucion']?>" id="PersonaInstitucion"/>
			GRADO / A&Ntilde;O
			<select name="data[Persona][institucion_anio_grado]">
				<option value="1" <?php echo ($this->data['Persona']['institucion_anio_grado'] == "1" ? "selected" : "")?>>1</option>
				<option value="2" <?php echo ($this->data['Persona']['institucion_anio_grado'] == "2" ? "selected" : "")?>>2</option>
				<option value="3" <?php echo ($this->data['Persona']['institucion_anio_grado'] == "3" ? "selected" : "")?>>3</option>
				<option value="4" <?php echo ($this->data['Persona']['institucion_anio_grado'] == "4" ? "selected" : "")?>>4</option>
				<option value="5" <?php echo ($this->data['Persona']['institucion_anio_grado'] == "5" ? "selected" : "")?>>5</option>
				<option value="6" <?php echo ($this->data['Persona']['institucion_anio_grado'] == "6" ? "selected" : "")?>>6</option>
			</select>
			TURNO
			<select name="data[Persona][institucion_turno]">
				<option value="TM" <?php echo ($this->data['Persona']['institucion_turno'] == "TM" ? "selected" : "")?>>MAÑANA</option>
				<option value="TT" <?php echo ($this->data['Persona']['institucion_turno'] == "TT" ? "selected" : "")?>>TARDE</option>
				<option value="TN" <?php echo ($this->data['Persona']['institucion_turno'] == "TN" ? "selected" : "")?>>NOCHE</option>
			</select>			
		</td>
	</tr>	
	<tr><td colspan="2">OBSERVACIONES</td></tr>
	<tr><td colspan="2"><?php echo $frm->textarea('Persona.observaciones',array('cols' => 80, 'rows' => 10))?></td></tr>		
	
	<tr>
		<td>FECHA DE ALTA</td>
		<td>
			<?php echo $frm->input('BeneficiarioAdicional.fecha_alta',array('dateFormat' => "DMY", 'minYear'=>'1930','maxYear'=> date('Y'),'disabled' => (isset($edit) && $edit ? 'disabled' : "")));?>
		</td>
	</tr>		
	
</table>
<?php echo $frm->hidden('Persona.calle',array('value' => $beneficiario['Persona']['calle']));?>
<?php echo $frm->hidden('Persona.numero',array('value' => $beneficiario['Persona']['numero']));?>
<?php echo $frm->hidden('Persona.barrio',array('value' => $beneficiario['Persona']['barrio']));?>
<?php echo $frm->hidden('Persona.localidad',array('value' => $beneficiario['Persona']['localidad']));?>
<?php echo $frm->hidden('Persona.codigo_postal',array('value' => $beneficiario['Persona']['codigo_postal']));?>
<?php echo $frm->hidden('Persona.provincia',array('value' => $beneficiario['Persona']['provincia']));?>
<?php echo $frm->hidden('Persona.telefono_fijo',array('value' => $beneficiario['Persona']['telefono_fijo']));?>
<?php echo $frm->hidden('Persona.email',array('value' => $beneficiario['Persona']['email']));?>

<?php echo $frm->hidden('Persona.tipo_vivienda',array('value' => $beneficiario['Persona']['tipo_vivienda']));?>
<?php echo $frm->hidden('Persona.habitaciones',array('value' => $beneficiario['Persona']['habitaciones']));?>
<?php echo $frm->hidden('Persona.tipo_condicion_vivienda',array('value' => $beneficiario['Persona']['tipo_condicion_vivienda']));?>
<?php echo $frm->hidden('Persona.monto_alquiler',array('value' => $beneficiario['Persona']['monto_alquiler']));?>
<?php echo $frm->hidden('Persona.tipo_electricidad',array('value' => $beneficiario['Persona']['tipo_electricidad']));?>
<?php echo $frm->hidden('Persona.tipo_agua',array('value' => $beneficiario['Persona']['tipo_agua']));?>
<?php echo $frm->hidden('Persona.tipo_conexion_agua',array('value' => $beneficiario['Persona']['tipo_conexion_agua']));?>
<?php echo $frm->hidden('Persona.tipo_banio',array('value' => $beneficiario['Persona']['tipo_banio']));?>
<?php echo $frm->hidden('Persona.tipo_techo',array('value' => $beneficiario['Persona']['tipo_techo']));?>
<?php echo $frm->hidden('Persona.tipo_piso',array('value' => $beneficiario['Persona']['tipo_piso']));?>


