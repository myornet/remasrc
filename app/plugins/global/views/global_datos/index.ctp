<?php echo $this->renderElement("title",array('plugin' => 'global'));?>

<div style="margin-bottom: 5px;border-bottom: 1px solid #8AAEC6;height: 33px;padding: 0px;">
	<?php if($ln_s > 2):?>
    <?php echo $html->link($html->image("/global/img/1uparrow.png",array("border"=>"0"))."SUBIR AL NIVEL ANTERIOR",'/global/global_datos/index/'.$ln_a.'/'.$pref_a,array('class' => 'botonGlobalADD'),NULL,false)?>&nbsp;
	<?php endif;?>
  <?php echo $html->link($html->image("/global/img/attach2.png",array("border"=>"0"))."NUEVO DATO GLOBAL",'add'.'/'.$ln_s.'/'.$pref_s,array('class' => 'botonGlobalADD'),null,false)?>&nbsp;
<?php echo $html->link($html->image("/global/img/view_tree.png",array("border"=>"0"))."LISTAR DATOS GLOBALES",'view'.'/'.$pref_s,array('class' => 'botonGlobalADD','target' => 'blank'),null,false)?>  
</div>
<br/>

<table>
    <?php if($ln_s > 2):?>
    <?php if(strlen($pref_s) > 4):?>
    <tr>
        <th colspan="14" style="text-align: left;background-color: #FFFFFF;color: #000000;font-size: 13px;font-weight: normal;"><?php echo $padre . ' :: ' . $padre_desc?></th>
    </tr>
    <?php endif;?>
    <tr>
        <th colspan="14" style="text-align: left;background-color: #FFFFFF;color:#000000;font-size: 13px;font-weight: normal;"><?php echo ($ln_a == 2 ? $html->image("/global/img/folder.png",array("border"=>"0")) . " " . substr($pref_s,4,4) : $pref_s) . ' :: ' . $prefijo_desc?></th>
    </tr>
    <?php endif;?>
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
		<th></th>
    	<th></th>
	</tr>

<?php
$i = 0;
foreach ($datos as $dato):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>	

	<tr<?php echo $class;?>>
<!--		<td><?php echo $dato['GlobalDato']['id'] ?></td>-->
		<td><?php echo ($ln_s == 4 ? $dato['GlobalDato']['id'] : '<strong>'.$html->link($dato['GlobalDato']['id'],'index/'.$ln_s.'/'.$dato['GlobalDato']['id']) . '</strong>')  ?></td>
		<td><?php echo $dato['GlobalDato']['concepto_1']?></td>
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
		<!--<td><?=$controles->getAcciones($dato['GlobalDato']['id'].'/'.$ln_s.'/'.$pref_s,false) ?></td>-->
    <td><strong><?php echo $html->link($html->image("/global/img/edit.png",array("border"=>"0")),'edit/'.$dato['GlobalDato']['id'].'/'.$ln_s.'/'.$pref_s,NULL,null,false)?></strong></td>
    <td><strong><?php echo $html->link($html->image("/global/img/editcut.png",array("border"=>"0")),'del/'.$dato['GlobalDato']['id'].'/'.$ln_s.'/'.$pref_s,NULL,"BORRAR EL CODIGO " . $dato['GlobalDato']['id'] ."?",false)?></strong></td>
	</tr>

<?endforeach;?>

</table>

<?//php debug($datos)?>

<?//=$this->renderElement('paginado')?>
