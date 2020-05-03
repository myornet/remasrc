<?php echo $this->renderElement('beneficiarios/menu_padron',array('beneficiario_id' => $beneficiario_id))?>

<h3 class="title">GRUPO FAMILIAR</h3>

<div class="buttons">
<?php 
if($user['Usuario']['perfil'] == 3 && $beneficiario['Beneficiario']['estado'] == 1): ?>
	<a href="alta_adicional/<?php echo $beneficiario_id ?>" class="button">
	<span class="icon is-small">
      <i class="fas fa-user-plus"></i>
    </span>
	<span>INCORPORAR AL GRUPO FAMILIAR</span>
	</a>

	<?php if(!empty($adicionales)): ?>
	<a href="administrar/<?php echo $beneficiario_id ?>" class="button">
	<span class="icon is-small">
      <i class="fas fa-user-edit"></i>
    </span>
	<span>ADMINISTRAR GRUPO FAMILIAR</span>
	</a>
	<?php endif; ?>
<?php endif; ?>
</div>

<?php if(!empty($adicionales)):?>
<div class="table-container">
	<table class="table is-striped">
		<thead>
			<tr>
				<th>EDITAR</th>
				<th>ELIMINAR</th>
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
		</thead>
		
		<tbody>
		<?php foreach($adicionales as $adicional):?>
			<tr class="<?php echo ($adicional['BeneficiarioAdicional']['estado'] == 0 ? ($adicional['BeneficiarioAdicional']['nuevo_titular_beneficio_id'] == 0 ? "noActivo" : "gris") : "")?>">
				
				<?php if($adicional['BeneficiarioAdicional']['nuevo_titular_beneficio_id'] == 0):?>
					<td>
						<?php if($user['Usuario']['perfil'] == 3 && $beneficiario['Beneficiario']['estado'] == 1) ?>
						<a class="button is-white" href="/modificar_datos_adicional/<?php echo $adicional['BeneficiarioAdicional']['id'] ?>">
							<span class="icon is-small">
								<i class="fas fa-user-edit"></i>
							</span>
						</a>				
					</td>
					<td>
						<?php if($user['Usuario']['perfil'] == 3 && $beneficiario['Beneficiario']['estado'] == 1) ?>
						<a class="button is-white" href="/beneficiario_adicionales/borrar_adicional/<?php echo $adicional['BeneficiarioAdicional']['id'] ?>" onclick="return confirm('BORRAR DEFINITVAMENTE A: <?php echo $adicional['Persona']['apenom'] .' ' . $adicional['Persona']['tdocndoc'].'?' ?>');">
							<span class="icon is-small">
								<i class="fas fa-user-times"></i>
							</span>
						</a>
					</td>
				<?php else:?>
					<td colspan="2"><strong><?php echo $html->link("BENF. #".$adicional['BeneficiarioAdicional']['nuevo_titular_beneficio_id'],"/beneficiarios/ficha/".$adicional['BeneficiarioAdicional']['persona_id'],array('target' => '_blank'))?></strong></td>
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
				<td><?php echo $util->nf($adicional['Persona']['ingresos'])?></td>
				<td><?php if(!empty($adicional['BeneficiarioAdicional']['fecha_alta'])) echo $util->armaFecha($adicional['BeneficiarioAdicional']['fecha_alta'])?></td>
				<td><?php if(!empty($adicional['BeneficiarioAdicional']['fecha_baja'])) echo $util->armaFecha($adicional['BeneficiarioAdicional']['fecha_baja'])?></td>
				<td><?php echo $adicional['BeneficiarioAdicional']['alta_centro_id_d']?></td>
				<td><?php echo $adicional['BeneficiarioAdicional']['observaciones']?></td>
			
			</tr>
		<?php endforeach;?>
		</tbody>
	</table>
	<?php //debug($adicionales) ?>
</div>
<?php endif;?>

<?php if(!empty($estuvieron)):?>
<h3 class="title">PERSONAS QUE ESTUVIERON VINCULADAS AL GRUPO FAMILIAR</h3>
<div class="table-container">
	<table class="table is-striped">
		<thead>
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
		</thead>
		
		<tbody>
		<?php foreach($estuvieron as $adicional):?>
			<tr class="gris">
				<td><?php if($user['Usuario']['perfil'] == 3) echo $controles->botonGenerico('revertir/'.$adicional['BeneficiarioAdicional']['id'].'/'.$adicional['BeneficiarioAdicional']['nuevo_titular_beneficio_id'],'controles/stop2.png',null,null,'REINCORPORAR A: '.$adicional['Persona']['apenom'].' \nCOMO ADICIONAL DEL BENEFICIO ACTUAL \nY ELIMINAR EL BENEFICIO #'.$adicional['BeneficiarioAdicional']['nuevo_titular_beneficio_id'].'?');?></td>
				<td><strong><?php echo $html->link("#".$adicional['BeneficiarioAdicional']['nuevo_titular_beneficio_id'],"/beneficiarios/ficha/".$adicional['BeneficiarioAdicional']['persona_id'],array('target' => '_blank'))?></strong></td>
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
		</tbody>
	</table>
</div>
<?php //debug($estuvieron) ?>

<?php endif;?>