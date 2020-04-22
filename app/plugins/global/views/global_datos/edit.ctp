
<?php echo $this->renderElement("title",array('plugin' => 'global'));?>

<?php echo $frm->create('GlobalDato',array('action' => 'edit/'.$this->data['GlobalDato']['id'].'/'.$nivel.'/'.$prefijo));?>

<h3>MODIFICAR DATO GLOBAL</h3>

<div class="form">

	<div style="background-color:gray;padding:3px;color:#FFFFFF;">
	<?php echo $frm->create('GlobalDato',array('action' => 'add/'.$this->data['GlobalDato']['id'].'/'.$nivel.'/'.$prefijo));?>
	<?php echo $padre . ' :: ' . $padre_desc?>
	<br/>
	<?php echo ($ln_a == 3 ? $html->image("/global/img/folder.png",array("border"=>"0")) . " " . substr($pref_s,4,4)  . ' :: ' . $prefijo_desc : "")?>
	</div>

   <h1><?php echo $html->image("/global/img/edit.png",array("border"=>"0"))?> MODIFICAR DATO GLOBAL</h1>

	<table class="tbl_form">
	
		<tr>
			<td>CODIGO</td>
			<td><?php echo $frm->input('codigo',array('size'=>14,'maxlength'=>12,'disabled'=>'disabled','value'=>$this->data['GlobalDato']['id'])) ?></td>
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
			<td><?php echo $frm->number('entero_1',array('value'=>$this->data['GlobalDato']['entero_1'])) ?></td>
		</tr>
		<tr>
			<td>ENTERO II</td>
			<td><?php echo $frm->number('entero_2',array('value'=>$this->data['GlobalDato']['entero_1'])) ?></td>
		</tr>
		<tr>
			<td>DECIMAL I</td>
			<td><?php echo $frm->money('decimal_1',$this->data['GlobalDato']['decimal_1']) ?></td>
		</tr>
		<tr>
			<td>DECIMAL II</td>
			<td><?php echo $frm->money('decimal_2',$this->data['GlobalDato']['decimal_2']) ?></td>
		</tr>
		<tr>
			<td>FECHA I</td>
			<td><?php echo $frm->calendar('fecha_1','',null,date('Y'),date('Y'),false)?></td>
		</tr>
		<tr>
			<td>FECHA II</td>
			<td><?php echo $frm->calendar('fecha_2','',null,date('Y'),date('Y'),false)?></td>
		</tr>
		<tr>
			<td>TEXTO I</td>
			<td><?php echo $frm->textarea('texto_1',array('cols' => 50, 'rows' => 10))?></td>
		</tr>																					
	</table>
	<?php echo $frm->btnGuardarCancelar(array('URL' => '/global/global_datos/index/'.$nivel.'/'.$prefijo))?>	 		 	 		 
</div>

