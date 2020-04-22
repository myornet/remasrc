<?php echo $this->renderElement("title",array('plugin' => 'global'));?>

<script type="text/javascript">

function validateForm(){
	var codigo = document.getElementById("GlobalDatoCodigo").value;
	if($("GlobalDatoCodigo").getValue() == ""){
		alert("Debe indicar el codigo!");
		document.getElementById("GlobalDatoCodigo").focus();
		return false;
	}	
	return true;
}

</script>

<div class="form">

	<?php echo $frm->create('GlobalDato',array('action' => 'add/'.$this->data['GlobalDato']['id'].'/'.$nivel.'/'.$prefijo , 'onsubmit' => "return validateForm();"));?>

	<?php if(!empty($padre)):?>
	<div style="background-color:gray;padding:3px;color:#FFFFFF;">
	<?php echo $padre . ' :: ' . $padre_desc ?>
	<br/>
	<?php echo ($ln_a == 3 ? $html->image("/global/img/folder.png",array("border"=>"0")) . " " . substr($pref_s,4,4)  . ' :: ' . $prefijo_desc : "")?>
	</div>
	<?php endif;?>

    <h1><?php echo $html->image("/global/img/attach2.png",array("border"=>"0"))?> NUEVO DATO GLOBAL</h1>

	<table>
	
		<tr>
			<td>CODIGO</td>
			<td>
				<?php if($nivel > 1 && $nivel < 3):?>
          			<input type="text" value="<?php echo substr($prefijo,0,4)?>" size="4" maxlength="4" disabled/>
        		<?php elseif($nivel >= 3):?>
         			<input type="text" value="<?php echo substr($prefijo,0,4)?>" size="4" maxlength="4" disabled/>
          			<input type="text" value="<?php echo substr($prefijo,4,4)?>" size="4" maxlength="4" disabled/>
        		<?php endif;?>
				<input name="data[GlobalDato][codigo]" type="text" size="4" maxlength="4" value="" id="GlobalDatoCodigo" />
			</td>
		</tr>
		<tr>
			<td>CONCEPTO I</td>
			<td><?php echo $frm->input('concepto_1',array('size'=>60,'maxlength'=>100)) ?></td>
		</tr>
		<tr>
			<td>CONCEPTO II</td>
			<td><?php echo $frm->input('concepto_2',array('size'=>60,'maxlength'=>100)) ?></td>
		</tr>
		<tr>
			<td>CONCEPTO III</td>
			<td><?php echo $frm->input('concepto_3',array('size'=>60,'maxlength'=>100)) ?></td>
		</tr>
		<tr>
			<td>LOGICO I</td>
			<td><?php echo $frm->input('logico_1') ?></td>
		</tr>
		<tr>
			<td>LOGICO II</td>
			<td><?php echo $frm->input('logico_2') ?></td>
		</tr>
		<tr>
			<td>ENTERO I</td>
			<td><?php echo $frm->number('entero_1',array('value' => 0)) ?></td>
		</tr>
		<tr>
			<td>ENTERO II</td>
			<td><?php echo $frm->number('entero_2',array('value' => 0)) ?></td>
		</tr>
		<tr>
			<td>DECIMAL I</td>
			<td><?php echo $frm->money('decimal_1',"0.00") ?></td>
		</tr>
		<tr>
			<td>DECIMAL II</td>
			<td><?php echo $frm->money('decimal_2',"0.00") ?></td>
		</tr>
		<tr>
			<td>FECHA I</td>
			<td><?php echo $frm->calendar('fecha_1','',null,date('Y') + 10,date('Y') - 10,false)?></td>
		</tr>
		<tr>
			<td>FECHA II</td>
			<td><?php echo $frm->calendar('fecha_2','',null,date('Y') + 10,date('Y') - 10,false)?></td>
		</tr>
		<tr>
			<td>TEXTO I</td>
			<td><?php echo $frm->textarea('texto_1',array('cols' => 50, 'rows' => 10))?></td>
		</tr>																					
	</table>
	
	<?=$frm->hidden('codigo_prefijo',array('value'=>$prefijo)) ?>
	<?php echo $frm->btnGuardarCancelar(array('URL' => '/global/global_datos/index/'.$nivel.'/'.$prefijo))?>	
	
</div>
