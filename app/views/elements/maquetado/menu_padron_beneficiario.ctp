<div class="tabs is-centered">
	<ul>
		<li>
			<a href="/beneficiarios/ficha/<?php echo $beneficiario['Persona']['id'] ?>">
				<span class="icon is-small"><i class="far fa-clipboard" aria-hidden="true"></i></span>
				<span>Ficha</span>
			</a>
		</li>
		<li>
			<a href="/beneficiarios/modificar_datos_titular/<?php echo $beneficiario_id ?>">
				<span class="icon is-small"><i class="fas fa-user-shield" aria-hidden="true"></i></span>
				<span>Datos del titular</span>
			</a>
		</li>
		<li>
			<a href="/beneficiario_adicionales/index/<?php echo $beneficiario_id ?>">
				<span class="icon is-small"><i class="fas fa-users" aria-hidden="true"></i></span>
				<span>Grupo familiar</span>
			</a>
		</li>
		<li>
			<a href="/beneficiario_beneficios/index/<?php echo $beneficiario_id ?>">
				<span class="icon is-small"><i class="fas fa-shopping-cart" aria-hidden="true"></i></span>
				<span>Consumos</span>
			</a>
		</li>
		<li>
			<a href="/beneficiarios/novedades/<?php echo $beneficiario_id ?>">
			<span class="icon is-small"><i class="fas fa-file-alt" aria-hidden="true"></i></span>
				<span>Novedades</span>
			</a>
		</li>
		<?php if($user['Usuario']['perfil'] == 3): ?>
		<li>
			<a href="/beneficiarios/modificar_estado/<?php echo $beneficiario_id ?>">
				<span class="icon is-small"><i class="fas fa-exclamation-circle" aria-hidden="true"></i></span>
				<span>Estado</span>
			</a>
		</li>
		<li>
			<a href="/beneficiarios/unificar/<?php echo $beneficiario_id ?>">
				<span class="icon is-small"><i class="far fa-object-group" aria-hidden="true"></i></span>
				<span>Unificar</span>
			</a>
		</li>
		<?php endif; ?>
		<li>
			<a href="/beneficiarios">
				<span class="icon is-small"><i class="fas fa-search-plus" aria-hidden="true"></i></span>
				<span>Nueva búsqueda</span>
			</a>
		</li>
	</ul>
</div>