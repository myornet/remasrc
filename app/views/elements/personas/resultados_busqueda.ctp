<?php 
if(!isset($accion))$accion = '/beneficiarios/ficha/';
if(!isset($icon))$icon = 'controles/folder_user.png';
//debug($personas);
?>
<?php if(!empty($personas)):?>

	<?php echo $this->renderElement('paginado')?>
	
	<script type="text/javascript">
	
	function toggleCellMouseOver(idRw, status){
		var celdas = $(idRw).immediateDescendants();
		if(status)celdas.each(function(td){td.addClassName("mouseOver");});
		else celdas.each(function(td){td.removeClassName("mouseOver");});
	}
	
	</script>
	
	<table class="table" cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th><i class="fas fa-digital-tachograph"></i></th>
				<th>TIPO</th>
				<th>DOCUMENTO</th>
				<th>BENEFICIARIO</th>
				<th>CALLE</th>
				<th>NUMERO</th>
				<th>BARRIO</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$i = 0;
		foreach($personas as $persona):
			$i++;
			$click = "onclick = \"window.location.href = '".$html->url($accion.$persona['Persona']['id'],true)."'\" style=\"cursor: pointer;\"";
		?>
			<tr id="LTR_<?php echo $i?>" onmouseover="toggleCellMouseOver('LTR_<?php echo $i?>',true)" onmouseout="toggleCellMouseOver('LTR_<?php echo $i?>',false)">
				<td align="center" <?php echo $click?>>
					<i class="fas fa-folder"></i>
				</td>
				<td <?php echo $click?>><?php echo $this->renderElement('valor',array('codigo' => $persona['Persona']['tipo_documento'], 'plugin' => 'global'));?></td>
				<td <?php echo $click?>><?php echo $persona['Persona']['documento']?></td>
				<td <?php echo $click?>><strong><?php echo $persona['Persona']['apellido'].", ".$persona['Persona']['nombre']?></strong></td>
				<td <?php echo $click?>><?php echo $persona['Persona']['calle']?></td>
				<td <?php echo $click?>><?php echo $persona['Persona']['numero']?></td>
				<td <?php echo $click?>><?php echo $this->renderElement('valor',array('codigo' => $persona['Persona']['barrio'], 'plugin' => 'global'));?></td>
			</tr>
		
		<?php endforeach;?>
		</tbody>
		<tfoot>
			<tr>
				<th><i class="fas fa-digital-tachograph"></i></th>
				<th>TIPO</th>
				<th>DOCUMENTO</th>
				<th>BENEFICIARIO</th>
				<th>CALLE</th>
				<th>NUMERO</th>
				<th>BARRIO</th>
			</tr>
		</tfoot>
	</table>
	<?php echo $this->renderElement('paginado')?>	
<?php endif;?>