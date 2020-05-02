<!-- Buscador de personas -->
<?php echo $frm->create("Persona",array('action' => 'index'));?>

<nav class="level">
	<!-- Left side -->
	<div class="level-left">
		<div class="level-item">
			<p class="subtitle is-5">Tipo</p>
		</div>
		<div class="level-item">
			<div class="field has-addons">
				<p class="control select">
				<?php 
				echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSTDOC','empty' => true, 'selected' => "",'model' => 'Persona.tipo_documento'));
				?>
				</p>
				<p class="control">
				<?php echo $frm->number('documento',array('size'=>11,'maxlength'=>11,'placeholder'=>'Documento','class'=>'input'));?>
				</p>
				<p class="control">
				<button class="button">
					Search
				</button>
				</p>
			</div>
		</div>
	</div>

	<!-- Right side -->
	<div class="level-right">
		<p class="level-item"><strong>All</strong></p>
		<p class="level-item"><a>Published</a></p>
		<p class="level-item"><a>Drafts</a></p>
		<p class="level-item"><a>Deleted</a></p>
		<p class="level-item"><a class="button is-success">New</a></p>
	</div>
</nav>	



<div class="areaDatoForm">
	<table class="tbl_form">
		<tr>
			<td>TIPO</td>
			<td>
				<?php 
				echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSTDOC','empty' => true, 'selected' => "",'model' => 'Persona.tipo_documento'));
				?>
			</td>
			<td><?php echo $frm->number('documento',array('size'=>11,'maxlength'=>11));?></td>
			<td>APELLIDO</td><td><?php echo $frm->input('apellido',array('size'=>20,'maxlenght'=>50));?></td>
			<td>NOMBRE</td><td><?php echo $frm->input('nombre',array('size'=>20,'maxlenght'=>50));?></td>
			<td><input type="submit" value="?" /></td>
			<td></td>
			<td><?php if($user['Usuario']['perfil'] == 3) echo $frm->boton(array('URL' => '/personas/alta_titular','LABEL' => 'NUEVO'))?></td>
		</tr>
	</table>
	<?php echo $frm->end();?>
</div>