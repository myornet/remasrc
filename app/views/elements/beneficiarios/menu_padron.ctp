<h2 class="title">PADRON DE BENEFICIARIOS</h2>

<!-- Datos del beneficiario -->
<div class="box">
	<article class="media">
		<div class="media-content">
			<div class="content">
				<div class="tags has-addons">
					<span class="tag">BENEFICIO #<?php echo $beneficiario['Beneficiario']['id']?></span>
					<?php if($beneficiario['Beneficiario']['estado'] == 1):?>
					<small class="tag is-success">VIGENTE</small>
					<?php else:?>
					<small class="tag is-danger">NO VIGENTE (<?php echo $util->armaFecha($beneficiario['Beneficiario']['fecha_baja'])?>)</small>
					<?php endif;?>
				</div>
				<h3 class="title"><?php echo $beneficiario['Persona']['apenom'] ?></h3>
				<h4 class="subtitle"><?php echo $beneficiario['Persona']['tdocndoc'] ?></h4>
			</div>
			<div class="buttons">
				<a class="button is-small" href="/personas/ficha/<?php echo $beneficiario['Persona']['id'] ?>" target="_blank">
					<span>VER PERFIL</span>
					<span class="icon is-small">
					<i class="fas fa-external-link-alt"></i>
					</span>
				</a>
			</div>
		</div>
	</article>
</div>

<?php echo $this->renderElement('maquetado/menu_padron_beneficiario')?>