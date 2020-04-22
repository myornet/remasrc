<?php echo $this->renderElement('beneficiarios/menu_padron',array('beneficiario_id' => $beneficiario_id))?>
<h2>GRUPO FAMILIAR</h2>
<div>
<?php 
if($user['Usuario']['perfil'] == 3 && $beneficiario['Beneficiario']['estado'] == 1):
	echo $controles->botonGenerico('alta_adicional/'.$beneficiario_id,'controles/groupevent.png','INCORPORAR AL GRUPO FAMILIAR');
	if(!empty($adicionales)):
		echo "&nbsp;|&nbsp;";
		echo $controles->botonGenerico('administrar/'.$beneficiario_id,'controles/table_edit.png','ADMINISTRAR GRUPO FAMILIAR');
	endif;
endif;
?>

</div>

<?php if(!empty($adicionales)):?>

	<table>
	
		<tr>
			<th></th>
			<th></th>
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
			<th>OBSERVACIONES</th>
			
		</tr>
		
		<?php foreach($adicionales as $adicional):?>
		
			<tr class="<?php echo ($adicional['BeneficiarioAdicional']['estado'] == 0 ? ($adicional['BeneficiarioAdicional']['nuevo_titular_beneficio_id'] == 0 ? "noActivo" : "gris") : "")?>">
				
				<?php if($adicional['BeneficiarioAdicional']['nuevo_titular_beneficio_id'] == 0):?>
					<td><?php if($user['Usuario']['perfil'] == 3 && $beneficiario['Beneficiario']['estado'] == 1) echo $controles->botonGenerico('modificar_datos_adicional/'.$adicional['BeneficiarioAdicional']['id'],'controles/edit.png')?></td>
					<td><?php if($user['Usuario']['perfil'] == 3 && $beneficiario['Beneficiario']['estado'] == 1) echo $controles->botonGenerico('borrar_adicional/'.$adicional['BeneficiarioAdicional']['id'],'controles/user-trash.png','',null,"BORRAR DEFINITVAMENTE A: ".$adicional['Persona']['apenom'] ." " . $adicional['Persona']['tdocndoc']."?")?></td>
				<?php else:?>
					<td colspan="2" align="center"><strong><?php echo $html->link("BENF. #".$adicional['BeneficiarioAdicional']['nuevo_titular_beneficio_id'],"/beneficiarios/ficha/".$adicional['BeneficiarioAdicional']['persona_id'],array('target' => '_blank'))?></strong></td>
				<?php endif;?>
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
			
			</tr>
		
		<?php endforeach;?>
	
	</table>

<?//php debug($adicionales)?>

<?php endif;?>

<?php if(!empty($estuvieron)):?>
	<div class="areaDatoForm">
	<strong>PERSONAS QUE ESTUVIERON VINCULADAS AL GRUPO FAMILIAR</strong>
	<table>
	
		<tr>
			<th></th>
			<th>BENEFICIO</th>
			<th>APELLIDO Y NOMBRE</th>
			<th>TIPO Y NRO DE DOCUMENTO</th>
			<th>FECHA NACIMIENTO</th>
			<th>PARENTEZCO</th>
			<th>DISCAPACIDAD</th>
			<th>NIVEL DE INSTRUCCION</th>
			<th>ACTIVIDAD</th>
			<th>INGRESOS</th>
			<th>FECHA ALTA</th>
			<th>FECHA BAJA</th>
			<th>ALTA EN</th>
			<th>OBSERVACIONES</th>
			
		</tr>
		
		<?php foreach($estuvieron as $adicional):?>
		
			<tr class="gris">
				<td><?php if($user['Usuario']['perfil'] == 3) echo $controles->botonGenerico('revertir/'.$adicional['BeneficiarioAdicional']['id'].'/'.$adicional['BeneficiarioAdicional']['nuevo_titular_beneficio_id'],'controles/stop2.png',null,null,'REINCORPORAR A: '.$adicional['Persona']['apenom'].' \nCOMO ADICIONAL DEL BENEFICIO ACTUAL \nY ELIMINAR EL BENEFICIO #'.$adicional['BeneficiarioAdicional']['nuevo_titular_beneficio_id'].'?');?></td>
				<td align="center"><strong><?php echo $html->link("#".$adicional['BeneficiarioAdicional']['nuevo_titular_beneficio_id'],"/beneficiarios/ficha/".$adicional['BeneficiarioAdicional']['persona_id'],array('target' => '_blank'))?></strong></td>
				<td><?php echo $adicional['Persona']['apenom']?></td>
				<td><?php echo $adicional['Persona']['tdocndoc']?></td>
				<td><?php echo $adicional['Persona']['fecha_nacimiento']?></td>
				<td><?php echo $adicional['BeneficiarioAdicional']['tipo_parentezco_d']?></td>
				<td><?php echo $adicional['Persona']['tipo_discapacidad_d']?></td>
				<td><?php echo $adicional['Persona']['tipo_nivel_instruccion_d']?></td>
				<td><?php echo $adicional['Persona']['tipo_ocupacion_oficio_d']?></td>
				<td><?php echo $adicional['Persona']['ingresos']?></td>
				<td><?php echo $adicional['BeneficiarioAdicional']['fecha_alta']?></td>
				<td><?php echo $adicional['BeneficiarioAdicional']['fecha_baja']?></td>
				<td><?php echo $adicional['BeneficiarioAdicional']['alta_centro_id_d']?></td>
				<td><?php echo $adicional['BeneficiarioAdicional']['observaciones']?></td>
			
			</tr>
		
		<?php endforeach;?>
	
	</table>
	</div>
<?//php debug($estuvieron)?>

<?php endif;?>