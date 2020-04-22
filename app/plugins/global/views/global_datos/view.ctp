<?php echo $this->renderElement("title",array('plugin' => 'global'));?>
<div class="form">
<h1><?php echo $html->image("/global/img/view_tree.png",array("border"=>"0"))?> LISTADO DE DATOS GLOBALES</h1>
<?php echo $html->link($html->image("/global/img/page_white_text.png",array("border"=>"0"))."Descartar TXT",'/global/global_datos/view/'.$prefijo.'/?to=TXT',array('target' => '_blank'),null,false)?>&nbsp;|
<?php echo $html->link($html->image("/global/img/page_excel.png",array("border"=>"0"))."Descartar CSV",'/global/global_datos/view/'.$prefijo.'/?to=CSV',array('target' => '_blank'),null,false)?>&nbsp;
<table>
	<tr>
		<th>CODIGO</th>
		<th>CONCEPTO I</th>
		<th>CONCEPTO II</th>
		<th>CONCEPTO III</th>
		<th>LOGICO I</th>
		<th>LOGICO II</th>
		<th>ENTERO I</th>
		<th>ENTERO II</th>
		<th>DECIMAL I</th>
		<th>DECIMAL II</th>
		<th>FECHA I</th>
		<th>FECHA II</th>
	</tr>
	<?php
	$i = 0;
	foreach ($datos as $dato):
		$class = null;
		$class = (strlen($dato['GlobalDato']['id']) == 4 ? ' class="gris"' : (strlen($dato['GlobalDato']['id']) == 8 ? ' class="magnolia"' : ' class="italic"'));
	?>	
	
		<tr<?php echo $class;?>>
			<td><?php echo (strlen($dato['GlobalDato']['id']) < 12 ? "<strong>".$dato['GlobalDato']['id']."</strong>" : $dato['GlobalDato']['id'])?></td>
			<td nowrap="nowrap"><?php echo (strlen($dato['GlobalDato']['id']) < 12 ? "<strong>".$dato['GlobalDato']['concepto_1']."</strong>" : $dato['GlobalDato']['concepto_1'])?></td>
			<td><?php echo $dato['GlobalDato']['concepto_2']?></td>
			<td><?php echo $dato['GlobalDato']['concepto_3']?></td>
			<td align="center"><?php echo $dato['GlobalDato']['logico_1']?></td>
			<td align="center"><?php echo $dato['GlobalDato']['logico_2']?></td>
			<td align="right"><?php echo $dato['GlobalDato']['entero_1']?></td>
			<td align="right"><?php echo $dato['GlobalDato']['entero_2']?></td>
			<td align="right"><?php echo $dato['GlobalDato']['decimal_1']?></td>
			<td align="right"><?php echo $dato['GlobalDato']['decimal_2']?></td>
			<td><?php echo $dato['GlobalDato']['fecha_1']?></td>
			<td><?php echo $dato['GlobalDato']['fecha_2']?></td>
		</tr>
	
	<?endforeach;?>
</table>
</div>
