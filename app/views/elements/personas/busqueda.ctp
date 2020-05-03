<!-- Buscador de personas -->
<?php echo $frm->create("Persona",array('action' => 'index'));?>

<nav class="level">
	<!-- left side -->
	<div class="level-left">
		<div class="field-body">
			<div class="field has-addons">
				<div class="control">
					<div class="select is-marginless">
					<?php 
					echo $this->renderElement("combo_global",array('plugin' => 'global','prefix' => 'PERSTDOC','empty' => true, 'selected' => "PERSTDOC0DNI",'model' => 'Persona.tipo_documento'));
					?>
					</div>
				</div>
				<div class="control">
				<?php echo $frm->number('documento',array('size'=>11,'maxlength'=>11,'placeholder'=>'Documento','class'=>'input'));?>
				</div>
			</div>
		
			<div class="field">
				<p class="control">
				<?php echo $frm->input('apellido',array('size'=>20,'maxlenght'=>50,'placeholder'=>'Apellido','class'=>'input'));?>
				</p>
			</div>

			<div class="field">
				<div class="field has-addons">
					<p class="control">
					<?php echo $frm->input('nombre',array('size'=>20,'maxlenght'=>50,'placeholder'=>'Nombre','class'=>'input'));?>
					</p>
				</div>
			</div>

			<div class="field">
				<p class="control">
					<button class="button" value="?">
						<i class="fas fa-search"></i>
					</button>
				</p>
			</div>

			<div class="field is-horizontal">
				<?php if($user['Usuario']['perfil'] == 3) 
					echo $frm->boton(array('URL' => '/personas/alta_titular','LABEL' => 'NUEVO','CLASS' => 'button is-success'));
				?>
			</div>
		</div>
	</div>
</nav>	

<?php echo $frm->end();?>