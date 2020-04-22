<table class="tbl_form">
	<tr><th colspan="2" style="text-align:left;">DATOS PERSONALES</th></tr>
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
			endif;
			echo $frm->hidden('Persona.id',array('value' => (isset($this->data['Persona']['id']) ? $this->data['Persona']['id'] : 0)));
			?>
		</td>
	</tr>	
	<tr>
		<td>APELLIDO</td><td><?php echo $frm->input('Persona.apellido',array('size'=>50,'maxlength'=>50));?></td>
	</tr>
	<tr>
		<td>NOMBRES</td><td><?php echo $frm->input('Persona.nombre',array('size'=>50,'maxlength'=>50));?></td>
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
		<td>TELEFONO PARTICULAR</td>
		<td>
			<?php echo $frm->number('Persona.telefono_fijo',array('size'=>20,'maxlength'=>20));?>
			&nbsp;CELULAR <?php echo $frm->number('Persona.telefono_movil',array('size'=>20,'maxlength'=>20));?>
		</td>
	</tr>
	<tr>
		<td>TELEFONO MENSAJES</td>
		<td>
			<?php echo $frm->number('Persona.telefono_mensajes',array('size'=>15,'maxlength'=>30));?>
			&nbsp;E-MAIL <?php echo $frm->input('Persona.email',array('size'=>50,'maxlength'=>50));?>
		</td>
	</tr>					
	<tr><th colspan="2" style="text-align:left;">DOMICILIO</th></tr>
	<tr>
		<td>CALLE</td>
		<td>
			<?php echo $frm->input('Persona.calle',array('size'=>50,'maxlength'=>50));?>
			&nbsp;
			<?php echo $frm->number('Persona.numero',array('label' => 'NUMERO','size'=>5,'maxlength'=>5))?>
		</td>
	</tr>
	<tr>
		<td>BARRIO</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSBARR','empty' => false,'selected' => $this->data['Persona']['barrio'],'model' => 'Persona.barrio'));
			?>			
		</td>
	</tr>
	<tr>
		<td>LOCALIDAD</td>
		<td>
			<input name="data[Persona][localidad]" type="text" size="25" maxlength="25" id="PersonaLocalidad" disabled value="<?php echo LOCALIDAD?>" />
			CP 
			<input name="data[Persona][codigo_postal]" type="text" size="4" maxlength="4" value="<?php echo CP?>" id="PersonaCodigoPostal" disabled/>
			PROVINCIA
			<input name="data[Persona][provincia]" type="text" size="15" maxlength="15" value="<?php echo PROVINCIA?>" id="PersonaProvincia" disabled/>
		</td>
	</tr>	
	<tr><th colspan="2" style="text-align:left;">DATOS COMPLEMENTARIOS</th></tr>
	<tr>
		<td>NIVEL DE INSTRUCCION</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSNINT','empty' => false,'model' => 'Persona.tipo_nivel_instruccion','selected' => $this->data['Persona']['tipo_nivel_instruccion'],'orden' => array('GlobalDato.concepto_1')));
			?>
		</td>
	</tr>		
	<tr>
		<td>DISCAPACIDAD</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSDISC','empty' => false,'model' => 'Persona.tipo_discapacidad','selected' => $this->data['Persona']['tipo_discapacidad'],'orden' => array('GlobalDato.concepto_1')));
			?>			
		</td>
	</tr>		
	<tr>
		<td>PROFESION / OFICIO</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSOCUP','empty' => false,'model' => 'Persona.tipo_ocupacion_oficio','selected' => $this->data['Persona']['tipo_ocupacion_oficio'],'orden' => array('GlobalDato.concepto_1')));
			?>	
		</td>
	</tr>
	<tr>
		<td>OCUPACION ACTUAL</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSOCPA','empty' => false,'model' => 'Persona.tipo_ocupacion_oficio_actual','selected' => $this->data['Persona']['tipo_ocupacion_oficio_actual'],'orden' => array('GlobalDato.concepto_1')));
			?>			
			&nbsp;INGRESOS (####.##)
			<?php echo $frm->number('Persona.ingresos',array('size'=>10,'maxlength'=>10),true);?>
		</td>
	</tr>
	<tr>
		<td>CONDICION</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSTIOC','empty' => false,'model' => 'Persona.condicion_ocupacion_actual','selected' => $this->data['Persona']['condicion_ocupacion_actual'],'orden' => array('GlobalDato.concepto_1')));
			?>			
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
	<tr>
		<td>COBERTURA MEDICA</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSCOBE','empty' => false,'model' => 'Persona.tipo_cobertura_medica','selected' => $this->data['Persona']['tipo_cobertura_medica'],'orden' => array('GlobalDato.concepto_1')));
			?>			
		</td>
	</tr>
	<tr><th colspan="2" style="text-align:left;">DATOS HABITACIONALES</th></tr>
	<tr>
		<td>LA VIVIENDA ES</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSVIVI','empty' => false,'model' => 'Persona.tipo_vivienda','selected' => $this->data['Persona']['tipo_vivienda'],'orden' => array('GlobalDato.concepto_1')));
			?>	
			&nbsp;HABITACIONES (SIN BA&Ntilde;O NI COCINA)
			<?php echo $frm->number('Persona.habitaciones',array('size'=>2,'maxlength'=>2));?>
		</td>
	</tr>
	<tr>
		<td>LA FAMILIA ES</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSCVIV','empty' => false,'model' => 'Persona.tipo_condicion_vivienda','selected' => $this->data['Persona']['tipo_condicion_vivienda'],'orden' => array('GlobalDato.concepto_1')));
			?>
			&nbsp;MONTO ALQUILER (####.##)
			<?php echo $frm->number('Persona.monto_alquiler',array('size'=>10,'maxlength'=>10),true);?>
		</td>
	</tr>
	<tr>
		<td>ELECTRICIDAD</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSELEC','empty' => false,'model' => 'Persona.tipo_electricidad','selected' => $this->data['Persona']['tipo_electricidad'],'orden' => array('GlobalDato.concepto_1')));
			?>			
		</td>
	</tr>
	<tr>
		<td>SERV. DE AGUA</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSAGUA','empty' => false,'model' => 'Persona.tipo_agua','selected' => $this->data['Persona']['tipo_agua'],'orden' => array('GlobalDato.concepto_1')));
			?>
			CONEXION
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSTCOA','empty' => false,'model' => 'Persona.tipo_conexion_agua','selected' => $this->data['Persona']['tipo_conexion_agua'],'orden' => array('GlobalDato.concepto_1')));
			?>						
		</td>
	</tr>

	<tr>
		<td>BA&Ntilde;O</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSBANI','empty' => false,'model' => 'Persona.tipo_banio','selected' => $this->data['Persona']['tipo_banio'],'orden' => array('GlobalDato.concepto_1')));
			?>			
		</td>
	</tr>
	<tr>
		<td>MATERIALES DE TECHO</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSTECH','empty' => false,'model' => 'Persona.tipo_techo','selected' => $this->data['Persona']['tipo_techo'],'orden' => array('GlobalDato.concepto_1')));
			?>			
		</td>
	</tr>	
	<tr>
		<td>MATERIALES DE PISOS</td>
		<td>
			<?php 
			echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSPISO','empty' => false,'model' => 'Persona.tipo_piso','selected' => $this->data['Persona']['tipo_piso'],'orden' => array('GlobalDato.concepto_1')));
			?>			
		</td>
	</tr>
	<tr>
		<td>VIVIENDA PRECARIA</td>
		<td><?php echo $frm->input('Persona.vivienda_precaria');?></td>
	</tr>
	<tr>
		<td>N.B.I.</td>
		<td><?php echo $frm->input('Persona.nbi');?></td>
	</tr>	
	<tr><th colspan="2" style="text-align:left;">OTRAS ANOTACIONES COMPLEMENTARIAS</th></tr>	
	<tr><td colspan="2"><?php echo $frm->textarea('Persona.observaciones',array('cols' => 80, 'rows' => 10))?></td></tr>	
	<tr>
		<td>FECHA DE ALTA</td>
		<td>
			<?php echo $frm->input('Persona.fecha_alta',array('dateFormat' => "DMY", 'minYear'=>'1930','maxYear'=> date('Y'),'disabled' => (isset($edit) && $edit ? 'disabled' : "")));?>
		</td>
	</tr>	
</table>